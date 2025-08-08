<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductSize extends Model
{
    use HasFactory;


    protected $fillable = [
        'size',
        'product_id',
        'size_category_id',
        'size_product_id',
        'sku'
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
