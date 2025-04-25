<?php

namespace App\Http\Controllers\Admin;

use App\Facades\Midhas;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRequest;
use App\Models\Admin\Admin;
use App\Models\Employee;
use App\Models\Store;
use App\Models\WorkingHour;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class StoreController extends Controller
{
    private $folder = 'stores/';
    public function __construct(public Admin $admin, public Store $store)
    {
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $searchColumns = ['id', 'name', 'email', 'manager_name', 'location'];
        $search = request()->search;
        $order = request()->orderedColumn;
        $orderBy = request()->orderBy;
        $paginate = request()->paginate;

        $query = $this->store->query();

        if ($search != '')
            $query->where(function ($q) use ($search, $searchColumns) {
                foreach ($searchColumns as $key => $value) ($key == 0) ? $q->where($value, 'LIKE', '%' . $search . '%') : $q->orWhere($value, 'LIKE', '%' . $search . '%');
            });

        // sorting
        ($order == '') ? $query->orderByDesc('id') : $query->orderBy($order, $orderBy);

        $stores = $paginate ? $query->paginate($paginate)->appends(request()->query()) : $query->paginate(10)->appends(request()->query());

        return view('admin.stores.index', compact('stores'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.stores.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        DB::beginTransaction();
        try {

            $adminData = $request->only(['name', 'email', 'password']);
            $adminData['password'] = Hash::make($adminData['password']);

            // add in admin table for authentication
            $admin = $this->admin->create($adminData);

            //add store details
            $data = $request->validated();

            $data['slug'] = Str::slug($data['name'], '-');

            if ($request->hasFile('store_image')) {
                $data['store_image'] = Midhas::upload($request->file('store_image'), $this->folder);;
            }

            $store = $admin->details()->create($data);

            $this->addWorkingHours($store, $request);
            $this->addEmployees($store, $request);


            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            dd($e);
        }


        return to_route('admin.stores.index')->with('success', 'Store Added successfully');
    }


    public function addWorkingHours($store, $request): void
    {
        $ids = $request->ids;

        $days = $request->day;
        $statuses = $request->status;
        $opens_at = $request->opens_at;
        $closes_at =  $request->closes_at;

        foreach ($days as $key => $day) {
            $data = [
                'day' => $days[$key],
                'status' => $statuses[$key],
                'opens_at' => $opens_at[$key],
                'closes_at' => $closes_at[$key]
            ];
            if (is_null($ids[$key])) {
                $store->workingHours()->create($data);
            } else {
                WorkingHour::find($ids[$key])->update($data);
            }
        }
    }


    public function addEmployees($store, $request): void
    {
        $ids = $request->stores_multiple_item_ids;
        $first_names = $request->first_name;
        $last_names = $request->last_name;
        $phones = $request->phones;
        $designations = $request->designation;
        $emails = $request->emails;
        $locations = $request->locations;
        $passwords = $request->employee_password;

        if ($first_names && count($first_names) > 0) {
            foreach ($first_names as $key => $name) {

                $data = [
                    'first_name' => $first_names[$key],
                    'last_name' => $last_names[$key],
                    'phone' => $phones[$key],
                    'email' => $designations[$key],
                    'designation' => $emails[$key],
                    'location' => $locations[$key]
                ];

                if (is_null($ids) || is_null($ids[$key])) {
                    $data['password'] = Hash::make($passwords[$key]);
                    $store->employees()->create($data);
                } else {
                    $employee = Employee::find($ids[$key]);
                    if (!is_null($passwords[$key])) {
                        $data['password'] = Hash::make($passwords[$key]);
                    } else {
                        $data['password'] = $employee->password;
                    }
                    $employee->update($data);
                }
            }
        }
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
        $store = $this->store->find($id);
        return view('admin.stores.edit', compact('store'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreRequest $request, string $id)
    {
        DB::beginTransaction();
        try {

            $store = $this->store->find($id);

            $adminData = $request->only(['name', 'email', 'password']);


            if (is_null($adminData['password'])) {
                $adminData['password'] = $store->admin?->password;
            } else {
                $adminData['password'] = Hash::make($adminData['password']);
            }
            // add in admin table for authentication
            $store->admin->update($adminData);

            //add store details
            $data = $request->validated();

            $data['slug'] = Str::slug($data['name'], '-');

            if ($request->hasFile('store_image')) {
                $data['store_image'] = Midhas::upload($request->file('store_image'), $this->folder);;
            } else {
                $data['store_image'] = $store->getRawOriginal('store_image');
            }

            $store->update($data);


            $this->addWorkingHours($store, $request);
            $this->addEmployees($store, $request);

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            dd($e);
        }


        return to_route('admin.stores.index')->with('success', 'Store updated successfully');
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
            $store = $this->store->find($item);
            if ($type == 1) {
                $store->admin->delete();
                $store->delete();
            } else if ($type == 2) {
                $store->update(['status' => $status]);
            }
        }
        return response()->json(['success' => true, 'message' => 'Bulk operation is completed']);
    }
}
