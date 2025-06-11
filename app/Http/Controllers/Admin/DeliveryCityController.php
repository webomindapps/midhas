<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DeliveryCity;
use Illuminate\Http\Request;

class DeliveryCityController extends Controller
{
    public function __construct(public DeliveryCity $city) {}
    public function index()
    {
        $searchColumns = ['id', 'city', 'delivery_price'];
        $search = request()->search;
        $order = request()->orderedColumn;
        $orderBy = request()->orderBy;
        $paginate = request()->paginate;

        $query = $this->city->query();




        if ($search != '')
            $query->where(function ($q) use ($search, $searchColumns) {
                foreach ($searchColumns as $key => $value) ($key == 0) ? $q->where($value, 'LIKE', '%' . $search . '%') : $q->orWhere($value, 'LIKE', '%' . $search . '%');
            });

        // sorting
        ($order == '') ? $query->orderByDesc('id') : $query->orderBy($order, $orderBy);

        $deliverycities = $paginate ? $query->paginate($paginate)->appends(request()->query()) : $query->paginate(10)->appends(request()->query());
        return view('admin.deliverycity.index', compact('deliverycities'));
    }
    public function create()
    {
        return view('admin.deliverycity.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'city'                 => 'required',
            'delivery_price'       => 'required',
            'min_amt_for_shipping' => 'required',
        ]);
        $this->city->create($request->all());
        return redirect()->route('admin.settings.delivery-city.index')->with('success', 'Delivery city added successfully');
    }
    public function edit($id)
    {
        $deliverycity = $this->city->find($id);
        return view('admin.deliverycity.edit', compact('deliverycity'));
    }
    public function update(Request $request, $id)
    {
        $deliverycity = $this->city->find($id);
        $request->validate([
            'city'                 => 'required',
            'delivery_price'       => 'required',
            'min_amt_for_shipping' => 'required',
        ]);
        $deliverycity->update($request->all());
        return redirect()->route('admin.settings.delivery-city.index')->with('success', 'Delivery city updated successfully');
    }
    public function destroy(string $id)
    {
        $type = request()->type;
        $selectedItems = request()->selectedIds;
        $status = request()->status;

        foreach ($selectedItems as $item) {
            $deliverycity = $this->city->find($item);
            if ($type == 1) {
                $deliverycity->delete();
            } else if ($type == 2) {
                $deliverycity->update(['status' => $status]);
            }
        }
        return response()->json(['success' => true, 'message' => 'Bulk operation is completed']);
    }

    public function delete(string $id)
    {
        $deliverycity = $this->city->find($id);
        $deliverycity->deleteMany();
        return to_route('admin.settings.delivery-city.index')->with('success', 'Delivery City Deleted successfully');
    }

   
}
