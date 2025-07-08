<?php

namespace App\Models;

use App\Models\User;
use App\Models\Invoice;
use App\Models\Shipment;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Orders extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
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
        'delivery_city',
        'pickup_location',
        'delivery_date',
        'delivery_time',
        'sub_total',
        'tax_total',
        'protection_plan_total',
        'grand_total',
        'status'
    ];

    /**
     * Get the user that owns the Order
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }


    /**
     * Get all of the items for the Order
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function items(): HasMany
    {
        return $this->hasMany(OrderItems::class);
    }


    /**
     * Get all of the addresses for the Order
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function addresses(): HasMany
    {
        return $this->hasMany(OrderAddress::class, 'order_id');
    }

    public function address($type): ?OrderAddress
    {
        return OrderAddress::where('order_id', $this->order_id)->where('address_type', $type)->first();
    }


    protected function orderDate(): Attribute
    {
        return Attribute::make(
            get: fn(string|null $value) => $value ? Carbon::parse($value)->format('d-m-Y') : '',
        );
    }

    public function invoice()
    {
        return $this->hasOne(Invoice::class);
    }

    public function shipment()
    {
        return $this->hasOne(Shipment::class);
    }

}
