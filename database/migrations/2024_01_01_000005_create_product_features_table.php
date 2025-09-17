<?php
// 2024_01_01_000005_create_product_features_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('product_features', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->string('value');
            $table->integer('order')->default(0);
            $table->timestamps();
            
            $table->index(['product_id', 'order']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('product_features');
    }
};