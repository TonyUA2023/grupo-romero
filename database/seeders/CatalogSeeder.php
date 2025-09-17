<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductFeature;
use Illuminate\Support\Str;

class CatalogSeeder extends Seeder
{
    public function run()
    {
        // Crear categorías
        $categories = [
            ['name' => 'Lentes de Sol', 'description' => 'Protección UV con estilo'],
            ['name' => 'Lentes Oftálmicos', 'description' => 'Corrección visual con diseño'],
            ['name' => 'Lentes Deportivos', 'description' => 'Rendimiento y protección'],
            ['name' => 'Lentes para Niños', 'description' => 'Diseños divertidos y seguros'],
        ];

        foreach ($categories as $index => $categoryData) {
            Category::create([
                'name' => $categoryData['name'],
                'slug' => Str::slug($categoryData['name']),
                'description' => $categoryData['description'],
                'is_active' => true,
                'order' => $index
            ]);
        }

        // Crear marcas
        $brands = [
            ['name' => 'Ray-Ban', 'description' => 'Icónica marca americana de lentes'],
            ['name' => 'Oakley', 'description' => 'Innovación en lentes deportivos'],
            ['name' => 'Prada', 'description' => 'Lujo italiano en cada diseño'],
            ['name' => 'Gucci', 'description' => 'Elegancia y sofisticación'],
            ['name' => 'Versace', 'description' => 'Diseños audaces y glamurosos'],
            ['name' => 'Dior', 'description' => 'Alta costura en lentes'],
            ['name' => 'Chanel', 'description' => 'Elegancia francesa atemporal'],
            ['name' => 'Armani', 'description' => 'Estilo italiano refinado'],
        ];

        foreach ($brands as $index => $brandData) {
            Brand::create([
                'name' => $brandData['name'],
                'slug' => Str::slug($brandData['name']),
                'description' => $brandData['description'],
                'is_featured' => $index < 4, // Primeras 4 marcas destacadas
                'is_active' => true,
                'order' => $index
            ]);
        }

        // Crear productos de ejemplo
        $productNames = [
            'Aviator Classic', 'Wayfarer Original', 'Round Metal', 'Clubmaster',
            'Justin', 'Erika', 'New Wayfarer', 'Caravan', 'Hexagonal', 'Marshal',
            'Sport Shield', 'Active Wrap', 'Performance Pro', 'Urban Style',
            'Fashion Forward', 'Classic Elegance', 'Modern Chic', 'Vintage Charm',
            'Bold Statement', 'Minimalist Design'
        ];

        $colors = ['Negro', 'Carey', 'Dorado', 'Plateado', 'Azul', 'Verde', 'Rojo', 'Transparente'];
        $materials = ['Metal', 'Acetato', 'Titanio', 'TR90', 'Aluminio'];
        $lensTypes = ['Polarizado', 'Fotocromático', 'Espejado', 'Degradado', 'Anti-reflejo'];

        foreach ($productNames as $index => $productName) {
            $category = Category::inRandomOrder()->first();
            $brand = Brand::inRandomOrder()->first();
            $basePrice = rand(150, 800);
            $isOnSale = rand(0, 100) > 70;

            $product = Product::create([
                'name' => $brand->name . ' ' . $productName,
                'slug' => Str::slug($brand->name . '-' . $productName),
                'sku' => 'SKU-' . strtoupper(Str::random(8)),
                'description' => 'Los lentes ' . $productName . ' de ' . $brand->name . ' combinan estilo y funcionalidad. Diseñados con los más altos estándares de calidad, ofrecen protección UV completa y un diseño que complementa cualquier estilo.',
                'short_description' => 'Lentes ' . $productName . ' con diseño exclusivo y protección UV.',
                'price' => $basePrice,
                'sale_price' => $isOnSale ? $basePrice * 0.8 : null,
                'category_id' => $category->id,
                'brand_id' => $brand->id,
                'gender' => ['unisex', 'hombre', 'mujer'][rand(0, 2)],
                'type' => ['sol', 'oftalmico'][rand(0, 1)],
                'frame_material' => $materials[rand(0, 4)],
                'frame_color' => $colors[rand(0, 7)],
                'lens_type' => $lensTypes[rand(0, 4)],
                'lens_color' => $colors[rand(0, 7)],
                'size' => ['S', 'M', 'L'][rand(0, 2)],
                'is_featured' => rand(0, 100) > 80,
                'is_new' => rand(0, 100) > 70,
                'is_active' => true,
                'order' => $index,
                'views' => rand(0, 1000)
            ]);

            // Crear imágenes para el producto
            for ($i = 1; $i <= rand(3, 5); $i++) {
                ProductImage::create([
                    'product_id' => $product->id,
                    'image_path' => 'products/sample-' . rand(1, 10) . '.jpg',
                    'alt_text' => $product->name . ' - Vista ' . $i,
                    'is_primary' => $i === 1,
                    'order' => $i
                ]);
            }

            // Crear características del producto
            $features = [
                ['name' => 'Protección UV', 'value' => '100% UV400'],
                ['name' => 'Ancho del puente', 'value' => rand(16, 22) . 'mm'],
                ['name' => 'Longitud de varilla', 'value' => rand(135, 145) . 'mm'],
                ['name' => 'Ancho del lente', 'value' => rand(50, 60) . 'mm'],
                ['name' => 'Incluye', 'value' => 'Estuche y paño de limpieza'],
            ];

            foreach ($features as $index => $feature) {
                ProductFeature::create([
                    'product_id' => $product->id,
                    'name' => $feature['name'],
                    'value' => $feature['value'],
                    'order' => $index
                ]);
            }
        }
    }
}