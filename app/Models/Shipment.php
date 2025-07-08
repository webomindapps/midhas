<?php

namespace App\Models;

use App\Models\OrderAddress;
use App\Models\ShipmentItem;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Shipment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'order_id',
        'name',
        'email',
        'order_type',
        'order_date',
        'total_items',
        'total_qty',
        'discount_id',
        'discount_code',
        'discount_type',
        'discount_value',
        'discount_amount',
        'deliver_id',
        'deliver_type',
        'deliver_location_name',
        'deliver_amount',
        'sub_total',
        'tax_total',
        'protection_plan_total',
        'grand_total',
        'status',
        'shipment_name',
        'tracking_id',
        'shipment_date',
        'comments'
    ];

    public function items(): HasMany
    {
        return $this->hasMany(ShipmentItem::class);
    }

    public function order()
    {
        return $this->belongsTo(Orders::class);
    }


    public function address($type): OrderAddress
    {
        return OrderAddress::where('order_id', $this->order_id)->where('address_type', $type)->first();
    }
}
