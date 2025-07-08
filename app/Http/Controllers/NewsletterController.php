<?php

namespace App\Http\Controllers;

use App\Models\Newsletter;
use Illuminate\Http\Request;

class NewsletterController extends Controller
{
     public function __construct(public Newsletter $newsletter)
    {
    }
    public function store(Request $request)
    {
        $request->validate([
            'email'=>'required|email',
        ]);
        $newsletter = new Newsletter();
        $newsletter->email=$request->email;
        $newsletter->save();
        return redirect()->back()->with('message','Request Accept Will Get Back Soon..');
        
    }
    public function index()
    {
        $searchColumns = ['id', 'email'];
        $search = request()->search;
        $order = request()->orderedColumn;
        $orderBy = request()->orderBy;
        $paginate = request()->paginate;

        $query = $this->newsletter->query();

        if ($search != '')
            $query->where(function ($q) use ($search, $searchColumns) {
                foreach ($searchColumns as $key => $value) ($key == 0) ? $q->where($value, 'LIKE', '%' . $search . '%') : $q->orWhere($value, 'LIKE', '%' . $search . '%');
            });

        // sorting
        ($order == '') ? $query->orderByDesc('id') : $query->orderBy($order, $orderBy);

        $newsletter = $paginate ? $query->paginate($paginate)->appends(request()->query()) : $query->paginate(10)->appends(request()->query());
        return view('admin.newsletter.index', compact('newsletter'));
    }
}
