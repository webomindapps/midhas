<?php

namespace App\Http\Controllers\Frontend;

use Carbon\Carbon;
use App\Models\Cart;
use App\Models\User;
use Illuminate\Http\Request;
use App\Mail\VerificationMail;
use App\Http\Controllers\Controller;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class LoginController extends Controller
{
    public function index()
    {
        return view('frontend.auth.login');
    }
    public function signup()
    {
        return view('frontend.auth.register');
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|same:conf_password',
        ]);

        // Create the user and log them in
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        if ($user) {
            Mail::to($user->email)->send(new VerificationMail($user));
        }
        return redirect()->route('customer.login')->with('message', 'User Registered Sucessfully');
    }

    public function authenticate(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            if (is_null($user->email_verified_at)) {
                Auth::logout();
                return back()->with('danger', 'Your account is not verified. Please check your email to verify your account.');
            }
            $this->updateCart();
            $this->syncWishlist($user);
            return redirect()->intended('cart')->with('message', 'Logged In Successfully.');
        } else {
            return back()->with('danger', 'Invalid credentials. Please try again.');
        }
    }

    public function verify()
    {
        return view('frontend.auth.email-verify');
    }

    public function verifyEmail(Request $request)
    {
        $customer = User::where('email', $request->email)->first();
        $customer->email_verified_at = Carbon::now();
        $customer->status = 1;
        $customer->save();
        return redirect()->route('customer.login');
    }
    public function updateCart()
    {
        $customer = Auth::user();
        $cart_id = session('cart_id');

        if (!is_null($cart_id)) {

            $cart = Cart::find($cart_id);
            //check if customer has already cart
            if ($customer->cart) {
                //load session cart and add it to customer cart id
                foreach ($cart->items as $item) {

                    foreach ($item->addons as $addon) {
                        app(CartController::class)->cartItemCreate(
                            $customer->cart,
                            $item->product_id,
                            $item->quantity,
                            $item->variant_id, // pass correct variant ID
                            $item->addons->pluck('price')->toArray(), // accessory prices
                            $item->addons->pluck('id')->toArray(),    // accessory IDs
                        );
                    }
                    app(CartController::class)->destroy($item->id);

                    //update cart total 
                }
                $customer->cart()->update([
                    'items_qty' => $customer->cart->items_qty + $cart->items_qty,
                    'total_amount' => $customer->cart->total_amount + $cart->total_amount,
                    'tax_total' => $customer->cart->tax_total + $cart->tax_total,
                    'grand_total' => $customer->cart->grand_total + $cart->grand_total,
                ]);

                //delete session cart
                $cart->delete();
            } else {
                $cart->update([
                    'customer_id' => $customer->id,
                    'name' => $customer->name,
                    'email' => $customer->email,
                ]);
            }

            app(CartController::class)->calculateTotal($cart_id);

            session()->forget('cart_id');
        }
    }
    protected function syncWishlist($user)
    {
        $wishlistIds = session('wishlist_ids', []);

        if (!empty($wishlistIds)) {
            $productIds = Wishlist::whereIn('id', $wishlistIds)
                ->pluck('product_id')
                ->toArray();

            foreach ($productIds as $productId) {
                $exists = Wishlist::where('user_id', $user->id)
                    ->where('product_id', $productId)
                    ->exists();

                if (!$exists) {
                    Wishlist::create([
                        'user_id' => $user->id,
                        'product_id' => $productId
                    ]);
                    Wishlist::whereIn('id', $wishlistIds)->delete();
                }
            }


            // Clear the session
            session()->forget('wishlist_ids');
        }
    }


    public function logout()
    {
        Auth::logout();
        return redirect('/')->with('message', 'Logged Out successfully.');
    }
}
