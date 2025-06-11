<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\DeliveryCity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class BookTimeController extends Controller
{
    public function index()
    {
        $customer = Auth::user();
        if ($customer) {
            $cart = Cart::where('customer_id', $customer->id)->latest()->first();
        } else {
            $cart_id = Session::get('cart_id');
            if ($cart_id) {
                $cart = Cart::find($cart_id);
            } else {
                $cart = null;
            }
        }

        $cities = DeliveryCity::where('status', true)->get();
        $cartAmount = $cart ? $cart->grand_total : 0;
        return view('frontend.pages.book-time.index', compact('cities', 'cartAmount'));
    }
}
