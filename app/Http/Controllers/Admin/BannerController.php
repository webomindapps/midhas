<?php

namespace App\Http\Controllers\Admin;

use App\Models\Banner;
use App\Facades\Midhas;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\BannerRequest;
use Illuminate\Support\Facades\Storage;

class BannerController extends Controller
{
    private $folder = 'banner/';
    public function __construct(public Banner $banner)
    {
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $searchColumns = ['id', 'type', 'position', 'status'];
        $search = request()->search;
        $order = request()->orderedColumn;
        $orderBy = request()->orderBy;
        $paginate = request()->paginate;

        $query = $this->banner->query();

        if ($search != '')
            $query->where(function ($q) use ($search, $searchColumns) {
                foreach ($searchColumns as $key => $value)
                    ($key == 0) ? $q->where($value, 'LIKE', '%' . $search . '%') : $q->orWhere($value, 'LIKE', '%' . $search . '%');
            });

        // sorting
        ($order == '') ? $query->orderByDesc('id') : $query->orderBy($order, $orderBy);

        $banners = $paginate ? $query->paginate($paginate)->appends(request()->query()) : $query->paginate(10)->appends(request()->query());
        return view('admin.cms.banner.index', compact('banners'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.cms.banner.create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BannerRequest $request)
    {
        $data = $request->validated();
        $banner = $this->banner->create($data);

        if ($request->hasFile('banner_image_path')) {
            foreach ($request->file('banner_image_path') as $file) {
                $url = Midhas::upload($file, $this->folder);
                $banner->images()->create(['banner_url' => $url]);
            }
        }
        return to_route('admin.cms.banners.index')->with('success', 'Banner Added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Banner $banner)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $banner = Banner::with('images')->findOrFail($id);
        return view('admin.cms.banner.edit', compact('banner'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BannerRequest $request, string $id)
    {
        $banner = $this->banner->find($id);

        $data = $request->validated();
        $banner->update($data);

        if ($request->hasFile('banner_image_path')) {
            foreach ($banner->images as $image) {
                Storage::delete('public/' . $image->banner_url);

                $image->delete();
            }

            foreach ($request->file('banner_image_path') as $file) {
                $url = Midhas::upload($file, $this->folder);
                $banner->images()->create(['banner_url' => $url]);
            }
        }


        return to_route('admin.cms.banners.index')->with('success', 'Banner updated successfully');
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
            $banner = $this->banner->find($item);
            if ($type == 1) {
                $banner->delete();
            } else if ($type == 2) {
                $banner->update(['status' => $status]);
            }
        }
        return response()->json(['success' => true, 'message' => 'Bulk operation is completed']);
    }
    public function delete($id)
    {
        $banner = Banner::findOrFail($id);

        // Delete associated images if needed
        if ($banner->image) {
            $banner->image->delete();
        }

        $banner->delete();

        return redirect()->back()->with('success', 'Banner deleted successfully.');
    }

}
