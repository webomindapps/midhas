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
use App\Models\ProductAccessories;
use App\Models\ProductAccessoryCart;
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
            $variant_id = $request->variant_id;
            $accessoryIds = $request->accessory_ids;
            $accessory_price = $request->accessory_price;
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
            $cart_item = $this->cartItemCreate($cart, $product_id, $qty, $variant_id, $accessory_price, $accessoryIds);
            // dd($cart_item);
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

    public function cartItemCreate($cart, $product_id, $qty, $variant_id = null, $accessory_prices = [], $accessoryIds = [])
    {
        $product = Product::findOrFail($product_id);

        // Base product price (variant price if applicable)
        $price = $product->currentPrice();
        $variant = $product->variants()->find($variant_id);
        $variant_name = $variant?->value;

        if ($variant_id && $variant) {
            $price = $variant->price;
        }

        // Accessory total (for cart total later)
        $accessory_total = 0;
        if (is_array($accessory_prices)) {
            $accessory_total = array_sum(array_map('floatval', $accessory_prices));
        } elseif (!empty($accessory_prices)) {
            $accessory_total = floatval($accessory_prices);
        }

        // Item total = only product price × qty
        $item_total_amount = $price * $qty;

        $cart_item = CartItems::where('cart_id', $cart->id)
            ->where('product_id', $product->id)
            ->where('variant_id', $variant_id)
            ->where('variant_name', $variant_name)
            ->first();

        $data = [
            'price' => $price, // only product price
        ];

        if ($product->tax_id) {
            $tax_percent = $product->tax?->percent ?? 13;
            $data['tax_percent'] = $tax_percent;
            $data['tax_amount'] = round($item_total_amount * ($tax_percent / 100), 2);
        } else {
            $data['tax_percent'] = 0;
            $data['tax_amount'] = 0;
        }

        if ($cart_item) {
            $data['variant_id'] = $variant_id;
            $data['quantity'] = $cart_item->quantity + $qty;
            $data['price'] = $price;
            $data['total_amount'] = round($data['quantity'] * $price, 2); // only product price

            if ($product->tax_id) {
                $new_tax = ($price * $qty) * ($data['tax_percent'] / 100);
                $data['tax_amount'] = round($cart_item->tax_amount + $new_tax, 2);
            }

            $cart_item->update($data);
        } else {
            $data['variant_id'] = $variant_id;
            $data['variant_name'] = $variant_name;
            $data['product_id'] = $product->id;
            $data['sku'] = $product->sku;
            $data['name'] = $product->title;
            $data['quantity'] = $qty;
            $data['total_amount'] = round($item_total_amount, 2);

            $cart->increment('items_count');
            $cart_item = $cart->items()->create($data);
        }

        // Save accessories for the item
        if (!empty($accessoryIds)) {
            ProductAccessoryCart::where('cart_item_id', $cart_item->id)->delete();
            foreach ($accessoryIds as $accessoryId) {
                $accessory = ProductAccessories::find($accessoryId);
                if ($accessory) {
                    ProductAccessoryCart::create([
                        'product_id'      => $product->id,
                        'cart_item_id'    => $cart_item->id,
                        'accessory_id'    => $accessory->id,
                        'accessory_name'  => $accessory->name ?? null,
                        'accessory_price' => $accessory->price ?? 0,
                    ]);
                }
            }
        }

        $cart_items_total = $cart->items()->sum('total_amount');
        $cart_items_tax   = $cart->items()->sum('tax_amount');

        $accessories_total = ProductAccessoryCart::whereIn(
            'cart_item_id',
            $cart->items()->pluck('id')
        )->sum('accessory_price');

        $cart_total_with_accessories = $cart_items_total + $accessories_total;


        $cart->update([
            'total_amount' => $cart_total_with_accessories,
            'tax_amount'   => $cart_items_tax,
            'grand_total'  => $cart_total_with_accessories + $cart_items_tax
        ]);

        return $cart_item;
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
                $total_amount += $item->total_amount; // product only
                $tax_total += $item->tax_amount;
                $grand_total += $item->total_amount + $item->tax_amount;
            }

            // Get accessory total for the whole cart
            $accessory_total = ProductAccessoryCart::whereIn(
                'cart_item_id',
                $cart->items()->pluck('id')
            )->sum('accessory_price');

            // Add accessories to totals
            $total_amount += $accessory_total;
            $grand_total += $accessory_total; // tax is separate unless you want tax on accessories

            $cart->update([
                'items_qty'        => $item_qty,
                'total_amount'     => round($total_amount, 2),
                'discount_amount'  => $discountAmount,
                'tax_total'        => round($tax_total, 2),
                'tax'              => round($tax_total, 2),
                'grand_total'      => round($grand_total - $discountAmount, 2),
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
        $price = $cart_item->price;


        if ($cart_item->variant) {
            $price = $cart_item->variant?->price;
        }
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
        $cart_item->addons()->delete();

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
    public function deleteaddons($id)
    {
        $addons = ProductAccessoryCart::findOrFail($id);

        $cartId = $addons->cartitems->cart_id ?? null;

        $addons->delete();

        if ($cartId) {
            $this->calculateTotal($cartId);
        }

        return redirect()->back()->with('message', 'Addons deleted Successfully');
    }
    public function updateAddonQuantity(Request $request)
    {
        $request->validate([
            'addon_id' => 'required|integer',
            'quantity' => 'required|integer|min:1'
        ]);

        $addon = ProductAccessoryCart::findOrFail($request->addon_id);

        // Always use the accessory's base price (unit price)
        $unitPrice = $addon->accessory->price;

        // Update in DB
        $addon->accesory_qty = $request->quantity;
        $addon->accessory_price = $unitPrice * $request->quantity;
        $addon->save();
        $cartTotal = 0;
        // Recalculate cart total
        $cartTotal = $this->calculateTotal($addon->cartitems->cart_id);

        return response()->json([
            'success'      => true,
            'addon_total'  => number_format($addon->accessory_price, 2),
            'cart_total'   => $addon->cartitems->cart,
        ]);
    }
}
