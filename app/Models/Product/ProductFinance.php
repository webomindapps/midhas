<?php

namespace App\Models\Product;

use App\Models\Product\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductFinance extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'name',
        'no_of_months',
        'interest_per_month',
        'price'
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function pricePerMonth(): float
    {
        $price = $this->product?->currentPrice();
        $month = $this->no_of_months;

        $basePrice = $price / $month;

        $interestAmount = $this->interest_per_month * $basePrice / 100;

        return round($basePrice + $interestAmount, 2);
    }


    public function financingPrice(): float
    {
        $price = $this->product?->msrp;

        return round($this->price * $price / 100, 2);
    }
}
