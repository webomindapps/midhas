<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Brand;
use App\Models\Category;
use Illuminate\Http\Request;

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

        return view('frontend.pages.index', compact('categories', 'brands', 'banners'));
    }
}
