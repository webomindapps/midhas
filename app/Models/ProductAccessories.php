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
        'accessory_name',
        'accessory_category_id',
        'accesory_product_id',
        'sku',
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
     public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function accessoryproduct()
    {
        return $this->belongsTo(Product::class, 'accesory_product_id');
    }
}
