<?php

namespace App\Http\Controllers\Admin;

use App\Models\Pages;
use App\Facades\Midhas;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Requests\PageRequest;
use App\Http\Controllers\Controller;

class PageController extends Controller
{
    public function __construct(public Pages $pages)
    {
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $searchColumns = ['id', 'title', 'position', 'status'];
        $search = request()->search;
        $order = request()->orderedColumn;
        $orderBy = request()->orderBy;
        $paginate = request()->paginate;

        $query = $this->pages->query();

        if ($search != '')
            $query->where(function ($q) use ($search, $searchColumns) {
                foreach ($searchColumns as $key => $value)
                    ($key == 0) ? $q->where($value, 'LIKE', '%' . $search . '%') : $q->orWhere($value, 'LIKE', '%' . $search . '%');
            });

        // sorting
        ($order == '') ? $query->orderByDesc('id') : $query->orderBy($order, $orderBy);

        $pages = $paginate ? $query->paginate($paginate)->appends(request()->query()) : $query->paginate(10)->appends(request()->query());
        return view('admin.cms.pages.index', compact('pages'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.cms.pages.create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PageRequest $request)
    {
        $data = $request->validated();
        $data['slug'] = Str::slug($data['slug'] ? $data['slug'] : $data['title'], '-');

        $pages = $this->pages->create($data);
        Midhas::addSeo($pages, request()->only(['meta_title', 'meta_description', 'meta_keywords']));


        return to_route('admin.cms.pages.index')->with('success', 'Pages Added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pages $pages)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $page = Pages::findOrFail($id);
        return view('admin.cms.pages.edit', compact('page'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PageRequest $request, string $id)
    {
        $pages = $this->pages->find($id);

        $data = $request->validated();
        $data['slug'] = Str::slug($data['slug'] ? $data['slug'] : $data['title'], '-');
        $pages->update($data);

        Midhas::addSeo($pages, request()->only(['meta_title', 'meta_description', 'meta_keywords']), $id);

        return to_route('admin.cms.pages.index')->with('success', 'Pages updated successfully');
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
            $pages = $this->pages->find($item);
            if ($type == 1) {
                $pages->delete();
            } else if ($type == 2) {
                $pages->update(['status' => $status]);
           
            }
        }
        return response()->json(['success' => true, 'message' => 'Bulk operation is completed']);
    }
    public function delete($id)
    {
        $pages = Pages::findOrFail($id);
        $pages->delete();

        return redirect()->back()->with('success', 'Pages deleted successfully.');
    }
}
