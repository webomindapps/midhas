<?php

namespace App\Http\Controllers\Frontend;

use App\Events\OrderCreatedEvent;
use Exception;
use App\Models\Cart;
use App\Models\Orders;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\DeliveryCity;
use App\Models\OrderAddress;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CheckoutController extends Controller
{
    public function index()
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

        if (is_null($cart)) {
            return redirect()->route('cart');
        }
        if ($cart && $cart->total_amount < 0 && $cart->type == 'delivery') {
            return redirect()->route('cart')->with('error', 'For delivery minimum amount should 50$');
        }
        $delivery_city = '';
        if ($cart->type == 'delivery') {
            $city = DeliveryCity::find($cart->city);
            $delivery_city = $city->city;
        } else {
            $delivery_city = 'Midhas';
        }

        return view('frontend.pages.checkout.index', compact('cart','delivery_city'));
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
                'delivery_date'=>$cart->date,
                'delivery_time'=>$cart->time,
                'delivery_city'=>$request->delivery_city,
                'delivery_price'=>$request->price,
            ]);



            foreach ($cart->items as $item) {
                // dd($item->product->brand_id);
                $order->items()->create([
                    'product_id' => $item->product_id,
                    'name' => $item->name,
                    'sku' => $item->sku ?? null,
                    'upc_code' => $item->upc_code ?? null,
                    'brand_id' => $item->product->brand_id ?? null,
                    'price' => $item->price,
                    'qty' => $item->quantity, // assuming $item->quantity is the correct field
                    'sub_total' => $item->price * $item->quantity,
                    'tax_percent' => $item->tax_percent ?? 0,
                    'tax_amount' => $item->tax_amount ?? 0,
                    'grand_total' => ($item->price * $item->quantity) + ($item->tax_amount ?? 0),
                ]);

                if ($item->product?->stock !== null) {
                    $item->product->decrement('stock', $item->quantity);
                }
            }

            if ($item->product?->stock !== null) {
                $item->product->decrement('stock', $item->quantity);
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
        $customer_id=Auth::user()->id;
        $address_type = $type;

        if ($request->isShippingInformation == '1' || $request->isShippingInformation == 1) {
            $type = 'shipping';
        }

        $address = $order->addresses()->create([
            'address_type' => $address_type,
            'customer_id'=>$customer_id,
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
        // dd($address);
    }
    public function status(Orders $order)
    {
        return view('frontend.pages.checkout.status', compact('order'));
    }
}
