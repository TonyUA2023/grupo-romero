<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'sku',
        'description',
        'short_description',
        'price',
        'sale_price',
        'category_id',
        'brand_id',
        'gender', // unisex, hombre, mujer, niño
        'type', // sol, oftalmico, ambos
        'frame_material',
        'frame_color',
        'lens_type',
        'lens_color',
        'size',
        'featured_image',
        'model_image', // Nueva columna agregada
        'is_featured',
        'is_new',
        'is_active',
        'order',
        'views',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'link', // Nueva columna
        'video' // Nueva columna
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'is_new' => 'boolean',
        'is_active' => 'boolean',
        'price' => 'decimal:2',
        'sale_price' => 'decimal:2',
        'views' => 'integer',
        'order' => 'integer'
    ];

    // Relaciones
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class)->orderBy('order');
    }

    public function features()
    {
        return $this->hasMany(ProductFeature::class)->orderBy('order');
    }

    // Accessors
    public function getFinalPriceAttribute()
    {
        return $this->sale_price ?? $this->price;
    }

    public function getDiscountPercentageAttribute()
    {
        if ($this->sale_price && $this->price > 0) {
            return round((($this->price - $this->sale_price) / $this->price) * 100);
        }
        return 0;
    }

    public function getIsOnSaleAttribute()
    {
        return $this->sale_price && $this->sale_price < $this->price;
    }

    public function getMainImageAttribute()
    {
        if ($this->featured_image) {
            return $this->featured_image;
        }
        
        $firstImage = $this->images()->first();
        return $firstImage ? $firstImage->image_path : null;
    }

    /**
     * Accessor para obtener la imagen del modelo
     * Devuelve la imagen del modelo o un placeholder si no existe
     */
    public function getModelImageUrlAttribute()
    {
        if ($this->model_image) {
            // Si la imagen ya es una URL completa, la retornamos tal como está
            if (filter_var($this->model_image, FILTER_VALIDATE_URL)) {
                return $this->model_image;
            }
            
            // Si es una ruta relativa, la convertimos a URL completa
            return asset('storage/' . $this->model_image);
        }
        
        // Imagen placeholder por defecto si no existe model_image
        return asset('images/placeholder-model.jpg');
    }

    /**
     * Accessor para obtener la imagen circular del producto
     * Prioriza model_image sobre featured_image para mostrar en tarjetas
     */
    public function getCircularImageAttribute()
    {
        return $this->model_image ?? $this->featured_image ?? 'images/placeholder-circular.jpg';
    }

    /**
     * Accessor para obtener la URL completa de la imagen circular
     */
    public function getCircularImageUrlAttribute()
    {
        $image = $this->circular_image;
        
        if (filter_var($image, FILTER_VALIDATE_URL)) {
            return $image;
        }
        
        return asset('storage/' . $image);
    }

    // Mutators
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($product) {
            if (empty($product->slug)) {
                $product->slug = Str::slug($product->name);
            }
            
            if (empty($product->sku)) {
                $product->sku = 'PRD-' . strtoupper(Str::random(8));
            }
        });

        static::updating(function ($product) {
            if ($product->isDirty('name') && empty($product->slug)) {
                $product->slug = Str::slug($product->name);
            }
        });
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function scopeNew($query)
    {
        return $query->where('is_new', true);
    }

    public function scopeOnSale($query)
    {
        return $query->whereNotNull('sale_price')
                     ->where('sale_price', '>', 0)
                     ->whereColumn('sale_price', '<', 'price');
    }

    public function scopeByGender($query, $gender)
    {
        return $query->where('gender', $gender);
    }

    public function scopeByType($query, $type)
    {
        return $query->where('type', $type);
    }

    /**
     * Scope para productos que tienen imagen de modelo
     */
    public function scopeWithModelImage($query)
    {
        return $query->whereNotNull('model_image');
    }
}