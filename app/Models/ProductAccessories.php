<?php

namespace App\Models;

use App\Models\Product\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductAccessories extends Model
{
    

    protected $fillable = [
        'name',
        'product_id',
        'cart_item_id',
        'price',
    ];

    protected $with = [
        'product'
    ];


    /**
     * Get the product that owns the ProductCompleteSuite
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'size_product_id');
    }
}
