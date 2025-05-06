<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishListController extends Controller
{
    public function index()
    {
        $wishlists = [];

        if (Auth::check()) {
            $wishlists = Wishlist::with('product')->where('user_id', auth()->id())->get();
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

            return response()->json([
                'success' => true,
                'message' => $message,
                'type' => $type,
                'wishlisted' => $wishlisted
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'User not authenticated.',
            'type' => 'alert-danger'
        ]);
    }
    public function destroy($id)
    {
        $wishlist = Wishlist::findOrFail($id);
        $wishlist->delete();
        return redirect()->back()->with('message','Wishlist  Deleted Sucessfully');
    }
}
