<?php

namespace App\Models\Product;

use App\Models\Product\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductEnquiry extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'product_id',
        'product_name',
        'sku',
        'brand',
        'name',
        'phone',
        'message',
        'status',
        'notes'
    ];


    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
