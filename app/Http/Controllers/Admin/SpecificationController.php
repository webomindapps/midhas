<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SpecificationRequest;
use App\Models\Specification;

class SpecificationController extends Controller
{
    public function __construct(public Specification $specification) {}
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

        $query = $this->specification->query();

        if ($search != '')
            $query->where(function ($q) use ($search, $searchColumns) {
                foreach ($searchColumns as $key => $value) ($key == 0) ? $q->where($value, 'LIKE', '%' . $search . '%') : $q->orWhere($value, 'LIKE', '%' . $search . '%');
            });

        // sorting
        ($order == '') ? $query->orderByDesc('id') : $query->orderBy($order, $orderBy);

        $specifications = $paginate ? $query->paginate($paginate)->appends(request()->query()) : $query->paginate(10)->appends(request()->query());
        return view('admin.masters.specifications.index', compact('specifications'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.masters.specifications.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SpecificationRequest $request)
    {
        $data = $request->validated();
        $specification = $this->specification->create($data);
        return to_route('admin.masters.specifications.index')->with('success', 'Specification Added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $specification = $this->specification->find($id);
        return view('admin.masters.specifications.edit', compact('specification'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(specificationRequest $request, string $id)
    {
        $specification = $this->specification->find($id);

        $data = $request->validated();
        $specification->update($data);
        return to_route('admin.masters.specifications.index')->with('success', 'Specification Updated successfully');
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
            $specification = $this->specification->find($item);
            if ($type == 1) {
                $specification->deleteMany();
            } else if ($type == 2) {
                $specification->update(['status' => $status]);
            }
        }
        return response()->json(['success' => true, 'message' => 'Bulk operation is completed']);
    }

    public function delete(string $id)
    {
        $specification = $this->specification->find($id);
        $specification->deleteMany();
        return to_route('admin.masters.specifications.index')->with('success', 'Specification Deleted successfully');
    }
}
