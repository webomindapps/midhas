<?php

namespace App\Models;

use App\Models\Product\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Support\Collection;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'parent_id',
        'name',
        'slug',
        'position',
        'status'
    ];

    public function image(): MorphOne
    {
        return $this->morphOne(Image::class, 'imageable');
    }

    public function seo(): MorphOne
    {
        return $this->morphOne(Seo::class, 'seoable');
    }

    public function children()
    {
        return $this->hasMany(static::class, 'parent_id')->orderBy('position', 'asc');
    }

    public function filtersByCategory()
    {
        return $this->hasMany(Filter::class, 'category_id');
    }

    public function filtersBySubCategory()
    {
        return $this->hasMany(Filter::class, 'sub_category_id');
    }

    // Accessor to merge both filters
    public function getFiltersAttribute(): Collection
    {
        return $this->filtersByCategory->merge($this->filtersBySubCategory);
    }

    public function activeChildren()
    {
        return $this->hasMany(static::class, 'parent_id')
            ->where('status', true)
            ->orderBy('position', 'asc');
    }

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class)->where('status', true);
    }
}
