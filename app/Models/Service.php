<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'short_description',
        'description',
        'image',
        'icon',
        'price',
        'duration',
        'featured',
        'is_active',
        'order'
    ];

    protected $casts = [
        'featured' => 'boolean',
        'is_active' => 'boolean'
    ];
}