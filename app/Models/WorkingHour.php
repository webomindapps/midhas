<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class WorkingHour extends Model
{
    protected $fillable = [
        'day',
        'status',
        'opens_at',
        'closes_at'
    ];

    public function store(): BelongsTo
    {
        return $this->belongsTo(Store::class);
    }
}
