<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Brand;
use App\Models\Pages;
use App\Models\Banner;
use App\Models\Sliders;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product\Product;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;

class ShopController extends Controller
{
    public function index()
    {
        $categories = Category::with('children.children', 'image')
            ->where('status', 1)
            ->orderBy('position', 'asc')
            ->whereNull('parent_id')
            ->get();

        $brands = Brand::with('image')->where('status', 1)->get();
        $banners = Banner::with('images')->where('status', 1)->orderBy('position', 'asc')->get();
        $sliders = Sliders::where('status', 1)->get();
        $bestsellers = Product::with('images')->where('is_best_selling', 1)
            ->where('status', 1)
            ->get();
        $isnew = Product::with('images')->where('is_new', 1)
            ->where('status', 1)
            ->get();


        return view('frontend.pages.index', compact('categories', 'brands', 'banners', 'sliders', 'bestsellers', 'isnew'));
    }
    public function pageDetails($page)
    {
        $pageDetails = Pages::where('slug', $page)->first();
        if ($pageDetails) {
            $categories = Category::with('children.children', 'image')
                ->where('status', 1)
                ->orderBy('position', 'asc')
                ->whereNull('parent_id')
                ->get();
            return view('frontend.pages.page_view', compact('pageDetails', 'categories'));
        } else {
            abort(404, 'Page not found');
        }
    }
    public function productByCategory(Request $request, $slug)
    {
        $sort = $request->sort;
        $order = $request->order;
        $paginate = $request->paginate;
        $is_new = $request->is_new;
        $all = $request->all;
        $is_best_seller = $request->is_best_seller;
        $brand = $request->brand;
        $price = $request->price;
        $sku = $request->sku;

        $query = Product::query();

        $category = Category::where('slug', $slug)->first();
        // dd($category);
        if ($category) {
            $category_children = $category->children()->pluck('id')->toArray();
            $categories_id = array_merge([$category->id], $category_children);

            $query->whereHas('categories', function ($query) use ($categories_id) {
                $query->whereIn('category_id', $categories_id);
            });
            $sub_categories = $category->children()->orderBy('name', 'asc')->get();
            if ($sub_categories->isEmpty()) {
                $parentCategory = $category->parent;
                if ($parentCategory) {
                    $sub_categories = $parentCategory->children()->where('status', true)->orderBy('name', 'asc')->get();
                }
            }
        }

        if ($brand) {
            $brand = explode(',', $brand);
            $query->whereHas('brand_name', function ($query) use ($brand) {
                $query->whereIn('brand', $brand);
            });
        }

        if ($price) {
            $price = explode('-', $price);
            $query->whereBetween('price', $price);
        }

        if ($is_new) {
            $query->where('is_new', $is_new);
        }

        if ($is_best_seller) {
            $query->where('is_best_seller', $is_best_seller);
        }

        ($sort == '') ? $query->orderBy('title', 'asc') : $query->orderBy($sort, $order);

        $query->where('status', true);

        $products = $paginate ? $query->paginate($paginate)->appends(request()->query()) : $query->paginate(100)->appends(request()->query());


        if ($category || $brand || $is_new || $is_best_seller || $all) {
            return view('frontend.pages.category-lists', compact('products', 'sub_categories', 'category'));
        } else {

            if ($sku) {
                $product = Product::where('slug', $slug)->where('sku', $sku)->first();
            } else {
                $product = Product::where('slug', $slug)->first();
            }
            if ($category || $brand || $is_new || $is_best_seller || $all) {
                return view('frontend.pages.category-lists', compact('products', 'sub_categories', 'category'));
            } else {

                if ($sku) {
                    $product = Product::where('slug', $slug)->where('sku', $sku)->first();
                } else {
                    $product = Product::where('slug', $slug)->first();
                }

                if ($product) {
                    $category = $product->categories()->first();
                    if ($category) {
                        $category = $category->category;
                    } else {
                        $category = Category::latest()->first();
                    }
                    if ($category) {
                        $sub_categories = $category->descendants()->pluck('id')->toArray();
                        $parent_categories = $category->ancestors()->pluck('id')->toArray();
                        $relatedProducts = $this->getProductsByCategory(array_merge([$category->id], $sub_categories, $parent_categories));
                        if ($relatedProducts->isEmpty()) {
                            $relatedProducts = collect();
                        }
                    } else {
                        $sub_categories = [];
                        $parent_categories = [];
                        $relatedProducts = collect();
                    }
                    $recentIds = Session::get('recents', []);
                    array_push($recentIds, $product->id);
                    Session::put('recents', $recentIds);
                    $recentViewed = Product::whereIn('id', $recentIds)->where('id', '<>', $product->id)->get();

                    return view('frontend.pages.product-detail', compact('product', 'relatedProducts', 'recentViewed'));
                } else {
                    abort(404, 'Page not found');
                }
            }
        }
    }


    public function activeProducts()
    {
        return Product::with('images', 'inventory', 'variants', 'variants.variant', 'variants.variant_value')
            ->where('status', true);
    }


    public function getProductsByCategory($categories = [])
    {
        $products = $this->activeProducts()
            ->whereHas('categories', function ($subquery) use ($categories) {
                $subquery->whereIn('category_id', $categories);
            })
            ->paginate(25);

        return $products;
    }

    // Get products by a specific type and value (e.g., best sellers, new, etc.)
    public function getProductsBy($type, $value, $limit = 0)
    {
        return $this->activeProducts()
            ->where($type, $value)
            ->take($limit)
            ->get();
    }
}
