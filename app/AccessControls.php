<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AccessControls extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'price',
        'image_url',
        'description',
        'thumbnail_url',
    ];
}
