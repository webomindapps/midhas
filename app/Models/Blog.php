<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Blog extends Model
{
    public $table = "blogs";
    protected $fillable = [
        'category_id',
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
    public function blogcategory()
    {
        return $this->belongsTo(Category::class,'category_id');
    }
}
