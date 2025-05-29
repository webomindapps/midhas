<?php

namespace App\Models\Product;

use Carbon\Carbon;
use App\Models\Seo;
use App\Models\Brand;
use App\Models\Review;
use App\Models\Category;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;
use App\Models\Product\ProductEnquiry;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Product extends Model
{
    protected $guarded = ['id'];
    protected $with = [
        'prices',
        'images',
        'stocks',
        'brand',
    ];
    public function scopeCategory(Builder $query): void
    {
        if (session()->has('category')) {
            $category = Category::find(session('category'));
            $query->whereHas('categories', function ($q) use ($category) {
                $q->whereIn('categories.id', $category->getSelfAndChildrenId());
            });
        }
    }

    protected function thumbnail(): Attribute
    {
        return Attribute::make(
            get: fn(string $value) => asset('storage/' . $value),
        );
    }

    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'category_product')->withPivot('product_id');
    }
    public function parentCategory()
    {
        return $this->categories()->whereNull('parent_id')->first();
    }

    public function parentSubCategory()
    {
        return $this->categories()->whereNull('parent_id')
            ->first()?->children()
            ->first();
    }

    public function prices(): HasMany
    {
        return $this->hasMany(ProductPrice::class)->orderBy('start_date', 'asc');
    }

    public function images(): HasMany
    {
        return $this->hasMany(ProductImage::class);
    }

    public function stocks(): HasMany
    {
        return $this->hasMany(ProductStock::class)->whereHas('store');
    }


    public function seo(): MorphOne
    {
        return $this->morphOne(Seo::class, 'seoable');
    }

    public function specifications(): HasMany
    {
        return $this->hasMany(ProductSpecification::class);
    }

    public function manuals(): HasMany
    {
        return $this->hasMany(ProductManual::class);
    }


    /**
     * Get all of the variants for the Product
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function variants(): HasMany
    {
        return $this->hasMany(ProductVariant::class);
    }


    public function isEnquiry(): bool
    {
        return $this->order_type == 1;
    }

    public function enquiries(): HasMany
    {
        return $this->hasMany(ProductEnquiry::class);
    }

    public function currentPrice(): float
    {
        $currentDate = Carbon::now()->format('Y-m-d');

        if (count($this->prices) > 0) {
            if (
                $price = $this->prices()
                    ->whereDate('start_date', '<=', $currentDate)
                    ->whereDate('end_date', '>=', $currentDate)
                    ->first()
            ) {
                return $price->price;
            }
        }

        return $this->selling_price;
    }

    public function typeOfProduct(): array
    {

        if ($this->type == 'package') {
            return $this->packages()->pluck('package_product_id')->toArray();
        }
        return [
            $this->id
        ];
    }

    public function isPackage(): bool
    {
        return $this->type == 'package';
    }

    public function isAddedToWishList(): bool
    {
        $user = Auth::check();

        if ($user) {
            return auth()->user()->wishlists()->where('product_id', $this->id)->exists();
        }

        if (session()->has('wishlist_ids')) {
            return Wishlist::whereIn('id', session('wishlist_ids'))->where('product_id', $this->id)->exists();
        }

        return false;
    }
    public function wishlists(): HasMany
    {
        return $this->hasMany(Wishlist::class);
    }

    public function reviews(): MorphMany
    {
        return $this->morphMany(Review::class, 'reviewable')->where('status', true);
    }
    
}
