<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Models\Product\Product;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Validation\ValidatesRequests;

class EnquiryController extends Controller
{
    use ValidatesRequests;

    public function __invoke(Request $request, Product $product)
    {
        $response = $this->validate($request, [
            'name' => 'required',
            'phone' => 'required',
            'message' => 'required',
        ]);

        $enquiry = $product->enquiries()->create([
            'user_id' => Auth::check() ? Auth::user()->id : null,
            'product_name' => $product->title,
            'sku' => $product->sku,
            'brand' => $product->brand?->name,
            'name' => $request->name,
            'phone' => $request->phone,
            'message' => $request->message,
        ]);

        return redirect()->route('productByCategory', $product->slug)->with('message', 'Enquiry submitted successfully');
    }
}
