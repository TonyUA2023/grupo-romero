<?php
// 2024_01_01_000003_create_products_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('sku')->unique();
            $table->text('description')->nullable();
            $table->text('short_description')->nullable();
            $table->decimal('price', 10, 2);
            $table->decimal('sale_price', 10, 2)->nullable();
            $table->foreignId('category_id')->constrained()->onDelete('restrict');
            $table->foreignId('brand_id')->constrained()->onDelete('restrict');
            $table->enum('gender', ['unisex', 'hombre', 'mujer', 'niño'])->default('unisex');
            $table->enum('type', ['sol', 'oftalmico', 'ambos'])->default('oftalmico');
            $table->string('frame_material')->nullable();
            $table->string('frame_color')->nullable();
            $table->string('lens_type')->nullable();
            $table->string('lens_color')->nullable();
            $table->string('size')->nullable();
            $table->string('featured_image')->nullable();
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_new')->default(false);
            $table->boolean('is_active')->default(true);
            $table->integer('order')->default(0);
            $table->integer('views')->default(0);
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->string('meta_keywords')->nullable();
            $table->timestamps();
            
            $table->index(['slug', 'is_active']);
            $table->index(['category_id', 'is_active']);
            $table->index(['brand_id', 'is_active']);
            $table->index('is_featured');
            $table->index('price');
            $table->index('gender');
            $table->index('type');
        });
    }

    public function down()
    {
        Schema::dropIfExists('products');
    }
};