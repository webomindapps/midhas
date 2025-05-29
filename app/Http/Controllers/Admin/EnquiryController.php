<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product\ProductEnquiry;

class EnquiryController extends Controller
{
    public function __construct(public ProductEnquiry $productEnquiry)
    {
    }

    public function index()
    {
        $searchColumns = ['id', 'product_name', 'sku', 'brand', 'name', 'phone'];
        $search = request()->search;
        $order = request()->orderedColumn;
        $orderBy = request()->orderBy;
        $paginate = request()->paginate;

        $query = $this->productEnquiry->query();

        if ($search != '')
            $query->where(function ($q) use ($search, $searchColumns) {
                foreach ($searchColumns as $key => $value)
                    ($key == 0) ? $q->where($value, 'LIKE', '%' . $search . '%') : $q->orWhere($value, 'LIKE', '%' . $search . '%');
            });

        // sorting
        ($order == '') ? $query->orderByDesc('id') : $query->orderBy($order, $orderBy);

        $enquiries = $paginate ? $query->paginate($paginate)->appends(request()->query()) : $query->paginate(10)->appends(request()->query());

        return view('admin.enquiries.index', compact('enquiries'));
    }

    public function show(string $id)
    {
        $enquiry = $this->productEnquiry->find($id);
        return view('admin.enquiries.show', compact('enquiry'));
    }

    public function update(Request $request, $id)
    {
        $enquiry = $this->productEnquiry->find($id);
        $enquiry->update(['status' => $request->status]);
        return to_route('admin.enquiries.index')->with('success', 'Enquiry updated successfully');
    }
}
