{{-- resources/views/catalog/partials/quick-view.blade.php --}}
<div class="grid grid-cols-1 md:grid-cols-2 gap-8">
    <!-- Product Images -->
    <div class="space-y-4">
        @if($product->images->count() > 0)
            <div class="aspect-square bg-gray-100">
                <img src="{{ asset('storage/' . $product->images->first()->image_path) }}" 
                     alt="{{ $product->name }}"
                     class="w-full h-full object-cover"
                     id="quickViewMainImage">
            </div>
            
            @if($product->images->count() > 1)
            <div class="grid grid-cols-4 gap-2">
                @foreach($product->images as $image)
                <button onclick="changeQuickViewImage('{{ asset('storage/' . $image->image_path) }}')" 
                        class="aspect-square bg-gray-100 hover:opacity-75 transition">
                    <img src="{{ asset('storage/' . $image->image_path) }}" 
                         alt="{{ $image->alt_text ?: $product->name }}"
                         class="w-full h-full object-cover">
                </button>
                @endforeach
            </div>
            @endif
        @elseif($product->featured_image)
            <div class="aspect-square bg-gray-100">
                <img src="{{ asset('storage/' . $product->featured_image) }}" 
                     alt="{{ $product->name }}"
                     class="w-full h-full object-cover">
            </div>
        @else
            <div class="aspect-square bg-gray-100 flex items-center justify-center">
                <span class="text-gray-400">Sin imagen</span>
            </div>
        @endif
    </div>

    <!-- Product Info -->
    <div class="space-y-6">
        <!-- Brand & Category -->
        <div class="text-sm text-gray-500">
            <span>{{ $product->brand->name }}</span>
            <span class="mx-2">•</span>
            <span>{{ $product->category->name }}</span>
        </div>

        <!-- Name -->
        <h2 class="text-2xl font-light">{{ $product->name }}</h2>

        <!-- Price -->
        <div class="text-2xl">
            @if($product->sale_price)
                <span class="text-blue-600">S/ {{ number_format($product->sale_price, 2) }}</span>
                <span class="text-lg text-gray-400 line-through ml-2">S/ {{ number_format($product->price, 2) }}</span>
                <span class="text-sm text-red-500 ml-2">-{{ $product->discount_percentage }}%</span>
            @else
                <span>S/ {{ number_format($product->price, 2) }}</span>
            @endif
        </div>

        <!-- SKU -->
        <div class="text-sm text-gray-500">
            SKU: {{ $product->sku }}
        </div>

        <!-- Short Description -->
        @if($product->short_description)
        <p class="text-gray-600">{{ $product->short_description }}</p>
        @endif

        <!-- Key Features -->
        <div class="space-y-3 py-4 border-y border-gray-200">
            @if($product->gender)
            <div class="flex justify-between text-sm">
                <span class="text-gray-500">Género:</span>
                <span>{{ ucfirst($product->gender) }}</span>
            </div>
            @endif
            
            @if($product->type)
            <div class="flex justify-between text-sm">
                <span class="text-gray-500">Tipo:</span>
                <span>{{ ucfirst($product->type) }}</span>
            </div>
            @endif
            
            @if($product->frame_material)
            <div class="flex justify-between text-sm">
                <span class="text-gray-500">Material:</span>
                <span>{{ ucfirst($product->frame_material) }}</span>
            </div>
            @endif
            
            @if($product->frame_color)
            <div class="flex justify-between text-sm">
                <span class="text-gray-500">Color Marco:</span>
                <span>{{ ucfirst($product->frame_color) }}</span>
            </div>
            @endif
            
            @if($product->lens_type)
            <div class="flex justify-between text-sm">
                <span class="text-gray-500">Tipo Lente:</span>
                <span>{{ ucfirst($product->lens_type) }}</span>
            </div>
            @endif
            
            @if($product->size)
            <div class="flex justify-between text-sm">
                <span class="text-gray-500">Tamaño:</span>
                <span>{{ $product->size }}</span>
            </div>
            @endif
        </div>

        <!-- Additional Features -->
        @if($product->features->count() > 0)
        <div class="space-y-2">
            <h3 class="text-sm font-medium text-gray-700">Características adicionales:</h3>
            <ul class="space-y-1">
                @foreach($product->features->take(5) as $feature)
                <li class="text-sm text-gray-600 flex">
                    <span class="text-gray-400 mr-2">•</span>
                    <span><strong>{{ $feature->name }}:</strong> {{ $feature->value }}</span>
                </li>
                @endforeach
            </ul>
        </div>
        @endif

        <!-- CTA Buttons -->
        <div class="flex gap-4 pt-4">
            <a href="{{ route('catalog.show', $product->slug) }}" 
               class="flex-1 bg-black text-white py-3 text-center hover:bg-gray-800 transition">
                Ver Detalles Completos
            </a>
            <button onclick="closeQuickView()" 
                    class="px-6 py-3 border border-gray-300 hover:border-gray-400 transition">
                Cerrar
            </button>
        </div>
    </div>
</div>

<script>
function changeQuickViewImage(imageSrc) {
    document.getElementById('quickViewMainImage').src = imageSrc;
}
</script>