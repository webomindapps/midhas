<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Compare;
use App\Models\Specification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CompareController extends Controller
{

    public function index()
    {
        $user = Auth::check();
        $compares = [];
        $specifications = [];

        if ($user) {
            $compares = Compare::with('product')->where('user_id', Auth::user()->id)->get();
        }
        //check if session exist
        else if (session()->has('compare_ids')) {
            $compares = Compare::with('product')->whereIn('id', session('compare_ids'))->get();
        }

        if (count($compares) > 0) {
            $specifications = Specification::whereHas('products', function ($q) use ($compares) {
                $q->whereIn('product_id', $compares->pluck('product_id'));
            })->get();
        }

        return view('frontend.pages.compare.index', compact('compares', 'specifications'));
    }

    public function store(Request $request)
    {
        $checkUserLogin = Auth::check();
        $product_id = $request->product_id;

        $compared = true; // default
        $message = '';
        $type = '';

        if ($checkUserLogin) {
            $user = Auth::user();

            if (Compare::where('user_id', $user->id)->count() == 4) {
                return response()->json([
                    'success' => true,
                    'message' => 'More than 4 items cannot be added',
                    'type' => 'alert-warning',
                    'compared' => true,
                ]);
            }

            $checkIfExist = Compare::where('user_id', $user->id)
                ->where('product_id', $product_id)
                ->first();

            if ($checkIfExist) {
                $checkIfExist->delete();
                $message = 'Product removed from compare successfully';
                $type = 'alert-danger';
                $compared = false;
            } else {
                Compare::create([
                    'user_id' => $user->id,
                    'product_id' => $product_id
                ]);
                $message = 'Product added to compare successfully';
                $type = 'alert-success';
                $compared = true;
            }
        } else if (session()->has('compare_ids')) {
            if (Compare::whereIn('id', session('compare_ids'))->count() == 4) {
                return response()->json([
                    'success' => true,
                    'message' => 'More than 4 items cannot be added',
                    'type' => 'alert-warning',
                    'compared' => true,
                ]);
            }

            $checkIfExist = Compare::whereIn('id', session('compare_ids'))
                ->where('product_id', $product_id)
                ->first();

            if ($checkIfExist) {
                $checkIfExist->delete();
                $message = 'Product removed from compare successfully';
                $type = 'alert-danger';
                $compared = false;
            } else {
                $compare = Compare::create([
                    'product_id' => $product_id
                ]);
                Session::push('compare_ids', $compare->id);
                $message = 'Product added to compare successfully';
                $type = 'alert-success';
                $compared = true;
            }
        } else {
            $compare = Compare::create([
                'product_id' => $product_id
            ]);
            Session::push('compare_ids', $compare->id);

            $message = 'Product added to compare successfully';
            $type = 'alert-success';
            $compared = true;
        }

        return response()->json([
            'message' => $message,
            'type' => $type,
            'compared' => $compared
        ]);
    }



    public function destroy($id)
    {
        Compare::find($id)->delete();
        return response()->json([
            'success' => true,
            'message' => 'Product removed successfully',
            'type' => 'alert-success'
        ]);
    }
}
