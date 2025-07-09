<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TeamMember extends Model
{
    protected $fillable = [
        'name',
        'position',
        'bio',
        'image',
        'specialties',
        'education',
        'social_links',
        'is_active',
        'order'
    ];

    protected $casts = [
        'social_links' => 'array',
        'is_active' => 'boolean'
    ];
}