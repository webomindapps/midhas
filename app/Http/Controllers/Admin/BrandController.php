<?php

namespace App\Http\Controllers\Admin;

use App\Facades\Midhas;
use App\Http\Controllers\Controller;
use App\Http\Requests\BrandRequest;
use App\Models\Brand;
use Illuminate\Support\Str;

class BrandController extends Controller
{
    private $folder = 'brands/';
    public function __construct(public Brand $brand) {}
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $searchColumns = ['id', 'name', 'position', 'status'];
        $search = request()->search;
        $order = request()->orderedColumn;
        $orderBy = request()->orderBy;
        $paginate = request()->paginate;

        $query = $this->brand->query();

        if ($search != '')
            $query->where(function ($q) use ($search, $searchColumns) {
                foreach ($searchColumns as $key => $value) ($key == 0) ? $q->where($value, 'LIKE', '%' . $search . '%') : $q->orWhere($value, 'LIKE', '%' . $search . '%');
            });

        // sorting
        ($order == '') ? $query->orderByDesc('id') : $query->orderBy($order, $orderBy);

        $brands = $paginate ? $query->paginate($paginate)->appends(request()->query()) : $query->paginate(10)->appends(request()->query());
        return view('admin.masters.brands.index', compact('brands'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.masters.brands.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BrandRequest $request)
    {
        $data = $request->validated();
        $data['slug'] = Str::slug($data['slug'] ? $data['slug'] : $data['name'], '-');
        $brand = $this->brand->create($data);

        //upload thumbnail
        if ($request->hasFile('thumbnail')) {
            $url = Midhas::upload($request->file('thumbnail'), $this->folder);
            $brand->image()->create(['url' => $url]);
        }

        return to_route('admin.masters.brands.index')->with('success', 'Brand Added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Brand $brand)
    {
        return view('admin.masters.brands.show', compact('brand'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $brand = $this->brand->find($id);
        return view('admin.masters.brands.edit', compact('brand'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BrandRequest $request, string $id)
    {
        $brand = $this->brand->find($id);

        $data = $request->validated();
        $data['slug'] = Str::slug($data['slug'] ? $data['slug'] : $data['name'], '-');
        $brand->update($data);

        //upload thumbnail
        if ($request->hasFile('thumbnail')) {
            $url = Midhas::upload($request->file('thumbnail'), $this->folder);
            $brand->image ? $brand->image()->update(['url' => $url]) : $brand->image()->create(['url' => $url]);
        }

        return to_route('admin.masters.brands.index')->with('success', 'Brand Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $type = request()->type;
        $selectedItems = request()->selectedIds;
        $status = request()->status;

        foreach ($selectedItems as $item) {
            $brand = $this->brand->find($item);
            if ($type == 1) {
                $brand->deleteMany();
            } else if ($type == 2) {
                $brand->update(['status' => $status]);
            }
        }
        return response()->json(['success' => true, 'message' => 'Bulk operation is completed']);
    }

    public function delete(string $id)
    {
        $brand = $this->brand->find($id);
        $brand->deleteMany();
        return to_route('admin.masters.brands.index')->with('success', 'Brand Deleted successfully');
    }
}
