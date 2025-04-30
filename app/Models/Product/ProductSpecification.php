<?php

namespace App\Models\Product;

use App\Models\Specification;
use Illuminate\Database\Eloquent\Model;

class ProductSpecification extends Model
{
    protected $fillable = [
        'product_id',
        'specification_id',
        'value',
    ];

    public function specs()
    {
        return $this->belongsTo(Specification::class, 'specification_id');
    }
}
