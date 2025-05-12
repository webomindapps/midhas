<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
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
}
