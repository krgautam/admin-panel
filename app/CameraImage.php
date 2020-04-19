<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CameraImage extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'path','camera_id', 'user_id'
    ];
}
