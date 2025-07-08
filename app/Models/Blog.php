<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Blog extends Model
{
    public $table="blogs";
    protected $fillable = [
        'blog_title',
        'blog_date',
        'blog_description',
        'blog_image',
        'status'
    ];

     public function seo(): MorphOne
    {
        return $this->morphOne(Seo::class, 'seoable');
    }
}
