<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Mail\AskQuestion as MailAskQuestion;
use App\Models\AskQuestion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class QuestionController extends Controller
{
    public function __construct(public AskQuestion $askQuestion) {}


    public function index()
    {
        $type = request()->type;
        $searchColumns = ['id', 'name', 'email', 'phone'];
        $search = request()->search;
        $order = request()->orderedColumn;
        $orderBy = request()->orderBy;
        $paginate = request()->paginate;

        $query = $this->askQuestion->query();
        if ($search != '')
            $query->where(function ($q) use ($search, $searchColumns) {
                foreach ($searchColumns as $key => $value) ($key == 0) ? $q->where($value, 'LIKE', '%' . $search . '%') : $q->orWhere($value, 'LIKE', '%' . $search . '%');
            });

        // sorting
        ($order == '') ? $query->orderByDesc('id') : $query->orderBy($order, $orderBy);

        $questions = $paginate ? $query->paginate($paginate)->appends(request()->query()) : $query->paginate(10)->appends(request()->query());
        return view('admin.askquestion.index', compact('questions'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'question' => 'required',
        ]);
        $questions = new AskQuestion();
        $questions->name = $request->name;
        $questions->email = $request->email;
        $questions->phone = $request->phone;
        $questions->question = $request->question;
        $questions->save();
        Mail::to($questions->email)->send(new MailAskQuestion($questions));
        return redirect()->back()->with('message', 'Details Submitted  Will get Back soon !!');
    }
    public function show($id)
    {
        $questions = AskQuestion::findOrFail($id);
        return view('admin.askquestion.update', compact('questions'));
    }
    public function destroy(string $id)
    {
        $type = request()->type;
        $selectedItems = request()->selectedIds;
        $status = request()->status;

        foreach ($selectedItems as $item) {
            $blog = $this->askQuestion->find($item);
            if ($type == 1) {
                $blog->delete();
            } else if ($type == 2) {
                $blog->update(['status' => $status]);
            }
        }
        return response()->json(['success' => true, 'message' => 'Bulk operation is completed']);
    }
}
