<?php

namespace App\Http\Controllers\Admin;

use App\Models\Orders;
use Illuminate\Http\Request;
use App\Mail\SendInvoiceMail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class InvoiceController extends Controller
{
    public function create(Orders $order)
    {
        $this->checkIfAdded($order);
        return view('admin.invoices.create', compact('order'));
    }

    public function store(Request $request, Orders $order)
    {

        $this->checkIfAdded($order);

        $data = $order->toArray();
        $data['order_date'] = $order->getRawOriginal('order_date');
        $data['comments'] = $request->comments;
        $invoice = $order->invoice()->create($data);
        foreach ($order->items as $item) {
            $invoice->items()->create($item->toArray());
        }
        $order->update(['status' => 'invoice created']);

        $emails = [$order->email, 'sunil@webomindapps.com', 'girish@webomindapps.com'];
        Mail::to($emails)->send(new SendInvoiceMail($invoice));

        return to_route('admin.orders.index', ['order' => $order->id])->with('success', 'Invoice generated successfully');
    }


    private function checkIfAdded($order)
    {
        if ($order->invoice) {
            return to_route('admin.orders.index', ['order' => $order->id])->with('success', 'Invoice has been generated already');
        }
    }
}
