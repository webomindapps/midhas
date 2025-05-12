<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class WishListController extends Controller
{
    public function index()
    {
        $user = Auth::check();
        $wishlists = [];
        if ($user) {
            $wishlists = Wishlist::with('product')->where('user_id', auth()->user()->id)->get();
        }
        //check if session exist
        else if (session()->has('wishlist_ids')) {
            $wishlists = Wishlist::with('product')->whereIn('id', session('wishlist_ids'))->get();
        }

        return view('frontend.pages.profile.wishlists.index', compact('wishlists'));
    }

    public function store(Request $request)
    {
        $checkUserLogin = Auth::check();
        $product_id = $request->product_id;

        if ($checkUserLogin) {
            $user = Auth::user();
            $checkIfExist = Wishlist::where('user_id', $user->id)
                ->where('product_id', $product_id)
                ->first();

            if ($checkIfExist) {
                $checkIfExist->delete();
                $message = 'Product removed from wishlist successfully';
                $type = 'alert-danger';
                $wishlisted = false;
            } else {
                Wishlist::create([
                    'user_id' => $user->id,
                    'product_id' => $product_id
                ]);
                $message = 'Product added to wishlist successfully';
                $type = 'alert-success';
                $wishlisted = true;
            }
        } else {
            $wishlist_ids = session('wishlist_ids', []);
            $wishlistItems = Wishlist::whereIn('id', $wishlist_ids)->pluck('product_id')->toArray();

            if (in_array($product_id, $wishlistItems)) {
                $wishlistToRemove = Wishlist::whereIn('id', $wishlist_ids)
                    ->where('product_id', $product_id)
                    ->first();

                if ($wishlistToRemove) {
                    $wishlistToRemove->delete();

                    // Update session
                    session()->put('wishlist_ids', array_diff($wishlist_ids, [$wishlistToRemove->id]));

                    $message = 'Product removed from wishlist successfully';
                    $type = 'alert-danger';
                    $wishlisted = false;
                }
            } else {
                $wishlist = Wishlist::create([
                    'product_id' => $product_id
                ]);

                Session::push('wishlist_ids', $wishlist->id);

                $message = 'Product added to wishlist successfully';
                $type = 'alert-success';
                $wishlisted = true;
            }
        }

        return response()->json([
            'success' => true,
            'message' => $message,
            'type' => $type,
            'wishlisted' => $wishlisted ?? false
        ]);
    }

    public function destroy($id)
    {
        $wishlist = Wishlist::findOrFail($id);
        $wishlist->delete();
        return redirect()->back()->with('message', 'Wishlist  Deleted Sucessfully');
    }
}
