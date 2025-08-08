<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product\Product;
use App\Models\Product\ProductImage;

class AjaxController extends Controller
{
    public function deleteImage()
    {
        $image = ProductImage::find(request()->id);
        $image->delete();
        return response()->json(['success' => true]);
    }

    public function getSubCategories()
    {
        return response()->json(
            Category::where('parent_id', request()->id)->get()
        );
    }
    public function getProducts()
    {
        $type = request()->type;
        $products = $type && $type == 3 ? $this->byBrands() : $this->byCategories();
        return response()->json(
            $products
        );
    }
    public function byCategories()
    {
        $category = Category::findOrFail(request()->id);

        $categoryIds = $category->getSelfAndChildrenId();

        return Product::whereHas('categories', function ($q) use ($categoryIds) {
            $q->whereIn('category_id', $categoryIds);
        })->get()->map(function ($product) {
            return [
                'label' => $product->sku,
                'value' => $product->id,
                'name' => $product->title,
                'price' => $product->currentPrice()
            ];
        });
    }


    public function byBrands()
    {
        return Product::where('brand_id', request()->id)
            ->get()->map(function ($query) {
                return [
                    'label' => $query->sku,
                    'value' => $query->id,
                    'name' => $query->name,
                    'price' => $query->currentPrice()
                ];
            });
    }
}
