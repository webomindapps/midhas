<?php

namespace App\Models\Product;

use App\Models\Store;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductStock extends Model
{
    protected $fillable = [
        'product_id',
        'store_id',
        'stock',
        'balance'
    ];

    protected $with = [
        'store'
    ];

    /**
     * Get the user that owns the ProductStock
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function store(): BelongsTo
    {
        return $this->belongsTo(Store::class)->where('status', true);
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
