<?php

namespace App\Models;

use App\Models\Shipment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ShipmentItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'shipment_id',
        'product_id',
        'name',
        'sku',
        'upc_code',
        'brand_id',
        'price',
        'qty',
        'product_warranty_id',
        'protection_plan_name',
        'protection_plan_no_of_months',
        'sub_total',
        'tax_percent',
        'tax_amount',
        'discount_percent',
        'discount_id',
        'discount_code',
        'discount_type',
        'discount_value',
        'discount_amount',
        'protection_plan_price',
        'grand_total'
    ];

    public function shipment(): BelongsTo
    {
        return $this->belongsTo(Shipment::class);
    }
}
