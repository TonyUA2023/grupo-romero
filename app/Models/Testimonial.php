<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Testimonial extends Model
{
    protected $fillable = [
        'name',
        'position',
        'content',
        'rating',
        'image',
        'link',
        'is_active',
        'order'
    ];

    protected $casts = [
        'is_active' => 'boolean'
    ];

    /**
     * Accessor to normalize YouTube URLs into embed format.
     *
     * @return string|null
     */
    public function getLinkAttribute($value)
    {
        if (!$value) {
            return null;
        }

        // Handle various YouTube URL formats
        $patterns = [
            '/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/i', // Standard YouTube URLs
            '/^([a-zA-Z0-9_-]{11})$/' // Direct video ID
        ];

        foreach ($patterns as $pattern) {
            if (preg_match($pattern, $value, $matches)) {
                $videoId = $matches[1];
                return "https://www.youtube.com/embed/{$videoId}?rel=0&modestbranding=1";
            }
        }

        // If no match, return the original value (might be invalid, handle in view)
        return $value;
    }
}