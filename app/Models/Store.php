<?php

namespace App\Models;

use App\Models\Admin\Admin;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Store extends Model
{
    use HasFactory;

    protected $fillable = [
        'admin_id',
        'name',
        'slug',
        'email',
        'phone',
        'manager_name',
        'location',
        'address',
        'map_link',
        'working_hours',
        'video',
        'video_link',
        'store_image',
        'store_image_link',
        'customer_care',
        'delivery_enquiries',
        'sales_info',
        'status'
    ];

    public function admin(): BelongsTo
    {
        return $this->belongsTo(Admin::class);
    }

    public function workingHours(): HasMany
    {
        return $this->hasMany(WorkingHour::class);
    }

    public function employees(): HasMany
    {
        return $this->hasMany(Employee::class);
    }

    protected function storeImage(): Attribute
    {
        return Attribute::make(
            get: fn (string|null $value) => asset('storage/' . $value),
        );
    }

    public function getImage(): string
    {
        return $this->store_image_link ? $this->store_image_link : $this->store_image;
    }
}
