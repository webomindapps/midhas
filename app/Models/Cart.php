<?php

namespace App\Models;

use App\Models\CartItems;
use Illuminate\Database\Eloquent\Model;
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
}
