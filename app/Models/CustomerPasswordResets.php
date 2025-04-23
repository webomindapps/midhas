<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomerPasswordResets extends Model
{
    public $table="password_reset_tokens";
    public $timestamps = false; 
    protected $fillable = [
        'email',
        'token',
    ];
}
