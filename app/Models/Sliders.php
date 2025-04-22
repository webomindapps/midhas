<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Sliders extends Model
{
    use HasFactory;
    protected $fillable = [
        'category_id',
        'position',
        'url',
        'slider_image',
        'status'
    ];
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
