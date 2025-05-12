<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FilterItemSpecification extends Model
{
    protected $fillable = [
        'filter_item_id',
        'specification_id',
        'specification_name',
    ];


    /**
     * Get the filterItem that owns the FilterItemSpecification
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function filterItem(): BelongsTo
    {
        return $this->belongsTo(FilterItem::class);
    }
}
