<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Review;
use App\Facades\Midhas;
use Illuminate\Http\Request;
use App\Models\Product\Product;
use App\Http\Controllers\Controller;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Product $product)
    {
        $data = $request->all();
        $data['user_id'] = auth()->user()->id;
        $review = $product->reviews()->create($data);
        $images = $request->images;
        $folder = 'reviews/';

        if ($images && count($images) > 0) {
            foreach ($images as $key => $image) {
                $url = Midhas::upload($image, $folder . $review->id . '/');
                $review->images()->create([
                    'url' => $url,
                ]);
            }
        }

        return redirect()->back()->with('message', 'Review submitted successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Review $review)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Review $review)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Review $review)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Review $review)
    {
        //
    }
}
