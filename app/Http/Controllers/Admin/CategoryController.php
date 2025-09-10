<?php

namespace App\Http\Controllers\Admin;

use App\Facades\Midhas;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    private $folder = 'categories/';
    public function __construct(public Category $category) {}
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

        $query = $this->category->query();

        if (session()->has('category')) {
            $query->category();
        } else {
            $query->whereNull('parent_id');
        }


        if ($search != '')
            $query->where(function ($q) use ($search, $searchColumns) {
                foreach ($searchColumns as $key => $value) ($key == 0) ? $q->where($value, 'LIKE', '%' . $search . '%') : $q->orWhere($value, 'LIKE', '%' . $search . '%');
            });

        // sorting
        ($order == '') ? $query->orderByDesc('id') : $query->orderBy($order, $orderBy);

        $categories = $paginate ? $query->paginate($paginate)->appends(request()->query()) : $query->paginate(10)->appends(request()->query());
        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {
        $data = $request->validated();
        $data['slug'] = Str::slug($data['slug'] ? $data['slug'] : $data['name'], '-');
        $category = $this->category->create($data);

        //upload thumbnail
        if ($request->hasFile('thumbnail')) {
            $url = Midhas::upload($request->file('thumbnail'), $this->folder);
            $category->image()->create(['url' => $url]);
        }

        //add seo contest
        Midhas::addSeo($category, request()->only(['meta_title', 'meta_description', 'meta_keywords']));

        return to_route('admin.categories.index')->with('success', 'Category Added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        return view('admin.categories.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category = $this->category->find($id);
        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $request, string $id)
    {
        $category = $this->category->find($id);

        $data = $request->validated();
        // $data['slug'] = Str::slug($data['slug'] ? $data['slug'] : $data['name'], '-');
        $category->update($data);

        //upload thumbnail
        if ($request->hasFile('thumbnail')) {
            $url = Midhas::upload($request->file('thumbnail'), $this->folder);
            $category->image ? $category->image()->update(['url' => $url]) : $category->image()->create(['url' => $url]);
        }

        //add seo contest
        Midhas::addSeo($category, request()->only(['meta_title', 'meta_description', 'meta_keywords']), $id);

        return to_route('admin.categories.index')->with('success', 'Category Updated successfully');
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
            $category = $this->category->find($item);
            if ($type == 1) {
                $category->delete();
            } else if ($type == 2) {
                $category->update(['status' => $status]);
            }
        }
        return response()->json(['success' => true, 'message' => 'Bulk operation is completed']);
    }

    public function delete(string $id)
    {
        $category = $this->category->find($id);
        $category->deleteMany();
        return to_route('admin.categories.index')->with('success', 'Category Deleted successfully');
    }
}
