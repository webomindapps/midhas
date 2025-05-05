<?php

namespace App\Http\Controllers\Frontend;

use Exception;
use App\Models\Cart;
use App\Models\CartItems;
use Illuminate\Http\Request;
use App\Models\Product\Product;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Product\ProductStock;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function model()
    {
        return new Cart;
    }
    public function cartView()
    {
        $customer = Auth::user();

        if ($customer) {
            $cartItems = Cart::where('customer_id', $customer->id)->get();
        } else {
            $cart_id = Session::get('cart_id');
            if ($cart_id) {
                $cartItems = Cart::with('items')->where('id', $cart_id)->get();
            } else {
                $cartItems = collect(); // empty collection
            }
        }

        return view('frontend.pages.cart', compact('cartItems'));
    }

    public function findBy($type, $value)
    {
        return $this->model()->where($type, $value)->first();
    }
    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $customer = Auth::user();
            $product_id = $request->product_id;
            $variant_id = $request->variant_id;
            $qty = $request->qty;

            // Remove this in production:

            if ($customer) {
                // Check if cart exists
                if ($customer->cart) {
                    $cart = $customer->cart;
                } else {
                    $cart = $customer->cart()->create([
                        'customer_id' => $customer->id,
                        'name' => $customer->name,
                        'email' => $customer->email,
                    ]);
                }
            } else {
                // Session-based cart
                $cart_id = Session::get('cart_id');
                $cart = $cart_id ? $this->findBy('id', $cart_id) : $this->model()->create(['items_count' => 0]);
                Session::put('cart_id', $cart->id);
            }

            $cart_item = $this->cartItemCreate($cart, $product_id, $qty, $variant_id);
            DB::commit();

            $this->calculateTotal($cart->id);

            return response()->json([
                'success' => true,
                'data' => $cart,
            ], 201);
        } catch (Exception $e) {
            DB::rollBack();
            session()->forget('cart_id');
            return response()->json([
                'error' => true,
                'message' => $e->getMessage(), // better for debugging
            ], 200);
        }
    }

    public function cartItemCreate($cart, $product_id, $qty, $variant_id)
    {

        $product = Product::find($product_id);
        $today = date('Y-m-d');
        $price = $product->msrp;
        // if ($variant_id) {
        //     $variant = $product->variants()->find($variant_id);
        //     if ($variant) {
        //         $price = $variant->price;
        //     }
        // }
        // if ($product->special_price_from) {
        //     if ($product->special_price_from <= $today && $product->special_price_to >= $today) {
        //         $price = $product->special_price;
        //     }
        // }

        $cart_item = CartItems::where('product_id', $product_id)->where('variant_id', $variant_id)->where('cart_id', $cart->id)->first();


        if ($cart_item) {
            $data['variant_id'] = $variant_id;
            $data['quantity'] = $cart_item->quantity + $qty;
            $new_total_amount = $price * $qty;
            $total_amount = $cart_item->total_amount + $new_total_amount;
            if ($cart_item->tax_percent) {
                $data['tax_percent'] = $cart_item->tax_percent;
                $new_tax_amount = $total_amount * ($cart_item->tax_percent / 100);
                $data['tax_amount'] = $new_tax_amount;
            }
            $data['total_amount'] = $total_amount;
            $cart_item->update($data);
            return $cart_item;
        } else {
            $data['variant_id'] = $variant_id;
            $data['product_id'] = $product->id;
            $data['sku'] = $product->sku;
            $data['name'] = $product->title;
            $data['price'] = $price;
            $data['quantity'] = $qty;
            $total_amount = $price * $qty;
            if ($product->tax) {
                $data['tax_percent'] = $product->tax?->percent;
                $new_tax_amount = $total_amount * ($product->tax?->percent / 100);
                $data['tax_amount'] = $new_tax_amount;
            }
            $data['total_amount'] = $total_amount;
            return $cart->items()->create($data);
        }
    }
    public function calculateTotal($cart_id)
    {
        $cart = $this->findBy('id', $cart_id);
        $item_qty = 0;
        $total_amount = 0;
        $tax_total = 0;
        $tax = 0;
        $discount = 0;
        $grand_total = 0;

        if (!is_null($cart)) {
            foreach ($cart->items as $item) {
                if ($item->tax_amount) {
                    $tax_total += $item->total_amount;
                }
                $item_qty += $item->quantity;
                $total_amount += $item->total_amount;
                $tax += $item->tax_amount;
                $grand_total += $item->total_amount + $item->tax_amount;
            }

            // if ($cart->coupon_code) {
            //     $coupon = Coupon::where('name', $cart->coupon_code)->first();
            //     $valid = $this->checkCoupon($coupon, $cart);
            //     if ($valid) {
            //         if ($coupon->is_condition_coupon == 1) {
            //             if ($total_amount >= $coupon->min_amount_for_discount) {
            //                 if ($coupon->discount_type == 1) {
            //                     $discount = $total_amount * ($coupon->discount_type_value / 100);
            //                     if ($discount > $coupon->max_discount_amount) {
            //                         $discount = $coupon->max_discount_amount;
            //                     }
            //                 } else {
            //                     $discount = $coupon->discount_type_value;
            //                 }
            //             } else {
            //                 $cart->coupon_code = null;
            //                 $cart->save();
            //                 $discount = 0;
            //             }
            //         }
            //         $grand_total = $grand_total - $discount;
            //     }
            // }
            $cart->update([
                'items_qty' => $item_qty,
                'total_amount' => $total_amount,
                'discount_amount' => $discount,
                'tax_total' => $tax_total,
                'tax' => $tax,
                'grand_total' => $grand_total
            ]);
        }
    }
    public function update(Request $request)
    {
        $item_id = $request->item_id;
        $qty = $request->qty;
        $cart_item = CartItems::find($item_id);
        $cart = Cart::find($cart_item->cart_id);
        $product = Product::find($cart_item->product_id);
        $today = date('Y-m-d');
        $price = $product->msrp;
        // if ($product->special_price_from) {
        //     if ($product->special_price_from <= $today && $product->special_price_to >= $today) {
        //         $price = $product->special_price;
        //     }
        // }
        // if ($cart_item->variant) {
        //     // $price = $cart_item->variant?->price;
        // }
        DB::beginTransaction();
        try {
            $cart_item->quantity = $qty;
            $total_amount = $price * $qty;
            if ($cart_item->tax_percent) {
                $new_tax_amount = $total_amount * ($cart_item->tax_percent / 100);
                $cart_item->tax_amount = $new_tax_amount;
            }
            $cart_item->total_amount = $total_amount;
            $cart_item->save();
            $this->calculateTotal($cart->id);
            $cart = Cart::find($cart_item->cart_id);
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            session()->forget('cart_id');
            dd($e);
        }
        return response()->json([
            'success' => true,
            'data' => $cart_item,
            'cart' => $cart,
        ], 200);
    }
    public function destroy($item_id)
    {
        $cart_item = CartItems::findOrFail($item_id);
        $cart_item->delete();
        $cart = Cart::find($cart_item->cart_id);
        $this->calculateTotal($cart->id);
        return back()->with('error', 'item was removed successfully from the cart');
    }
}
