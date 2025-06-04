<?php

namespace App\Models;

use App\Models\CartItems;
use App\Models\OrderAddress;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cart extends Model
{
    use HasFactory;
    protected $fillable = [
        'customer_id',
        'name',
        'email',
        'shipping_method',
        'coupon_code',
        'items_count',
        'items_qty',
        'total_amount',
        'tax_total',
        'tax',
        'discount_id',
        'discount_code',
        'discount_type',
        'discount_value',
        'discount_amount',
        'grand_total',
        'plans',
    ];
    protected $with = [
        'items',
    ];

    public function items()
    {
        return $this->hasMany(CartItems::class);
    }
    /**
     * Get all of the addresses for the Order
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function addresses(): HasMany
    {
        return $this->hasMany(OrderAddress::class);
    }
    public function coupon()
    {
        return $this->hasOne(Discount::class, 'code', 'coupon_code');
    }
}
