<?php

namespace App\Exports;

use App\Models\Order;
use App\Models\Orders;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\FromCollection;
use App\Http\Controllers\Admin\OrderController;

class OrderExport implements FromView
{
    public $orders;
    public function __construct($orders)
    {
        $this->orders = $orders;
    }

    public function view(): View
    {
        return view('admin.exports.orders', [
            'orders' => $this->orders
        ]);
    }
}
