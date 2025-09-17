@extends('layouts.app')

@section('title', $product->meta_title ?? $product->name . ' - ' . config('app.name'))
@section('description', $product->meta_description ?? $product->short_description)

@section('content')

<style>
    /* Reuse styles from catalog index */
    :root {
        --primary-black: #0a0a0a;
        --soft-black: #1a1a1a;
        --dark-gray: #2a2a2a;
        --medium-gray: #4a4a4a;
        --light-gray: #6a6a6a;
        --soft-gray: #e5e5e5;
        --off-white: #f8f8f8;
        --pure-white: #ffffff;
        --accent-blue: #0066ff;
        --accent-hover: #0052cc;
        --transition-smooth: cubic-bezier(0.4, 0, 0.2, 1);
    }

    .container-custom {
        max-width: 1400px;
        margin: 0 auto;
        padding: 0 40px;
    }

    @media (max-width: 768px) {
        .container-custom {
            padding: 0 20px;
        }
    }

    /* Image Gallery */
    .image-gallery {
        display: grid;
        gap: 20px;
    }

    .main-image {
        aspect-ratio: 3/2;
        overflow: hidden;
        background: var(--off-white);
        position: relative;
    }

    .main-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.6s var(--transition-smooth);
    }

    .main-image:hover img {
        transform: scale(1.1);
    }

    .thumbnail-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(100px, 1fr));
        gap: 10px;
    }

    .thumbnail {
        aspect-ratio: 1;
        overflow: hidden;
        background: var(--off-white);
        cursor: pointer;
        opacity: 0.6;
        transition: opacity 0.3s ease;
    }

    .thumbnail:hover,
    .thumbnail.active {
        opacity: 1;
    }

    .thumbnail img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    /* Product Info */
    .product-detail-section {
        border-bottom: 1px solid var(--soft-gray);
        padding: 30px 0;
    }

    .product-detail-section:last-child {
        border-bottom: none;
    }

    /* Features Table */
    .features-table {
        display: grid;
        gap: 16px;
    }

    .feature-row {
        display: grid;
        grid-template-columns: 1fr 2fr;
        gap: 20px;
        padding: 12px 0;
        border-bottom: 1px solid var(--soft-gray);
    }

    .feature-row:last-child {
        border-bottom: none;
    }

    /* Zoom indicator */
    .zoom-indicator {
        position: absolute;
        top: 20px;
        right: 20px;
        background: white;
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .main-image:hover .zoom-indicator {
        opacity: 1;
    }

    /* Related products */
    .related-product {
        transition: transform 0.3s var(--transition-smooth);
    }

    .related-product:hover {
        transform: translateY(-5px);
    }

    /* Tabs */
    .tab-button {
        padding: 16px 32px;
        font-size: 14px;
        letter-spacing: 0.1em;
        text-transform: uppercase;
        background: transparent;
        border: none;
        border-bottom: 2px solid transparent;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .tab-button.active {
        border-bottom-color: var(--primary-black);
    }

    .tab-content {
        display: none;
        padding: 40px 0;
    }

    .tab-content.active {
        display: block;
    }

    /* Badge */
    .badge {
        background: var(--primary-black);
        color: white;
        padding: 6px 16px;
        font-size: 11px;
        letter-spacing: 0.1em;
        text-transform: uppercase;
        display: inline-block;
    }

    .badge-sale {
        background: var(--accent-blue);
    }


</style>

<!-- Breadcrumb -->
<section class="py-8 bg-white">
    <div class="container-custom">
        <nav class="text-sm">
            <ol class="flex items-center space-x-2 text-gray-500">
                <li><a href="/" class="hover:text-black transition-colors">Inicio</a></li>
                <li>/</li>
                <li><a href="{{ route('catalog.index') }}" class="hover:text-black transition-colors">Catálogo</a></li>
                @if($product->category)
                <li>/</li>
                <li><a href="{{ route('catalog.index', ['categoria' => $product->category->slug]) }}" class="hover:text-black transition-colors">{{ $product->category->name }}</a></li>
                @endif
                <li>/</li>
                <li class="text-black">{{ $product->name }}</li>
            </ol>
        </nav>
    </div>
</section>

<!-- Product Detail -->
<section class="py-12 bg-white">
    <div class="container-custom">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-20">
            
            <!-- Images Gallery -->
            <div class="image-gallery">
                <div class="main-image">
                    <img id="mainImage" 
                         src="{{ $product->featured_image ? asset('storage/' . $product->featured_image) : 'https://via.placeholder.com/800x600' }}" 
                         alt="{{ $product->name }}">
                    <div class="zoom-indicator">
                        <i class="fas fa-search-plus"></i>
                    </div>
                </div>

                @if($product->images->count() > 0)
                <div class="thumbnail-grid">
                    <div class="thumbnail active" onclick="changeImage('{{ $product->featured_image ? asset('storage/' . $product->featured_image) : 'https://via.placeholder.com/800x600' }}')">
                        <img src="{{ $product->featured_image ? asset('storage/' . $product->featured_image) : 'https://via.placeholder.com/100x100' }}" 
                             alt="{{ $product->name }}">
                    </div>
                    @foreach($product->images as $image)
                    <div class="thumbnail" onclick="changeImage('{{ asset('storage/' . $image->image_path) }}')">
                        <img src="{{ asset('storage/' . $image->image_path) }}" 
                             alt="{{ $product->name }}">
                    </div>
                    @endforeach
                </div>
                @endif
            </div>

            <!-- Product Info -->
            <div>
                <!-- Brand & Category -->
                <div class="flex items-center space-x-3 text-sm mb-4">
                    <a href="{{ route('catalog.index', ['marca' => $product->brand->slug]) }}" class="text-gray-500 hover:text-black transition-colors">
                        {{ $product->brand->name }}
                    </a>
                    <span class="text-gray-300">|</span>
                    <a href="{{ route('catalog.index', ['categoria' => $product->category->slug]) }}" class="text-gray-500 hover:text-black transition-colors">
                        {{ $product->category->name }}
                    </a>
                </div>

                <!-- Name -->
                <h1 class="text-4xl font-light mb-6">{{ $product->name }}</h1>

                <!-- Badges -->
                <div class="flex space-x-2 mb-6">
                    @if($product->is_new)
                        <span class="badge">Nuevo</span>
                    @endif
                    @if($product->sale_price)
                        <span class="badge badge-sale">-{{ round((($product->price - $product->sale_price) / $product->price) * 100) }}%</span>
                    @endif
                </div>

                <!-- Price -->
                <div class="text-3xl mb-8">
                    @if($product->sale_price)
                        <span class="text-blue-600">S/ {{ number_format($product->sale_price, 2) }}</span>
                        <span class="text-gray-400 line-through ml-3 text-2xl">S/ {{ number_format($product->price, 2) }}</span>
                    @else
                        <span>S/ {{ number_format($product->price, 2) }}</span>
                    @endif
                </div>

                <!-- Short Description -->
                @if($product->short_description)
                <div class="product-detail-section">
                    <p class="text-gray-600 leading-relaxed">
                        {{ $product->short_description }}
                    </p>
                </div>
                @endif

                <!-- Key Features -->
                <div class="product-detail-section">
                    <div class="grid grid-cols-2 gap-6">
                        @if($product->gender)
                        <div>
                            <p class="text-sm text-gray-500 mb-1">Género</p>
                            <p class="font-light capitalize">{{ $product->gender }}</p>
                        </div>
                        @endif
                        
                        @if($product->type)
                        <div>
                            <p class="text-sm text-gray-500 mb-1">Tipo</p>
                            <p class="font-light capitalize">{{ $product->type }}</p>
                        </div>
                        @endif
                        
                        @if($product->frame_color)
                        <div>
                            <p class="text-sm text-gray-500 mb-1">Color de Montura</p>
                            <p class="font-light">{{ $product->frame_color }}</p>
                        </div>
                        @endif
                        
                        @if($product->frame_material)
                        <div>
                            <p class="text-sm text-gray-500 mb-1">Material</p>
                            <p class="font-light">{{ $product->frame_material }}</p>
                        </div>
                        @endif
                        
                        @if($product->lens_type)
                        <div>
                            <p class="text-sm text-gray-500 mb-1">Tipo de Lente</p>
                            <p class="font-light">{{ $product->lens_type }}</p>
                        </div>
                        @endif
                        
                        @if($product->size)
                        <div>
                            <p class="text-sm text-gray-500 mb-1">Talla</p>
                            <p class="font-light">{{ $product->size }}</p>
                        </div>
                        @endif
                    </div>
                </div>

                <!-- Actions -->
                @php
                    $whatsappNumber = '51923323517'; // Número sin el +
                    $productUrl = url()->current();
                    $productPrice = $product->sale_price ?? $product->price;
                    
                    // Mensaje para consultar disponibilidad
                    $consultationMessage = "¡Hola! \n\n";
                    $consultationMessage .= "Me interesa el producto:\n\n";
                    $consultationMessage .= "*{$product->name}*\n";
                    $consultationMessage .= "Marca: {$product->brand->name}\n";
                    $consultationMessage .= "Precio: S/ " . number_format($productPrice, 2) . "\n";
                    if($product->sale_price) {
                        $consultationMessage .= " *¡En oferta!* (Antes: S/ " . number_format($product->price, 2) . ")\n";
                    }
                    $consultationMessage .= " SKU: {$product->sku}\n\n";
                    $consultationMessage .= " Link del producto:\n{$productUrl}\n\n";
                    $consultationMessage .= "¿Podrían confirmarme la disponibilidad? Gracias ";
                    
                    // Mensaje para agendar prueba
                    $scheduleMessage = "¡Hola! \n\n";
                    $scheduleMessage .= "Me gustaría agendar una prueba para:\n\n";
                    $scheduleMessage .= "*{$product->name}*\n";
                    $scheduleMessage .= "Marca: {$product->brand->name}\n";
                    $scheduleMessage .= "Precio: S/ " . number_format($productPrice, 2) . "\n\n";
                    $scheduleMessage .= "Link del producto:\n{$productUrl}\n\n";
                    $scheduleMessage .= "¿Cuándo podría visitarlos para probármelo? \n";
                    $scheduleMessage .= "Mi disponibilidad es:\n";
                    $scheduleMessage .= "• Mañanas \n";
                    $scheduleMessage .= "• Tardes \n\n";
                    $scheduleMessage .= "¡Espero su respuesta! ";
                    
                    // Codificar mensajes para URL
                    $consultationMessageEncoded = urlencode($consultationMessage);
                    $scheduleMessageEncoded = urlencode($scheduleMessage);
                @endphp

                <div class="flex flex-col sm:flex-row gap-4 mb-8">
                    <a href="https://wa.me/{{ $whatsappNumber }}?text={{ $consultationMessageEncoded }}" 
                       target="_blank"
                       class="flex-1 bg-black text-white text-center py-4 hover:bg-gray-800 transition-colors text-sm uppercase tracking-wider">
                        Consultar disponibilidad
                    </a>
                    <a href="https://wa.me/{{ $whatsappNumber }}?text={{ $scheduleMessageEncoded }}" 
                       target="_blank"
                       class="flex-1 border border-black text-black text-center py-4 hover:bg-black hover:text-white transition-all text-sm uppercase tracking-wider">
                        Agendar prueba
                    </a>
                </div>

                <!-- Additional Info -->
                <div class="space-y-2 text-sm text-gray-500">
                    <p>SKU: {{ $product->sku }}</p>
                    <p>Vistas: {{ $product->views }}</p>
                </div>
            </div>
        </div>

        <!-- Tabs Section -->
        <div class="mt-20">
            <div class="border-b border-gray-200">
                <div class="flex space-x-8">
                    <button class="tab-button active" onclick="showTab('description')">Descripción</button>
                    @if($product->features->count() > 0)
                    <button class="tab-button" onclick="showTab('features')">Especificaciones</button>
                    @endif
                    <button class="tab-button" onclick="showTab('brand')">Sobre la marca</button>
                </div>
            </div>

            <!-- Tab Contents -->
            <div id="description" class="tab-content active">
                @if($product->description)
                    <div class="prose max-w-none">
                        {!! nl2br(e($product->description)) !!}
                    </div>
                @else
                    <p class="text-gray-600">{{ $product->short_description }}</p>
                @endif
            </div>

            @if($product->features->count() > 0)
            <div id="features" class="tab-content">
                <div class="features-table max-w-2xl">
                    @foreach($product->features as $feature)
                    <div class="feature-row">
                        <div class="text-gray-500">{{ $feature->name }}</div>
                        <div>{{ $feature->value }}</div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif

            <div id="brand" class="tab-content">
                <div class="flex items-start space-x-8">
                    @if($product->brand->logo)
                    <img src="{{ asset('storage/' . $product->brand->logo) }}" 
                         alt="{{ $product->brand->name }}" 
                         class="w-32 h-auto">
                    @endif
                    <div>
                        <h3 class="text-2xl font-light mb-4">{{ $product->brand->name }}</h3>
                        @if($product->brand->description)
                            <p class="text-gray-600 leading-relaxed">{{ $product->brand->description }}</p>
                        @endif
                        @if($product->brand->website)
                            <a href="{{ $product->brand->website }}" target="_blank" class="inline-flex items-center mt-4 text-sm text-blue-600 hover:text-blue-800">
                                Visitar sitio web <i class="fas fa-external-link-alt ml-2 text-xs"></i>
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Related Products -->
@if($relatedProducts->count() > 0)
<section class="py-20 bg-gray-50">
    <div class="container-custom">
        <h2 class="text-3xl font-light text-center mb-12">Productos Relacionados</h2>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            @foreach($relatedProducts as $related)
            <article class="related-product bg-white">
                <a href="{{ route('catalog.show', $related->slug) }}" class="block">
                    <div class="aspect-[3/2] overflow-hidden bg-gray-100">
                        <img src="{{ $related->featured_image ? asset('storage/' . $related->featured_image) : 'https://via.placeholder.com/400x300' }}" 
                             alt="{{ $related->name }}"
                             class="w-full h-full object-cover hover:scale-105 transition-transform duration-500">
                    </div>
                    <div class="p-6">
                        <p class="text-xs text-gray-500 uppercase tracking-wider mb-2">{{ $related->brand->name }}</p>
                        <h3 class="font-light mb-3">{{ $related->name }}</h3>
                        <p class="text-lg">
                            @if($related->sale_price)
                                <span class="text-blue-600">S/ {{ number_format($related->sale_price, 2) }}</span>
                            @else
                                S/ {{ number_format($related->price, 2) }}
                            @endif
                        </p>
                    </div
                </a>
            </article>
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- Brand Products -->
@if($brandProducts->count() > 0)
<section class="py-20 bg-white">
    <div class="container-custom">
        <h2 class="text-3xl font-light text-center mb-12">Más de {{ $product->brand->name }}</h2>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach($brandProducts as $brandProduct)
            <article class="text-center">
                <a href="{{ route('catalog.show', $brandProduct->slug) }}" class="block group">
                    <div class="aspect-square overflow-hidden bg-gray-100 mb-6">
                        <img src="{{ $brandProduct->featured_image ? asset('storage/' . $brandProduct->featured_image) : 'https://via.placeholder.com/400x400' }}" 
                             alt="{{ $brandProduct->name }}"
                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    </div>
                    <h3 class="font-light text-lg mb-2 group-hover:text-blue-600 transition-colors">{{ $brandProduct->name }}</h3>
                    <p class="text-gray-600">
                        @if($brandProduct->sale_price)
                            <span class="text-blue-600">S/ {{ number_format($brandProduct->sale_price, 2) }}</span>
                        @else
                            S/ {{ number_format($brandProduct->price, 2) }}
                        @endif
                    </p>
                </a>
            </article>
            @endforeach
        </div>
        
        <div class="text-center mt-12">
            <a href="{{ route('catalog.index', ['marca' => $product->brand->slug]) }}" 
               class="inline-flex items-center text-black border-b border-black pb-1 hover:pb-2 transition-all">
                Ver todos los productos de {{ $product->brand->name }}
                <i class="fas fa-arrow-right ml-2"></i>
            </a>
        </div>
    </div>
</section>
@endif

<script>
// Change main image
function changeImage(src) {
    document.getElementById('mainImage').src = src;
    
    // Update active thumbnail
    document.querySelectorAll('.thumbnail').forEach(thumb => {
        thumb.classList.remove('active');
    });
    event.currentTarget.classList.add('active');
}

// Tabs functionality
function showTab(tabName) {
    // Hide all tabs
    document.querySelectorAll('.tab-content').forEach(tab => {
        tab.classList.remove('active');
    });
    
    // Remove active class from buttons
    document.querySelectorAll('.tab-button').forEach(btn => {
        btn.classList.remove('active');
    });
    
    // Show selected tab
    document.getElementById(tabName).classList.add('active');
    event.currentTarget.classList.add('active');
}

// Image zoom on hover (optional enhancement)
const mainImage = document.querySelector('.main-image');
const img = mainImage.querySelector('img');

mainImage.addEventListener('mousemove', (e) => {
    const rect = mainImage.getBoundingClientRect();
    const x = e.clientX - rect.left;
    const y = e.clientY - rect.top;
    
    const xPercent = (x / rect.width) * 100;
    const yPercent = (y / rect.height) * 100;
    
    img.style.transformOrigin = `${xPercent}% ${yPercent}%`;
});

mainImage.addEventListener('mouseleave', () => {
    img.style.transformOrigin = 'center';
});
</script>

@endsection