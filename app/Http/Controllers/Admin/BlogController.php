<?php

namespace App\Http\Controllers\Admin;

use App\Facades\Midhas;
use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Blogh;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{
    private $folder = 'blogs';
    public function __construct(public Blog $blog) {}
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $type = request()->type;
        $searchColumns = ['id', 'blog_title', 'blog_date', 'status'];
        $search = request()->search;
        $order = request()->orderedColumn;
        $orderBy = request()->orderBy;
        $paginate = request()->paginate;

        $query = $this->blog->query();
        if ($search != '')
            $query->where(function ($q) use ($search, $searchColumns) {
                foreach ($searchColumns as $key => $value) ($key == 0) ? $q->where($value, 'LIKE', '%' . $search . '%') : $q->orWhere($value, 'LIKE', '%' . $search . '%');
            });

        // sorting
        ($order == '') ? $query->orderByDesc('id') : $query->orderBy($order, $orderBy);

        $blogs = $paginate ? $query->paginate($paginate)->appends(request()->query()) : $query->paginate(10)->appends(request()->query());

        return view('admin.blogs.index', compact('blogs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.blogs.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'blog_title'       => 'required|string|max:255',
            'blog_date'        => 'required|date',
            'blog_description' => 'required|string',
            'blog_image'       => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);


        $blog = $this->blog->create($validatedData);
        if ($request->hasFile('blog_image')) {
            $file = $request->file('blog_image');
            $url = Midhas::upload($file, $this->folder);
            $blog->update([
                'blog_image' => $url
            ]);
        }
        Midhas::addSeo($blog, request()->only(['meta_title', 'meta_description', 'meta_keywords']));

        return redirect()->route('admin.cms.blogs.index')->with('success', 'Blog created successfully.');
    }




    /**
     * Display the specified resource.
     */
    public function show(Blog $blog)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $blogs = Blog::findOrFail($id);
        return view('admin.blogs.update', compact('blogs'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $blog = $this->blog->findOrFail($id);

        $validatedData = $request->validate([
            'blog_title'       => 'required|string|max:255',
            'blog_date'        => 'required|date',
            'blog_description' => 'required|string',
            'blog_image'       => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

      
        $blog->update($validatedData);

       
        if ($request->hasFile('blog_image')) {
          
            if ($blog->blog_image && Storage::disk('public')->exists($blog->blog_image)) {
                Storage::disk('public')->delete($blog->blog_image);
            }

            $url = Midhas::upload($request->file('blog_image'), $this->folder);
            $blog->update(['blog_image' => $url]);
        }

        return to_route('admin.cms.blogs.index')->with('success', 'Blog updated successfully.');
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
            $blog = $this->blog->find($item);
            if ($type == 1) {
                $blog->delete();
            } else if ($type == 2) {
                $blog->update(['status' => $status]);
            }
        }
        return response()->json(['success' => true, 'message' => 'Bulk operation is completed']);
    }
    public function delete($id)
    {
        $blogs = Blog::findOrFail($id);

    
        $blogs->delete();

        return redirect()->back()->with('success', 'Blogs deleted successfully.');
    }
}
