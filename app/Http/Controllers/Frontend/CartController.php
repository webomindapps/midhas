<?php

namespace App\Http\Controllers\Frontend;

use Exception;
use Carbon\Carbon;
use App\Models\Cart;
use App\Models\Discount;
use App\Models\CartItems;
use Illuminate\Http\Request;
use App\Models\Product\Product;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Product\ProductStock;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use PhpParser\Node\Stmt\Return_;

class CartController extends Controller
{
    public function model()
    {
        return new Cart;
    }
    public function cartView()
    {
        $customer = Auth::user();
        $discountType = $this->checkIfCouponApplied();
        if ($customer) {
            $cartItems = Cart::where('customer_id', $customer->id)->get();
        } else {
            $cart_id = Session::get('cart_id');
            if ($cart_id) {
                $cartItems = Cart::with('items')->where('id', $cart_id)->get();
            } else {
                $cartItems = collect();
            }
        }

        return view('frontend.pages.cart', compact('cartItems', 'discountType'));
    }

    public function findBy($type, $value)
    {
        return $this->model()->where($type, $value)->first();
    }
    public function store(Request $request)
    {
        // dd("hello");
        DB::beginTransaction();
        try {
            $customer = Auth::user();
            $product_id = $request->product_id;
            $qty = $request->qty;


            if ($customer) {
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
                $cart_id = Session::get('cart_id');
                if ($cart_id) {
                    $cart = $this->findBy('id', $cart_id);
                } else {
                    $cart = $this->model()->create(['items_count' => 0]);
                    Session::put('cart_id', $cart->id);
                }
            }

            $stock = Product::find($product_id);
            $existingQty = $cart->items
                ->where('product_id', $product_id)
                ->sum('quantity');

            $totalRequestedQty = $existingQty + $qty;

            if (!$stock || $stock->total_stock < $totalRequestedQty) {
                return response()->json([
                    'error' => true,
                    'message' => 'Insufficient stock available.',
                ], 200);
            }
            $cart_item = $this->cartItemCreate($cart, $product_id, $qty);
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
                'message' => $e->getMessage(),
            ], 200);
        }
    }

    public function cartItemCreate($cart, $product_id, $qty)
    {
        $product = Product::findOrFail($product_id);
        $price = $product->msrp;
        $total_amount = $price * $qty;

        $cart_item = CartItems::where('product_id', $product_id)
            ->where('cart_id', $cart->id)
            ->first();

        $data = [
            'price' => $price,
        ];

        if ($product->is_taxable == 1) {
            $tax_percent = $product->tax?->percent ?? 13;
            $data['tax_percent'] = $tax_percent;
            $data['tax_amount'] = round($total_amount * ($tax_percent / 100), 2);
        } else {
            $data['tax_percent'] = 0;
            $data['tax_amount'] = 0;
        }

        if ($cart_item) {
            $data['quantity'] = $cart_item->quantity + $qty;
            $data['total_amount'] = round($cart_item->total_amount + $total_amount, 2);

            if ($product->is_taxable == 1) {
                $new_tax = $price * $qty * ($data['tax_percent'] / 100);
                $data['tax_amount'] = round($cart_item->tax_amount + $new_tax, 2);
            }

            $cart_item->update($data);
            return $cart_item;
        } else {
            $data['product_id'] = $product->id;
            $data['sku'] = $product->sku;
            $data['name'] = $product->title;
            $data['quantity'] = $qty;
            $data['total_amount'] = round($total_amount, 2);

            $cart->increment('items_count');
            return $cart->items()->create($data);
        }
    }

    public function calculateTotal($cart_id)
    {
        $cart = $this->findBy('id', $cart_id);
        $item_qty = 0;
        $total_amount = 0;
        $tax_total = 0;
        $discountAmount = $cart->discount_amount ?? 0;
        $grand_total = 0;

        if (!is_null($cart)) {
            foreach ($cart->items as $item) {
                $item_qty += $item->quantity;
                $total_amount += $item->total_amount;
                $tax_total += $item->tax_amount;
                $grand_total += $item->total_amount + $item->tax_amount;
            }

            $cart->update([
                'items_qty' => $item_qty,
                'total_amount' => round($total_amount, 2),
                'discount_amount' => $discountAmount,
                'tax_total' => round($tax_total, 2),
                'tax' => round($tax_total, 2),
                'grand_total' => round($grand_total - $discountAmount, 2),
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
        $price = $product->msrp;
        if ($product->total_stock < $qty) {
            return response()->json([
                'error' => true,
                'message' => 'Insufficient stock available.',
            ], 200);
        }
        DB::beginTransaction();
        try {
            $cart_item->quantity = $qty;
            $total_amount = $price * $qty;
            $cart->total_amount = $total_amount;



            if ($cart_item->tax_percent) {
                $new_tax_amount = $total_amount * ($cart_item->tax_percent / 100);
                $cart_item->tax_amount = $new_tax_amount;
            }

            $cart_item->total_amount = $total_amount;
            //  dd(  $cart_item->total_amount);
            $cart_item->save();
            // $cart->save();
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
            'discountType' => $this->checkIfCouponApplied()
        ], 200);
    }
    public function destroy($item_id)
    {
        $cart_item = CartItems::findOrFail($item_id);
        $cart_item->delete();

        $cart = Cart::find($cart_item->cart_id);
        $this->calculateTotal($cart->id);

        $discountType = $this->checkIfCouponApplied();

        return back()->with([
            'error' => 'Item was removed successfully from the cart',
            'discountType' => $discountType
        ]);
    }


    public function minicartItems()
    {
        $customer = Auth::user();
        if ($customer) {
            $cart = Cart::where('customer_id', $customer->id)->latest()->first();
        } else {
            $cart_id = Session::get('cart_id');
            if ($cart_id) {
                $cart = $this->findBy('id', $cart_id);
            } else {
                $cart = null;
            }
        }
        $count = 0;
        if ($cart) {
            $count = count($cart?->items);
        }
        return [
            'html' => view('frontend.pages.minicart', compact('cart'))->render(),
            'count' => $count
        ];
    }

    public function checkIfCouponApplied(): array|null
    {
        $customer = Auth::user();

        if (!$customer) {
            return null;
        }
        $cart = $customer->cart;
        if ($cart && $cart->discount_id) {
            return [
                'code' => $cart->discount_code,
                'type' => 'Cart',
                'id' => $cart->id,
                'amount' => $cart->discount_amount
            ];
        }

        $cartItem = $cart?->items()->whereNotNull('discount_id')->first();
        if ($cartItem?->discount_id) {
            return [
                'code' => $cartItem->discount_code,
                'type' => 'CartItem',
                'id' => $cartItem->id,
                'amount' => $cartItem->discount_amount
            ];
        }

        return null;
    }

    public function applyCoupon()
    {
        $code = request()->input('coupon');
        // $code = $request->input('coupon_code'); 
        $customer = Auth::user();
        // dd($code);

        if (!$customer) {
            return null;
        }
        $cart = $customer->cart;

        //check code exist or not
        $checkIfExist = Discount::where('code', $code)->first();
        // dd($checkIfExist);
        if (is_null($checkIfExist)) {
            return response()->json([
                'success' => false,
                'message' => 'Coupon code does not exist'
            ]);
        }

        //check if code is expired or not 
        if ($checkIfExist->expiry_date) {

            $currentDate = Carbon::now();
            $startDate = Carbon::parse($checkIfExist->start_date);
            $couponDate = Carbon::parse($checkIfExist->expiry_date);

            if (!$currentDate->gte($startDate) && !$currentDate->lte($couponDate)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Coupon code has expired'
                ]);
            }
        }

        //check for specific products
        if ($checkIfExist->applicable_for == 2) {
            $sku = explode(",", trim($checkIfExist->sku));
            return $this->handleDiscountCartItem($cart, 'sku', $sku, $checkIfExist);
        }

        $response = $this->applyDiscount($checkIfExist, $cart);
        return response()->json([
            'success' => $response['success'],
            'message' => $response['message'],
            'cart' => $customer->cart,
            'discountType' => $this->checkIfCouponApplied(),
            'data' => [
                'name' => $checkIfExist->code
            ]
        ]);

    }

    public function removeCoupon()
    {
        $customer = Auth::user();

        if (!$customer) {
            return null;
        }
        //remove code and calculate the amount again
        $id = request()->id;
        $type = request()->type;

        $item = $type == 'Cart' ? Cart::find($id) : CartItems::find($id);

        $discountAmount = $item->discount_amount;
        $subTotal = $item->total_amount;
        $grandTotal = $item->grand_total + $discountAmount;

        $item->update([
            'discount_id' => null,
            'discount_code' => null,
            'discount_type' => null,
            'discount_value' => null,
            'discount_amount' => 0,
            'total_amount' => $subTotal,
            'grand_total' => $grandTotal
        ]);

        if ($item->cart) {
            $cart = $item->cart;
            $cart->update([
                'discount_amount' => 0,
                'total_amount' => $cart->total_amount,
                'grand_total' => $cart->grand_total + $discountAmount
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Discount coupon removed successfully',
            'cart' => $customer->cart,
            'discountType' => $this->checkIfCouponApplied()
        ]);
    }


    public function applyDiscount($discount, $type): array
    {
        $discountValue = $discount->value;
        // dd($discountValue);
        $amount = $type->total_amount;
        // dd($discount->type);

        $discountAmount = 0;

        if ($discount->type == 2) {
            $discountAmount = $discountValue * $amount / 100;
        } else {
            $discountAmount = $discountValue;
        }


        $subTotal = $amount;
        $grandTotal = $type->grand_total - $discountAmount;

        $type->update([
            'discount_id' => $discount->id,
            'discount_code' => $discount->code,
            'discount_type' => $discount->type,
            'discount_value' => $discount->value,
            'discount_amount' => $discountAmount,
            'total_amount' => $subTotal,
            'grand_total' => $grandTotal
        ]);
        // dd($type);
        if ($type->cart) {
            $cart = $type->cart;
            $cart->update([
                'discount_amount' => $discountAmount,
                'total_amount' => $cart->total_amount,
                'grand_total' => $cart->grand_total - $discountAmount
            ]);
        }

        return [
            'success' => true,
            'message' => 'Discount coupon has been added successfully'
        ];
    }

    public function handleDiscountCartItem($cart, $column, $find, $discount)
    {
        $customer = Auth::user();

        if (!$customer) {
            return null;
        }
        $cartItem = null;
        foreach ($cart->items as $item) {
            if (in_array($item[$column], $find)) {
                $cartItem = $item->id;
                break;
            }
        }
        if ($cartItem) {
            //update discount values
            $response = $this->applyDiscount($discount, CartItems::find($cartItem));
            return response()->json([
                'success' => $response['success'],
                'message' => $response['message'],
                'cart' => $customer->cart,
                'discountType' => $this->checkIfCouponApplied(),
                'data' => [   
                    'name' => $discount->code
                ]
            ]);
        }
        return response()->json([
            'success' => false,
            'message' => 'Coupon code is not applicable for the added products'
        ]);
    }

    public function deliveryLocation(Request $request)
    {
        $customer = Auth::user();
        $cart = Cart::where('customer_id', $customer->id)->first();
        $cart->update([
            'type' => $request->type,
            'city' => $request->city,
            'date' => $request->date,
            'time' => $request->time,
            'price' => $request->price,
            'min_price' => $request->min_price,
        ]);
        return response()->json([
            'success' => true,
        ], 200);
    }
}
