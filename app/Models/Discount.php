<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Discount extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'type',
        'value',
        'coupon_type',
        'limit',
        'expiry_date',
        'applicable_for',
        'sku'
    ];

    protected function expiryDate(): Attribute
    {
        return Attribute::make(
            get: fn(string|null $value) => $value ? Carbon::parse($value)->format('d-m-Y') : null,
        );
    }

    protected function code(): Attribute
    {
        return Attribute::make(
            set: fn(string $value) => strtoupper($value),
        );
    }
}
