<?php

namespace App\Listeners;

use App\Events\OrderCreatedEvent;
use App\Mail\OrderInvoiceMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class SendOrderInvoice
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(OrderCreatedEvent $event)
    {
          $order = $event->order;

        //send email
        $emails = [$order->email, 'Girish@webomindapps.com'];
        Mail::to($emails)->send(new OrderInvoiceMail($order));
        Auth::user()->cart()->delete();
    }
}
