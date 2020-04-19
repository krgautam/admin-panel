<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Camera extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'original_name', 'user_id'
    ];
}
