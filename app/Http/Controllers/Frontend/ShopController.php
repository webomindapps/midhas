<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Brand;
use App\Models\Pages;
use App\Models\Banner;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
}
