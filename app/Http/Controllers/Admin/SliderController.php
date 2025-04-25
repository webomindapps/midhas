<?php

namespace App\Http\Controllers\Admin;

use App\Facades\Midhas;
use App\Models\Sliders;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\SliderRequest;
use Illuminate\Support\Facades\Storage;

class SliderController extends Controller
{
    private $folder = 'slider/';
    public function __construct(public Sliders $sliders)
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

        $query = $this->sliders->query();

        if ($search != '')
            $query->where(function ($q) use ($search, $searchColumns) {
                foreach ($searchColumns as $key => $value)
                    ($key == 0) ? $q->where($value, 'LIKE', '%' . $search . '%') : $q->orWhere($value, 'LIKE', '%' . $search . '%');
            });

        // sorting
        ($order == '') ? $query->orderByDesc('id') : $query->orderBy($order, $orderBy);

        $sliders = $paginate ? $query->paginate($paginate)->appends(request()->query()) : $query->paginate(10)->appends(request()->query());
        return view('admin.cms.sliders.index', compact('sliders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.cms.sliders.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SliderRequest $request)
    {
        $data = $request->validated();
        $sliders = $this->sliders->create($data);
        if ($request->hasFile('slider_image')) {
            $file = $request->file('slider_image');
            $url = Midhas::upload($file, $this->folder);

            $sliders->update(['slider_image' => $url]);
        }
        return to_route('admin.cms.sliders.index')->with('success', 'Sliders Added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Sliders $sliders)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $slider = Sliders::findOrFail($id);
        return view('admin.cms.sliders.edit', compact('slider'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SliderRequest $request, string $id)
    {
        $sliders = $this->sliders->find($id);

        $data = $request->validated();
        $sliders->update($data);
        if ($request->hasFile('slider_image')) {
            if ($sliders->slider_image) {
                Storage::delete('public/' . $sliders->slider_image);
            }

            $file = $request->file('slider_image');
            $url = Midhas::upload($file, $this->folder);

            $sliders->update(['slider_image' => $url]);
        }
        return to_route('admin.cms.sliders.index')->with('success', 'Sliders updated successfully');
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
            $sliders = $this->sliders->find($item);
            if ($type == 1) {
                $sliders->delete();
            } else if ($type == 2) {
                $sliders->update(['status' => $status]);

            }
        }
        return response()->json(['success' => true, 'message' => 'Bulk operation is completed']);
    }
    public function delete($id)
    {
        $sliders = Sliders::findOrFail($id);
        $sliders->delete();

        return redirect()->back()->with('success', 'Sliders deleted successfully.');
    }
}
