<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductAccessoryCart extends Model
{
    public $table = 'product_accessory_cart';

    protected $fillable = ['product_id', 'cart_item_id', 'accessory_id', 'accessory_name', 'accessory_price'];

    public function cartitems()
    {
        return $this->belongsTo(CartItems::class, 'cart_item_id');
    }
    public function accessory()
    {
        return $this->belongsTo(ProductAccessories::class, 'accessory_id');
    }
}
