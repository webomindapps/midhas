<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrderAddress extends Model
{
    use HasFactory;

    protected $fillable = [
        'cart_id',
        'order_id',
        'customer_id',
        'address_type',
        'first_name',
        'last_name',
        'email',
        'company_name',
        'address_1',
        'address_2',
        'city',
        'province',
        'postal_code',
        'contact_number',
        'phone_number',
        'alternate_number',
        'how_you_know_about_us',
        'order_date'
    ];




    /**
     * Get the order that owns the OrderItem
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function order(): BelongsTo
    {
        return $this->belongsTo(Orders::class,'order_id');
    }

}
