<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class FilterItem extends Model
{
    protected $fillable = [
        'filter_id',
        'name',
        'position',
        'type',
        'is_specification',
        'column_name',
    ];

    /**
     * Get the filter that owns the FilterItem
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function filter(): BelongsTo
    {
        return $this->belongsTo(Filter::class);
    }


    /**
     * Get all of the specificationItems for the FilterItem
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function filterSpecificationItems(): HasMany
    {
        return $this->hasMany(FilterItemSpecification::class);
    }
}
