<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Orders;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function __construct(public Orders $order)
    {
    }

    public function index()
    {
        $searchColumns = ['id', 'name', 'email', 'order_date', 'status'];
        $search = request()->search;
        $order = request()->orderedColumn;
        $orderBy = request()->orderBy;
        $paginate = request()->paginate;

        $query = $this->order->query();

        if ($search != '')
            $query->where(function ($q) use ($search, $searchColumns) {
                foreach ($searchColumns as $key => $value)
                    ($key == 0) ? $q->where($value, 'LIKE', '%' . $search . '%') : $q->orWhere($value, 'LIKE', '%' . $search . '%');
            });

        // sorting
        ($order == '') ? $query->orderByDesc('id') : $query->orderBy($order, $orderBy);

        $orders = $paginate ? $query->paginate($paginate)->appends(request()->query()) : $query->paginate(10)->appends(request()->query());

        return view('admin.orders.index', compact('orders'));
    }

    public function show(Orders $order)
    {
        return view('admin.orders.show', compact('order'));
    }

    public function destroy(string $id)
    {
        $type = request()->type;
        $selectedItems = request()->selectedIds;
        $status = request()->status;

        foreach ($selectedItems as $item) {
            $store = $this->order->find($item);
            if ($type == 1) {
                $store->admin->delete();
                $store->delete();
            } else if ($type == 2) {
                $store->update(['status' => $status]);
            }
        }
        return response()->json(['success' => true, 'message' => 'Bulk operation is completed']);
    }

    public function update(Request $request, Orders $order)
    {
        $order->update([
            'status' => $request->status,
            'comments' => $request->comments
        ]);

        return to_route('admin.orders.index')->with('success', 'Order updated successfully');
    }
}
