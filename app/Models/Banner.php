<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Banner extends Model
{
    public $table='banner';
    protected $fillable = [
        'category_id',
        'position',
        'type',
        'status'
    ];

    public function images()
    {
        return $this->hasMany(BannerImages::class, 'banner_id');
    }
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
