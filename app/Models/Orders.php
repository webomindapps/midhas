<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Carbon;

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
        return $this->hasMany(OrderAddress::class,'order_id');
    }

    public function address($type): ?OrderAddress
    {
        return $this->addresses()->where('address_type', $type)->first();
    }


    protected function orderDate(): Attribute
    {
        return Attribute::make(
            get: fn(string|null $value) => $value ? Carbon::parse($value)->format('d-m-Y') : '',
        );
    }
}
