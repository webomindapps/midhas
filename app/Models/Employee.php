<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Employee extends Model
{
    protected $fillable = [
        'first_name',
        'last_name',
        'phone',
        'email',
        'designation',
        'location',
        'password'
    ];

    public function store(): BelongsTo
    {
        return $this->belongsTo(Store::class);
    }
}
