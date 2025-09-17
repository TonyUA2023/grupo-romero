<?php
// ProductFeature.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductFeature extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'name',
        'value',
        'order'
    ];

    protected $casts = [
        'order' => 'integer'
    ];

    // Relaciones
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}