<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Orders;
use Illuminate\Http\Request;

class CancelController extends Controller
{
    public function __invoke(Request $request, Orders $order)
    {
        $order->update(['status' => 'cancelled']);
        return to_route('admin.orders.show', ['order' => $order->id])->with('success', 'Order cancelled successfully');
    }
}
