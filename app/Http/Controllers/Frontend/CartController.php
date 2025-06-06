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

        return view('frontend.pages.cart', compact('cartItems'));
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
        $discount = $cart->discount_amount ?? 0;
        $grand_total = 0;

        if (!is_null($cart)) {
            foreach ($cart->items as $item) {
                $item_qty += $item->quantity;
                $total_amount += $item->total_amount;
                $tax_total += $item->tax_amount;
                $discount += $item->discount_amount;
                $grand_total += $item->total_amount + $item->tax_amount;
            }

            $cart->update([
                'items_qty' => $item_qty,
                'total_amount' => round($total_amount, 2),
                'discount_amount' => round($discount, 2),
                'tax_total' => round($tax_total, 2),
                'tax' => round($tax_total, 2),
                'grand_total' => round($grand_total - $discount, 2),
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
            $discount_amount = 0;
            $cart_item->quantity = $qty;
            $total_amount = $price * $qty;
            $sub_total = $cart->total_amount;
            if ($cart->discount_type == 2) {
                $discount_amount = ($sub_total * $cart->discount_value) / 100;
            } elseif ($cart->discount_type == 1) {

                $discount_amount = $cart->discount_value ?? 0;
            }

            $cart->discount_amount = $discount_amount;

            if ($cart_item->tax_percent) {
                $new_tax_amount = $total_amount * ($cart_item->tax_percent / 100);
                $cart_item->tax_amount = $new_tax_amount;
            }

            $cart_item->total_amount = $total_amount;
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

    // public function miniCartItems()
    // {
    //     $cartItems = session()->get('cart', []);
    //     $count = count($cartItems);
    //     $html = view('partials.minicart-items', compact('cartItems'))->render();

    //     return response()->json([
    //         'count' => $count,
    //         'html' => $html,
    //     ]);
    // }

    public function applyCoupon(Request $request)
    {
        $code = $request->coupon;
        $coupon = Discount::where('code', $code)->first();

        if (!$coupon) {
            return response()->json([
                'success' => false,
                'error' => 'Coupon not found'
            ]);
        }

        $cart = Auth::check()
            ? Cart::where('customer_id', Auth::id())->latest()->first()
            : Cart::find(Session::get('cart_id'));

        if (!$cart) {
            return response()->json([
                'error' => true,
                'message' => 'Cart not found'
            ]);
        }
        if (!$this->checkCouponValidity($coupon)) {
            return response()->json([
                'error' => true,
                'message' => 'Coupon expired or not active'
            ]);
        }

        if ($coupon->limit > 0) {
            $used = Cart::where('discount_code', $coupon->code)->count();
            if ($used >= $coupon->limit) {
                return response()->json([
                    'error' => true,
                    'message' => 'Coupon usage limit reached'
                ]);
            }
        }
        if ($coupon->applicable_for == 2 && !empty($coupon->sku)) {
            $skuList = explode(',', $coupon->sku);
            $matchedItem = $cart->items->firstWhere(fn($item) => in_array($item->sku, $skuList));

            if ($matchedItem) {
                $this->applyDiscount($matchedItem, $coupon);
            } else {
                return response()->json([
                    'error' => true,
                    'message' => 'Coupon is not applicable for items in your cart'
                ]);
            }
        } else {
            $this->applyDiscount($cart, $coupon);
        }

        $this->calculateTotal($cart->id);

        return response()->json([
            'success' => true,
            'message' => 'Coupon applied successfully',
            'data' => [ // <-- THIS is what your JS expects
                'name' => $coupon->code,
                'discount_type' => $coupon->type,
                'discount_value' => $coupon->value,
                'discount_limit' => $coupon->limit

            ],
            'cart' => $cart->fresh(),
            'discountType' => $this->checkIfCouponApplied($cart)
        ]);
    }

    public function checkCouponValidity(Discount $coupon): bool
    {
        $now = Carbon::now();
        $from = $coupon->from ? Carbon::parse($coupon->from) : null;
        $to = $coupon->expiry_date ? Carbon::parse($coupon->expiry_date) : null;

        return (!$from || $now->gte($from)) && (!$to || $now->lte($to));
    }


    public function applyDiscount($cart, Discount $coupon): void
    {
        $amount = $cart->total_amount;
        $discountAmount = $coupon->type == 2 ? round(($coupon->value / 100) * $amount, 2) : $coupon->value;

        $cart->update([
            'discount_id' => $coupon->id,
            'discount_code' => $coupon->code,
            'discount_type' => $coupon->type,
            'discount_value' => $coupon->value,
            'discount_amount' => $discountAmount,
            'total_amount' => $amount - $discountAmount,
            'grand_total' => ($cart->grand_total ?? $amount) - $discountAmount
        ]);
    }

    public function removeCoupon(Request $request)
    {
        $id = $request->id;
        $type = $request->type;

        if ($type === 'Cart') {
            $model = Cart::find($id);
        } else {
            $model = \App\Models\CartItems::find($id);
        }

        if (!$model) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid cart or item ID.'
            ], 404);
        }

        $originalSubTotal = $model->total_amount + $model->discount_amount;
        $originalGrandTotal = $model->grand_total + $model->discount_amount;

        $model->update([
            'discount_id' => null,
            'discount_code' => null,
            'discount_type' => null,
            'discount_value' => null,
            'discount_amount' => 0,
            'total_amount' => $originalSubTotal,
            'grand_total' => $originalGrandTotal
        ]);

        $cart = $type === 'Cart' ? $model : ($model->cart ?? null);

        if (!$cart) {
            return response()->json(['success' => false, 'message' => 'Cart not found.'], 404);
        }

        $this->calculateTotal($cart->id);

        return response()->json([
            'success' => true,
            'cart' => $cart->fresh(),
            'discountType' => $this->checkIfCouponApplied($cart)
        ]);
    }

    public function removeCoupons(Request $request)
    {
        $id = $request->id;
        $type = $request->type;

        $model =  Cart::where('discount_id', $id)->first();

        if (!$model) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid cart or item ID.'
            ], 404);
        }

        $originalSubTotal = $model->total_amount + $model->discount_amount;
        $originalGrandTotal = $model->grand_total + $model->discount_amount;

        $model->update([
            'discount_id' => null,
            'discount_code' => null,
            'discount_type' => null,
            'discount_value' => null,
            'discount_amount' => 0,
            'total_amount' => $originalSubTotal,
            'grand_total' => $originalGrandTotal
        ]);

        $cart =  $model;
        $this->calculateTotal($cart->id);

        return redirect()->back()->with('message', 'Coupon Removed successfully');
    }


    public function checkIfCouponApplied($cart): ?array
    {
        if ($cart && $cart->discount_id) {
            return [
                'code' => $cart->discount_code,
                'type' => 'Cart',
                'id' => $cart->id,
                'amount' => $cart->discount_amount
            ];
        }

        // $cartItem = $cart?->items()->whereNotNull('discount_id')->first();
        // if ($cartItem) {
        //     return [
        //         'code' => $cartItem->discount_code,
        //         'type' => 'CartItem',
        //         'id' => $cartItem->id,
        //         'amount' => $cartItem->discount_amount
        //     ];
        // }

        return null;
    }
    // public function checkCoupon(Discount $coupon)
    // {
    //     if ($coupon && $coupon->expiry_date) {
    //         $today = Carbon::today();
    //         $expiry = Carbon::parse($coupon->expiry_date);
    //         return $today->lessThanOrEqualTo($expiry);
    //     }
    //     return false;
    // }


}
