<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BlogPost extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'excerpt',
        'content',
        'featured_image',
        'author',
        'category',
        'tags',
        'meta_title',
        'meta_description',
        'is_published',
        'published_at',
        'views'
    ];

    protected $casts = [
        'tags' => 'array',
        'is_published' => 'boolean',
        'published_at' => 'datetime'
    ];

    /**
     * Accessor para asegurar que tags siempre sea un array
     */
    public function getTagsAttribute($value)
    {
        // Si el valor es null o string vacío, retornar array vacío
        if (is_null($value) || $value === '') {
            return [];
        }

        // Si ya es un array, retornarlo
        if (is_array($value)) {
            return $value;
        }

        // Si es un string JSON, decodificarlo
        $decoded = json_decode($value, true);
        
        // Si la decodificación falla o no es un array, retornar array vacío
        return is_array($decoded) ? $decoded : [];
    }

    /**
     * Mutator para asegurar que tags se guarde correctamente
     */
    public function setTagsAttribute($value)
    {
        if (is_array($value)) {
            $this->attributes['tags'] = json_encode(array_filter($value));
        } elseif (is_string($value)) {
            // Si es un string separado por comas, convertirlo a array
            $tags = array_map('trim', explode(',', $value));
            $this->attributes['tags'] = json_encode(array_filter($tags));
        } else {
            $this->attributes['tags'] = json_encode([]);
        }
    }
}