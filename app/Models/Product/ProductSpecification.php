<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Model;

class ProductSpecification extends Model
{
    protected $fillable = [
        'product_id',
        'specification_id',
        'value',
    ];
}
