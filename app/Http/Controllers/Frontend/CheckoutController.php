<?php

namespace App\Http\Controllers\Frontend;

use App\Events\OrderCreatedEvent;
use Exception;
use App\Models\Cart;
use App\Models\Orders;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\OrderAddress;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            $cart = Auth::user()->cart;
        } else {
            $cart_id = session('cart_id');
            $cart = $cart_id ? Cart::find($cart_id) : null;
        }

        if (is_null($cart)) {
            return to_route('home');
        }

        return view('frontend.pages.checkout.index', compact('cart'));
    }




    public function store(Request $request)
    {
        DB::beginTransaction();

        try {
            $user = Auth::user();
            $cart = $user?->cart;

            if (!$cart || $cart->items->isEmpty()) {
                return redirect()->route('home')->with('status', 'No Items in cart');
            }

            $this->addAddress('shipping', $cart, $request);
            $this->addAddress('billing', $cart, $request);

            $order = Orders::create([
                'user_id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'order_date' => now(),
                'total_items' => $cart->items_count,
                'total_qty' => $cart->items_qty,
                'discount_amount' => $cart->discount_amount ?? '',
                'sub_total' => $cart->total_amount,
                'tax_total' => $cart->tax_total,
                'grand_total' => $cart->grand_total,
            ]);

            foreach ($cart->items as $item) {
                $order->items()->create($item->toArray());

                if ($item->product?->stock !== null) {
                    $item->product->decrement('stock', $item->quantity);
                }
            }

            OrderAddress::where('cart_id', $cart->id)->update(['order_id' => $order->id]);

         
            DB::commit();
            OrderCreatedEvent::dispatch($order);

            return redirect()->route('checkout.status', ['order' => $order->id]);
        } catch (Exception $e) {
            DB::rollBack();
            dd($e);
        }
    }

    private function addAddress($type, $order, $request): void
    {
        $address_type = $type;

        if ($request->isShippingInformation == '1' || $request->isShippingInformation == 1) {
            $type = 'shipping';
        } else {
            $type = 'billing';
        }

        $order->addresses()->create([
            'address_type' => $address_type,
            'first_name' => $request[$type . '_first_name'],
            'last_name' => $request[$type . '_last_name'],
            'email' => $request[$type . '_email'],
            'company_name' => $request[$type . '_company_name'],
            'address_1' => $request[$type . '_address_1'],
            'address_2' => $request[$type . '_address_2'],
            'city' => $request[$type . '_city'],
            'province' => $request[$type . '_province'],
            'postal_code' => $request[$type . '_postal_code'],
            'contact_number' => $request[$type . '_contact_number'],
            'phone_number' => $request[$type . '_phone_number'],
            'alternate_number' => $request[$type . '_alternate_number'],
            'how_you_know_about_us' => $request[$type . '_how_you_know_about_us']
        ]);
    }
    public function status(Orders $order)
    {
        return view('frontend.pages.checkout.status', compact('order'));
    }
}
