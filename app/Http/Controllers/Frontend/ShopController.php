<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Brand;
use App\Models\Pages;
use App\Models\Banner;
use App\Models\Sliders;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Filter;
use App\Models\FilterItem;
use App\Models\Product\Product;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class ShopController extends Controller
{
    public function __construct(public Product $product) {}
    public function index()
    {
        $categories = Category::with('children.children', 'image')
            ->where('status', 1)
            ->orderBy('position', 'asc')
            ->where('show_in_nav', 1)
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
        $now = Carbon::now();

        $specialoffers = Product::with('images')
            ->where('status', 1)
            ->whereHas('prices', function ($query) use ($now) {
                $query->where('start_date', '<=', $now)
                    ->where('end_date', '>=', $now);
            })
            ->get();
        $blogs = Blog::where('status', 1)->get();

        return view('frontend.pages.index', compact('categories', 'brands', 'banners', 'sliders', 'bestsellers', 'isnew', 'specialoffers', 'blogs'));
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
        $is_best_selling = $request->is_best_selling;
        $brand = $request->brand;
        $price = $request->price;
        $sku = $request->sku;
        $specifications = json_decode($request->get('specifications'), true);

        $query = Product::query();

        $category = Category::where('slug', $slug)->first();

        if ($category) {
            $category_children = $category->children()->pluck('id')->toArray();
            $categories_id = array_merge([$category->id], $category_children);

            $query->whereHas('categories', function ($query) use ($categories_id) {
                $query->whereIn('category_id', $categories_id);
            });
            $sub_categories = $category->children()
                ->where('status', true)
                ->orderBy('name', 'asc')
                ->get();

            if ($sub_categories->isEmpty() && $category->parent) {
                $sub_categories = $category->parent
                    ->children()
                    ->where('status', true)
                    ->where('id', '!=', $category->id)
                    ->orderBy('name', 'asc')
                    ->get();
            }
        }

        if ($brand) {
            $brand = explode(',', $brand);
            $query->whereIn('brand_id', $brand);
        }

        if ($price) {
            $price = explode('-', $price);
            $query->whereBetween('selling_price', $price);
        }

        if ($is_new) {
            $query->where('is_new', $is_new);
        }

        if ($is_best_selling) {
            $query->where('is_best_selling', $is_best_selling);
        }
        if (is_array($specifications)) {
            foreach ($specifications as $filter) {
                $filterId = $filter['id'];
                $values = $filter['values'];
                $filterConfig = FilterItem::find($filterId);
                if ($filterConfig) {
                    $query->whereIn($filterConfig->column_name, $values);
                }
            }
        }
        ($sort == '') ? $query->orderBy('title', 'asc') : $query->orderBy($sort, $order);

        $query->where('status', true);

        $products = $paginate ? $query->paginate($paginate)->appends(request()->query()) : $query->paginate(100)->appends(request()->query());


        if ($category || $brand || $is_new || $is_best_selling || $all) {
            $recentIds = Session::get('recents', []);
            $recentlyViewed = Product::whereIn('id', $recentIds)->get();
            $filters = $this->getCategoryFilters($category);
            $brands  = $this->getBrands($products);
            return view('frontend.pages.category-lists', compact('products', 'sub_categories', 'category', 'recentlyViewed', 'filters', 'brands'));
        } else {

            if ($sku) {
                $product = Product::where('slug', $slug)->where('sku', $sku)->first();
            } else {
                $product = Product::where('slug', $slug)->first();
            }
            if ($product) {
                $category_ids = $product->categories()->get()->pluck('id')->toArray();
                $relatedProducts = $this->getProductsByCategory($category_ids);
                $recentIds = Session::get('recents', []);
                array_push($recentIds, $product->id);
                Session::put('recents', $recentIds);
                $recentViewed = Product::whereIn('id', $recentIds)->where('id', '<>', $product->id)->get();
                $sizes = $product->sizes;
                return view('frontend.pages.product-detail', compact('product', 'relatedProducts', 'recentViewed', 'sizes'));
            } else {
                abort(404, 'Page not found');
            }
        }
    }


    public function activeProducts()
    {
        return Product::with('images', 'stocks', 'variants')
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

    public function searchProduct(Request $request)
    {
        $search = $request->search;
        $products = null;
        $query = Product::query();
        if ($search != '') {
            $query
                ->where('status', true)
                ->where(function ($query) use ($search) {
                    $query->whereHas('categories', function ($subquery) use ($search) {
                        $subquery->where('slug', 'like', '%' . $search . '%')
                            ->where('status', true); // assuming 'status' is on Category
                    })->orWhereHas('brand', function ($brandQuery) use ($search) {
                        $brandQuery->where('name', 'like', '%' . $search . '%');
                    })->orWhere('title', 'like', '%' . $search . '%')
                        ->orWhere('sku', 'like', '%' . $search . '%')
                        ->orWhere('slug', 'like', '%' . $search . '%');
                });

            $products = $query
                ->with('images', 'stocks', 'variants')->get();
        }
        return [
            'html' => view('frontend.pages.searched-items', compact('products'))->render()
        ];
    }


    private function getCategoryFilters($category)
    {

        $products = $category->products()->pluck('products.id')->toArray();
        $ancestors = $category->parent()->pluck('id')->toArray();
        $filter = Filter::where('filter_for', 'List')
            ->whereIn('sub_category_id', array_merge($ancestors, [$category->id]))
            ->orWhere('category_id', $category->id)->first();
        if ($filter) {
            return FilterItem::where('filter_id', $filter->id)
                ->get()
                ->map(function ($q) use ($products) {
                    $type = $q->type;

                    if ($q->column_name) {
                        $values =
                            Product::whereIn('id', $products)
                            ->whereNotNull($q->column_name)
                            ->select(DB::raw("MIN(id) as id"), DB::raw("`$q->column_name` as value"))
                            ->groupBy(DB::raw("`$q->column_name`"))
                            ->get();
                    } else {
                        $values = [];
                    }

                    return [
                        'id' => $q->id,
                        'name' => $q->name,
                        'type' => $type,
                        'column' => $q->column_name,
                        'values' => $values,
                        'productsIds' => $products
                    ];
                });
        }
    }
    private function getBrands($products = null)
    {
        $brand_ids = $products->pluck('brand_id')->toArray();
        return Brand::whereIn('id', $brand_ids)->get();
    }

    public function viewblog($id)
    {
        $blogs = Blog::with('blogcategory')->findOrFail($id);

        $recentPosts = Blog::latest()->where('id', '!=', $id)->take(5)->get();

        $allCategories = Category::all();

        return view('frontend.pages.blog-view', compact('blogs', 'recentPosts', 'allCategories'));
    }
    public function bloglist($categoryId)
    {
        $blogs = Blog::with('blogcategory')->where('category_id', $categoryId)->latest()->get();
        $category = Category::findOrFail($categoryId);
        $allCategories = Category::all();
        $recentPosts = Blog::latest()->where('id', '!=', $categoryId)->take(5)->get();


        return view('frontend.pages.blog-list', compact('blogs', 'category', 'allCategories', 'recentPosts'));
    }

    public function categorylist(Request $request, $slug = null)
    {
        $sort = $request->sort ?? 'title';
        $order = $request->order ?? 'asc';
        $paginate = $request->paginate ?? 100;
        $is_new = $request->is_new;
        $all = $request->all;
        $is_best_selling = $request->is_best_selling;
        $brand = $request->brand;
        $price = $request->price;
        $specifications = json_decode($request->get('specifications'), true);

        // Initialize query and variables
        $query = Product::with('images')->where('status', true);
        $category = null;
        $sub_categories = collect();
        $filters = collect();
        $brands = collect();
        $recentlyViewed = collect();

        // ======== Category filter ========
        if ($slug && !$is_new) {
            $category = Category::where('slug', $slug)->first();

            if ($category) {
                $categoryChildren = $category->children()->pluck('id')->toArray();
                $categories_id = array_merge([$category->id], $categoryChildren);

                $query->whereHas('categories', function ($q) use ($categories_id) {
                    $q->whereIn('category_id', $categories_id);
                });

                $sub_categories = $category->children()
                    ->where('status', true)
                    ->orderBy('name', 'asc')
                    ->get();

                if ($sub_categories->isEmpty() && $category->parent) {
                    $sub_categories = $category->parent
                        ->children()
                        ->where('status', true)
                        ->where('id', '!=', $category->id)
                        ->orderBy('name', 'asc')
                        ->get();
                }

                $filters = $this->getCategoryFilters($category);
            }
        }

        // ======== Other filters ========
        if ($is_new) {
            $query->where('is_new', 1);
        }

        if ($is_best_selling) {
            $query->where('is_best_selling', $is_best_selling);
        }

        if ($brand) {
            $brandIds = explode(',', $brand);
            $query->whereIn('brand_id', $brandIds);
        }

        if ($price) {
            $range = explode('-', $price);
            $query->whereBetween('selling_price', $range);
        }

        if (is_array($specifications)) {
            foreach ($specifications as $filter) {
                $filterConfig = FilterItem::find($filter['id']);
                if ($filterConfig) {
                    $query->whereIn($filterConfig->column_name, $filter['values']);
                }
            }
        }

        // ======== Sorting & pagination ========
        $query->orderBy($sort, $order);
        $products = $query->paginate($paginate)->appends(request()->query());

        // ======== Recently Viewed ========
        $recentIds = Session::get('recents', []);
        $recentlyViewed = Product::whereIn('id', $recentIds)->get();
        $brands = $this->getBrands($products);

        // ======== Return view ========
        return view('frontend.pages.category-lists', compact(
            'products',
            'sub_categories',
            'category',
            'recentlyViewed',
            'filters',
            'brands'
        ));
    }
}
