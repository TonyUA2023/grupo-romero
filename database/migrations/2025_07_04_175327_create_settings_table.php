<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();
            $table->text('value')->nullable();
            $table->string('type')->default('text'); // text, textarea, image, json
            $table->string('group')->default('general'); // general, contact, social, etc
            $table->timestamps();
        });

        // Insertar configuraciones iniciales
        DB::table('settings')->insert([
            // Información general
            ['key' => 'site_name', 'value' => 'GRC Clínica Optométrica', 'type' => 'text', 'group' => 'general'],
            ['key' => 'site_description', 'value' => 'Expertos en salud visual', 'type' => 'textarea', 'group' => 'general'],
            ['key' => 'logo', 'value' => null, 'type' => 'image', 'group' => 'general'],
            
            // Contacto
            ['key' => 'phone', 'value' => '+51 999 999 999', 'type' => 'text', 'group' => 'contact'],
            ['key' => 'whatsapp', 'value' => '51999999999', 'type' => 'text', 'group' => 'contact'],
            ['key' => 'email', 'value' => 'info@grcclinica.com', 'type' => 'text', 'group' => 'contact'],
            ['key' => 'address', 'value' => 'Av. Principal 123, Lima', 'type' => 'text', 'group' => 'contact'],
            ['key' => 'google_maps', 'value' => null, 'type' => 'textarea', 'group' => 'contact'],
            
            // Horarios
            ['key' => 'schedule', 'value' => json_encode([
                'monday' => '8:00 AM - 6:00 PM',
                'tuesday' => '8:00 AM - 6:00 PM',
                'wednesday' => '8:00 AM - 6:00 PM',
                'thursday' => '8:00 AM - 6:00 PM',
                'friday' => '8:00 AM - 6:00 PM',
                'saturday' => '9:00 AM - 2:00 PM',
                'sunday' => 'Cerrado'
            ]), 'type' => 'json', 'group' => 'schedule'],
            
            // Redes sociales
            ['key' => 'facebook', 'value' => 'https://facebook.com/grcclinica', 'type' => 'text', 'group' => 'social'],
            ['key' => 'instagram', 'value' => 'https://instagram.com/grcclinica', 'type' => 'text', 'group' => 'social'],
            ['key' => 'linkedin', 'value' => null, 'type' => 'text', 'group' => 'social'],
            
            // SEO
            ['key' => 'meta_title', 'value' => 'GRC Clínica Optométrica - Cuidamos tu Visión', 'type' => 'text', 'group' => 'seo'],
            ['key' => 'meta_description', 'value' => 'Expertos en salud visual. Exámenes completos, lentes de alta calidad y atención personalizada en Lima.', 'type' => 'textarea', 'group' => 'seo'],
            ['key' => 'meta_keywords', 'value' => 'clínica optométrica, salud visual, examen de vista, lentes, lima', 'type' => 'text', 'group' => 'seo'],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};