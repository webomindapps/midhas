<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Http\Controllers\Controller;
use App\Models\Filter;
use App\Models\FilterItem;
use App\Models\FilterItemSpecification;
use Illuminate\Http\Request;

class FilterController extends Controller
{

    public function __construct(public Filter $filter) {}
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $searchColumns = ['id', 'category_id', 'sub_category_id', 'filter_for', 'rate'];
        $search = request()->search;
        $order = request()->orderedColumn;
        $orderBy = request()->orderBy;
        $paginate = request()->paginate;

        $query = $this->filter->query();

        if ($search != '')
            $query->where(function ($q) use ($search, $searchColumns) {
                foreach ($searchColumns as $key => $value) ($key == 0) ? $q->where($value, 'LIKE', '%' . $search . '%') : $q->orWhere($value, 'LIKE', '%' . $search . '%');
            });

        // sorting
        ($order == '') ? $query->orderByDesc('id') : $query->orderBy($order, $orderBy);

        $filters = $paginate ? $query->paginate($paginate)->appends(request()->query()) : $query->paginate(10)->appends(request()->query());
        return view('admin.settings.filters.index', compact('filters'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.settings.filters.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'category_id' => 'required',
            'sub_category_id' => 'required|unique:filters,sub_category_id'
        ]);

        $names = $request->name;
        $positions = $request->position;
        $filter_types = $request->filter_types;
        $is_specifications = $request->is_specification;
        $specifications = $request->specifications;
        $column_names = $request->column_names;

        foreach ($request->filter_for as $key => $filter_for) {
            $filter = $this->filter->create([
                'category_id' => $request->category_id,
                'sub_category_id' => $request->sub_category_id,
                'filter_for' => $filter_for
            ]);

            if (isset($names[$key])) {
                foreach ($names[$key] as $itemKey => $name) {
                    $filterItem = $filter->items()->create([
                        'name' => $name,
                        'position' => $positions[$key][$itemKey],
                        'type' => $filter_types[$key][$itemKey],
                        // 'is_specification' => $is_specifications[$key][$itemKey],
                        'column_name' => $column_names[$key][$itemKey],
                    ]);

                    // if ($is_specifications[$key][$itemKey]) {
                    //     foreach (json_decode($specifications[$key][$itemKey]) as $spec) {
                    //         $filterItem->filterSpecificationItems()->create([
                    //             'specification_id' => $spec->id,
                    //             'specification_name' => $spec->name,
                    //         ]);
                    //     }
                    // }
                }
            }
        }

        return to_route('admin.settings.filters.index')->with('success', 'Filter added successfully');
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
        $filter = Filter::find($id);

        $listFilter = null;
        $detailFilter = null;

        if ($filter->filter_for == 'List') {
            $listFilter = $filter;
            $detailFilter = Filter::where([
                'category_id' => $filter->category_id,
                'sub_category_id' => $filter->sub_category_id,
                'filter_for' => 'Details'
            ])->first();
        }
        if ($filter->filter_for == 'Details') {
            $detailFilter = $filter;
            $listFilter = Filter::where([
                'category_id' => $filter->category_id,
                'sub_category_id' => $filter->sub_category_id,
                'filter_for' => 'List'
            ])->first();
        }

        return view('admin.settings.filters.edit', compact('filter', 'listFilter', 'detailFilter'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //delete items 
        $deletedFilterItems =  json_decode($request->deletedFilterItems);
        $deletedFilterSpecification = json_decode($request->deletedFilterSpecification);

        foreach ($deletedFilterSpecification as $specificationID) {
            FilterItemSpecification::find($specificationID)->delete();
        }

        foreach ($deletedFilterItems as $filterItemId) {
            FilterItem::find($filterItemId)->delete();
        }

        //insert record
        $filter_item_ids = $request->filter_item_id;
        $names = $request->name;
        $positions = $request->position;
        $filter_types = $request->filter_types;
        $is_specifications = $request->is_specification;
        $specifications = $request->specifications;
        $column_names = $request->column_names;

        foreach ($request->filter_id as $key => $filter_id) {

            $filter = $this->filter->find($filter_id);

            if (isset($names[$key])) {
                foreach ($names[$key] as $itemKey => $name) {

                    if ($filter_item_ids[$key][$itemKey]) {
                        $filterItem =  FilterItem::find($filter_item_ids[$key][$itemKey]);
                        $filterItem->update([
                            'name' => $name,
                            'position' => $positions[$key][$itemKey],
                            'type' => $filter_types[$key][$itemKey],
                            // 'is_specification' => $is_specifications[$key][$itemKey],
                            'column_name' => $column_names[$key][$itemKey],
                        ]);
                    } else {
                        $filterItem = $filter->items()->create([
                            'name' => $name,
                            'position' => $positions[$key][$itemKey],
                            'type' => $filter_types[$key][$itemKey],
                            // 'is_specification' => $is_specifications[$key][$itemKey],
                            'column_name' => $column_names[$key][$itemKey],
                        ]);
                    }

                    if (count($filterItem->filterSpecificationItems) > 0) {
                        $filterItem->filterSpecificationItems()->delete();
                    }

                    // if ($is_specifications[$key][$itemKey]) {
                    //     foreach (json_decode($specifications[$key][$itemKey]) as $spec) {
                    //         $filterItem->filterSpecificationItems()->create([
                    //             'specification_id' => $spec->id,
                    //             'specification_name' => $spec->name,
                    //         ]);
                    //     }
                    // }
                }
            }
        }

        return to_route('admin.settings.filters.index')->with('success', 'Filter updated successfully');
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
            $filter = $this->filter->find($item);
            if ($type == 1) {
                $filter->delete();
            } else if ($type == 2) {
                $filter->update(['status' => $status]);
            }
        }
        return response()->json(['success' => true, 'message' => 'Bulk operation is completed']);
    }
}
