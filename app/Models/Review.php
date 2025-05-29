<?php

namespace App\Models;

use App\Models\User;
use App\Models\ReviewImage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'rating',
        'title',
        'description',
        'status',
    ];

    public function reviewable(): MorphTo
    {
        return $this->morphTo();
    }
    public function images(): HasMany
    {
        return $this->hasMany(ReviewImage::class);
    }
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
