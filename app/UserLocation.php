<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserLocation extends Model
{
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'lat', 'long', 'user_id'
    ];
}
