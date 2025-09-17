{{-- resources/views/catalog/partials/products-grid.blade.php --}}
@if($products->count() > 0)
    <div class="product-grid">
        @foreach($products as $product)
        <article class="product-card reveal">
            <!-- Badges -->
            @if($product->is_new)
                <span class="badge">Nuevo</span>
            @elseif($product->isOnSale)
                <span class="badge badge-sale">-{{ $product->discount_percentage }}%</span>
            @endif

            <!-- Image -->
            <a href="{{ route('catalog.show', $product->slug) }}" class="block">
                <div class="product-image-container">
                    <img src="{{ $product->main_image ? asset('storage/' . $product->main_image) : 'https://via.placeholder.com/400x300' }}" 
                         alt="{{ $product->name }}"
                         class="product-image"
                         loading="lazy">
                    
                    <!-- Overlay with quick actions -->
                    <div class="product-overlay">
                        <button onclick="quickView({{ $product->id }})" class="quick-view-btn">
                            Vista rápida
                        </button>
                    </div>
                </div>
            </a>

            <!-- Info -->
            <div class="product-info">
                <p class="product-brand">{{ $product->brand->name }}</p>
                <h3 class="product-name">
                    <a href="{{ route('catalog.show', $product->slug) }}">{{ $product->name }}</a>
                </h3>
                <div class="product-price">
                    @if($product->sale_price)
                        <span class="price-sale">S/ {{ number_format($product->sale_price, 2) }}</span>
                        <span class="price-original">S/ {{ number_format($product->price, 2) }}</span>
                    @else
                        <span>S/ {{ number_format($product->price, 2) }}</span>
                    @endif
                </div>
                
                <!-- Quick info -->
                <div class="product-quick-info text-xs text-gray-500 mt-2">
                    @if($product->gender)
                        <span>{{ ucfirst($product->gender) }}</span>
                    @endif
                    @if($product->type)
                        <span class="ml-2">{{ ucfirst($product->type) }}</span>
                    @endif
                </div>
            </div>
        </article>
        @endforeach
    </div>

    <!-- Pagination -->
    @if($products->hasPages())
    <div class="pagination">
        {{ $products->links() }}
    </div>
    @endif
@else
    <div class="text-center py-20">
        <i class="fas fa-search text-6xl text-gray-200 mb-6"></i>
        <h3 class="text-2xl font-light text-gray-600 mb-4">No se encontraron productos</h3>
        <p class="text-gray-500 mb-8">Intenta ajustar los filtros o realizar otra búsqueda</p>
        <a href="{{ route('catalog.index') }}" class="inline-flex items-center text-black border-b border-black pb-1 hover:pb-2 transition-all">
            Ver todos los productos
        </a>
    </div>
@endif