<?php

namespace App\Models;

use App\Models\Product\ProductSpecification;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Specification extends Model
{
    protected $fillable = [
        'name',
        'position',
        'status',
        'is_filtrable',
    ];
     public function products(): HasMany
    {
        return $this->hasMany(ProductSpecification::class);
    }

}
