<?php

namespace App\Models;

use App\Models\Cart;
use App\Models\Product\Product;
use App\Models\Product\ProductVariant;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CartItems extends Model
{
    use HasFactory;
    protected $fillable = [
        'cart_id',
        'product_id',
        'variant_id',
        'quantity',
        'sku',
        'name',
        'price',
        'total_amount',
        'tax_percent',
        'tax_amount',
        'discount_percent',
        'discount_id',
        'discount_code',
        'discount_type',
        'discount_value',
        'discount_amount',
        'comments',
    ];

    protected $with = [
        'product',
    ];

    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    public function variant()
    {
        return $this->hasOne(ProductVariant::class, 'id', 'variant_id');
    }
    // In CartItem.php
    public function addons()
    {
        return $this->hasMany(ProductAccessories::class, 'cart_item_id', 'id');
    }
}
