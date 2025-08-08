<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Mail\SendProducttoFriend;
use App\Models\TellaFriend;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class TellaFriendController extends Controller
{
    public function __construct(public TellaFriend $tellafriend) {}

    public function index()
    {
         $type = request()->type;
        $searchColumns = ['id', 'name', 'email', 'friends_name','friends_email'];
        $search = request()->search;
        $order = request()->orderedColumn;
        $orderBy = request()->orderBy;
        $paginate = request()->paginate;

        $query = $this->tellafriend->query();
        if ($search != '')
            $query->where(function ($q) use ($search, $searchColumns) {
                foreach ($searchColumns as $key => $value) ($key == 0) ? $q->where($value, 'LIKE', '%' . $search . '%') : $q->orWhere($value, 'LIKE', '%' . $search . '%');
            });

        // sorting
        ($order == '') ? $query->orderByDesc('id') : $query->orderBy($order, $orderBy);

        $tellafriend = $paginate ? $query->paginate($paginate)->appends(request()->query()) : $query->paginate(10)->appends(request()->query());
        return view('admin.tella-friend.index', compact('tellafriend'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'friends_email' => 'required',
            'friends_name' => 'required',
            'message' => 'required',
        ]);
        $tellafriend = new TellaFriend();
        $tellafriend->name = $request->name;
        $tellafriend->email = $request->email;
        $tellafriend->friends_email = $request->friends_email;
        $tellafriend->friends_name = $request->friends_name;
        $tellafriend->message = $request->message;
        $tellafriend->save();
        Mail::to($tellafriend->friends_email)->send(new SendProducttoFriend($tellafriend));
        return redirect()->back()->with('message', 'Your message has been sent successfully');
    }
    public function show($id)
    {
        $tellafriend = $this->tellafriend->findOrFail($id);
        return view('admin.tella-friend.view', compact('tellafriend'));
    }
    public function destroy(string $id)
    {
        $type = request()->type;
        $selectedItems = request()->selectedIds;
        $status = request()->status;

        foreach ($selectedItems as $item) {
            $blog = $this->tellafriend->find($item);
            if ($type == 1) {
                $blog->delete();
            } else if ($type == 2) {
                $blog->update(['status' => $status]);
            }
        }
        return response()->json(['success' => true, 'message' => 'Bulk operation is completed']);
    }
}
