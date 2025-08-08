<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TellaFriend extends Model
{
    protected $fillable=['name','email','freinds_name','friends_email','message'];
}
