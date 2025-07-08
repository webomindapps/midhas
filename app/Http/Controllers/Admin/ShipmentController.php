<?php

namespace App\Http\Controllers\Admin;

use App\Models\Orders;
use Illuminate\Http\Request;
use App\Mail\SendShipmentMail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class ShipmentController extends Controller
{
    public function create(Orders $order)
    {
        $this->checkIfAdded($order);
        return view('admin.shipment.create', compact('order'));
    }

    public function store(Request $request, $order)
    {
        $this->checkIfAdded($order);
        $data = $order->toArray();
        $data['order_date'] = $order->getRawOriginal('order_date');
        $data['shipment_name'] = $request->shipment_name;
        $data['tracking_id'] = $request->tracking_id;
        $data['shipment_date'] = $request->shipment_date;
        $data['comments'] = $request->comments;
        $shipment = $order->shipment()->create($data);
        foreach ($order->items as $item) {
            $shipment->items()->create($item->toArray());
        }

        $order->update(['status' => 'shipped']);

        $emails = [$order->email, 'sunil@webomindapps.com'];
        Mail::to($emails)->send(new SendShipmentMail($shipment));

        return to_route('admin.orders.show', ['order' => $order->id])->with('success', 'Shipment added successfully');
    }


    private function checkIfAdded($order)
    {
        if ($order->shipment) {
            return to_route('admin.orders.index', ['order' => $order->id])->with('success', 'Order has been shipped already');
        }
    }
}
