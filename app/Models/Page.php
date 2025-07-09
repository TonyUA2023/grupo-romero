<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Page extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'content',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'featured_image',
        'status',
        'order'
    ];

    protected $casts = [
        'status' => 'boolean'
    ];

    public function sections(): HasMany
    {
        return $this->hasMany(Section::class);
    }
}