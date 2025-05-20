<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Orders;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        $searchColumns = ['id', 'name', 'email'];

        $search = request()->search;
        $paginate = request()->paginate ?? 10;

        $query = Orders::where('user_id', Auth::user()->id);

        if ($search != '')
            $query->where(function ($q) use ($search, $searchColumns) {
                foreach ($searchColumns as $key => $value)
                    ($key == 0) ? $q->where($value, 'LIKE', '%' . $search . '%') : $q->orWhere($value, 'LIKE', '%' . $search . '%');
            });

        $orders = $query->paginate($paginate);

        return view('frontend.pages.profile.orders.index', compact('orders', 'search', 'paginate'));
    }


    public function show(Orders $order)
    {
        return view('frontend.pages.profile.orders.view', compact('order'));
    }
}
