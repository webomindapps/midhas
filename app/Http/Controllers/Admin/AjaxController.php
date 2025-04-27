<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product\ProductImage;

class AjaxController extends Controller
{
    public function deleteImage()
    {
        $image = ProductImage::find(request()->id);
        $image->delete();
        return response()->json(['success' => true]);
    }
}
