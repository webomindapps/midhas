<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BannerImages extends Model
{
    public $table='banner_image';
    
    protected $fillable = [
        'banner_id',
        'banner_url',
    ];


    public function banner()
{
    return $this->belongsTo(Banner::class, 'banner_id');
}

    protected function url(): Attribute
    {
        return Attribute::make(
            get: fn(string $value) => asset('storage/' . $value),
        );
    }
}
