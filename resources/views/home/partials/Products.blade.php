{{-- Products Collection Section - Ultra Modern Grid --}}
<section class="py-4 lg:py-6 bg-white">
    {{-- Full Width Layout --}}
    <div class="px-2 sm:px-3 lg:px-4">
        
        {{-- Compact Header --}}
        <div class="text-center mb-4">
            <p class="text-[10px] uppercase tracking-widest text-gray-500">SELECCIÓN EXCLUSIVA</p>
            <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold text-gray-900">
                NUESTRA <span class="font-light italic text-red-600">COLECCIÓN</span>
            </h2>
            <p class="text-sm text-gray-600 mt-1">Diseños que marcan tendencia</p>
        </div>

        {{-- Filter Pills - Minimal Design --}}
        <div class="flex flex-wrap justify-center gap-2 mb-6">
            <button onclick="filterProducts('new')" 
                    class="filter-btn active" 
                    data-filter="new">
                <span>NUEVOS</span>
                <span class="ml-1">🔥</span>
            </button>
            <button onclick="filterProducts('featured')" 
                    class="filter-btn" 
                    data-filter="featured">
                <span>DESTACADOS</span>
                <span class="ml-1">⭐</span>
            </button>
            <button onclick="filterProducts('sale')" 
                    class="filter-btn" 
                    data-filter="sale">
                <span>OFERTAS</span>
                <span class="ml-1">💎</span>
            </button>
        </div>

        {{-- Products Container --}}
        <div class="relative min-h-[400px]">
            
            {{-- New Products Section --}}
            <div id="new-products" class="product-section active">
                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 gap-[2px]">
                    @forelse($newProducts as $product)
                        <a href="#" class="group relative overflow-hidden bg-gray-100 aspect-[3/4] block">
                            {{-- Product Image --}}
                            @if($product->featured_image)
                                <img src="{{ asset('storage/' . $product->featured_image) }}" 
                                     alt="{{ $product->name }}"
                                     class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
                                     loading="lazy">
                            @elseif($product->model_image_url)
                                <img src="{{ asset('storage/' . $product->model_image_url) }}" 
                                     alt="{{ $product->name }}"
                                     class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
                                     loading="lazy">
                            @else
                                <div class="w-full h-full bg-gradient-to-br from-gray-200 to-gray-300"></div>
                            @endif
                            
                            {{-- Gradient Overlay --}}
                            <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                            
                            {{-- NEW Badge --}}
                            <div class="absolute top-2 left-2">
                                <div class="bg-red-600 text-white text-[8px] px-2 py-1 font-bold">
                                    NEW
                                </div>
                            </div>
                            
                            {{-- Product Info --}}
                            <div class="absolute bottom-0 left-0 right-0 p-2 lg:p-3 bg-gradient-to-t from-white via-white/95 to-transparent">
                                @if($product->brand)
                                    <p class="text-[9px] uppercase tracking-wider text-gray-500">
                                        {{ $product->brand->name }}
                                    </p>
                                @endif
                                <h3 class="text-[10px] lg:text-xs font-medium text-gray-900 line-clamp-1">
                                    {{ $product->name }}
                                </h3>
                                <p class="text-sm lg:text-base font-bold text-gray-900 mt-0.5">
                                    @if($product->sale_price)
                                        <span class="text-red-600">S/ {{ number_format($product->sale_price, 0) }}</span>
                                        <span class="text-[10px] line-through text-gray-400 ml-1">{{ number_format($product->price, 0) }}</span>
                                    @else
                                        S/ {{ number_format($product->price, 0) }}
                                    @endif
                                </p>
                            </div>
                            
                            {{-- Quick Add Button (on hover) --}}
                            <div class="absolute bottom-3 right-3 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                <div class="bg-black text-white p-2 rounded-full">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                    </svg>
                                </div>
                            </div>
                        </a>
                    @empty
                        <div class="col-span-full text-center py-12">
                            <p class="text-gray-400">No hay productos nuevos disponibles</p>
                        </div>
                    @endforelse
                </div>
            </div>

            {{-- Featured Products Section --}}
            <div id="featured-products" class="product-section hidden">
                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 gap-[2px]">
                    @forelse($featuredProducts->take(12) as $product)
                        <a href="#" class="group relative overflow-hidden bg-gray-100 aspect-[3/4] block">
                            {{-- Product Image --}}
                            @if($product->model_image)
                                <img src="{{ $product->model_image_url }}" 
                                     alt="{{ $product->name }}"
                                     class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
                                     loading="lazy">
                            @elseif($product->featured_image)
                                <img src="{{ asset('storage/' . $product->featured_image) }}" 
                                     alt="{{ $product->name }}"
                                     class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
                                     loading="lazy">
                            @else
                                <div class="w-full h-full bg-gradient-to-br from-gray-200 to-gray-300"></div>
                            @endif
                            
                            {{-- Gradient Overlay --}}
                            <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                            
                            {{-- STAR Badge --}}
                            <div class="absolute top-2 left-2">
                                <div class="bg-yellow-500 text-white text-[8px] px-2 py-1 font-bold">
                                    ⭐ TOP
                                </div>
                            </div>
                            
                            {{-- Product Info --}}
                            <div class="absolute bottom-0 left-0 right-0 p-2 lg:p-3 bg-gradient-to-t from-white via-white/95 to-transparent">
                                @if($product->brand)
                                    <p class="text-[9px] uppercase tracking-wider text-gray-500">
                                        {{ $product->brand->name }}
                                    </p>
                                @endif
                                <h3 class="text-[10px] lg:text-xs font-medium text-gray-900 line-clamp-1">
                                    {{ $product->name }}
                                </h3>
                                <p class="text-sm lg:text-base font-bold text-gray-900 mt-0.5">
                                    @if($product->sale_price)
                                        <span class="text-red-600">S/ {{ number_format($product->sale_price, 0) }}</span>
                                        <span class="text-[10px] line-through text-gray-400 ml-1">{{ number_format($product->price, 0) }}</span>
                                    @else
                                        S/ {{ number_format($product->price, 0) }}
                                    @endif
                                </p>
                            </div>
                            
                            {{-- Quick Add Button (on hover) --}}
                            <div class="absolute bottom-3 right-3 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                <div class="bg-black text-white p-2 rounded-full">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                    </svg>
                                </div>
                            </div>
                        </a>
                    @empty
                        <div class="col-span-full text-center py-12">
                            <p class="text-gray-400">No hay productos destacados disponibles</p>
                        </div>
                    @endforelse
                </div>
            </div>

            {{-- Sale Products Section --}}
            <div id="sale-products" class="product-section hidden">
                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 gap-[2px]">
                    @forelse($saleProducts as $product)
                        <a href="#" class="group relative overflow-hidden bg-gray-100 aspect-[3/4] block">
                            {{-- Product Image --}}
                            @if($product->model_image)
                                <img src="{{ $product->model_image_url }}" 
                                     alt="{{ $product->name }}"
                                     class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
                                     loading="lazy">
                            @elseif($product->featured_image)
                                <img src="{{ asset('storage/' . $product->featured_image) }}" 
                                     alt="{{ $product->name }}"
                                     class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
                                     loading="lazy">
                            @else
                                <div class="w-full h-full bg-gradient-to-br from-gray-200 to-gray-300"></div>
                            @endif
                            
                            {{-- Gradient Overlay --}}
                            <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                            
                            {{-- SALE Badge with Percentage --}}
                            <div class="absolute top-2 left-2">
                                @if($product->discount_percentage > 0)
                                    <div class="bg-red-600 text-white text-[8px] px-2 py-1 font-bold">
                                        -{{ $product->discount_percentage }}%
                                    </div>
                                @else
                                    <div class="bg-green-600 text-white text-[8px] px-2 py-1 font-bold">
                                        OFERTA
                                    </div>
                                @endif
                            </div>
                            
                            {{-- Product Info --}}
                            <div class="absolute bottom-0 left-0 right-0 p-2 lg:p-3 bg-gradient-to-t from-white via-white/95 to-transparent">
                                @if($product->brand)
                                    <p class="text-[9px] uppercase tracking-wider text-gray-500">
                                        {{ $product->brand->name }}
                                    </p>
                                @endif
                                <h3 class="text-[10px] lg:text-xs font-medium text-gray-900 line-clamp-1">
                                    {{ $product->name }}
                                </h3>
                                <p class="text-sm lg:text-base font-bold text-gray-900 mt-0.5">
                                    @if($product->sale_price)
                                        <span class="text-red-600">S/ {{ number_format($product->sale_price, 0) }}</span>
                                        <span class="text-[10px] line-through text-gray-400 ml-1">{{ number_format($product->price, 0) }}</span>
                                    @else
                                        <span class="text-green-600">S/ {{ number_format($product->price, 0) }}</span>
                                    @endif
                                </p>
                            </div>
                            
                            {{-- Quick Add Button (on hover) --}}
                            <div class="absolute bottom-3 right-3 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                <div class="bg-black text-white p-2 rounded-full">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                    </svg>
                                </div>
                            </div>
                        </a>
                    @empty
                        <div class="col-span-full text-center py-12">
                            <p class="text-gray-400">No hay ofertas disponibles</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

        {{-- View All CTA --}}
        <div class="text-center mt-6">
            <a href="#" 
               class="inline-flex items-center gap-2 bg-black hover:bg-gray-900 text-white font-medium px-6 py-3 rounded transition-all duration-300 transform hover:scale-105">
                <span>VER TODO EL CATÁLOGO</span>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                </svg>
            </a>
        </div>
    </div>
</section>

{{-- Styles for Filter System --}}
<style>
/* Filter Pills */
.filter-btn {
    @apply px-4 py-2 text-xs font-bold uppercase tracking-wider rounded-full transition-all duration-300 border;
    @apply bg-white text-gray-600 border-gray-200 hover:border-gray-400;
}

.filter-btn.active {
    @apply bg-black text-white border-black shadow-lg;
    transform: translateY(-2px);
}

/* Product Sections Animation */
.product-section {
    @apply absolute inset-0 w-full;
    transition: opacity 0.3s ease-in-out, transform 0.3s ease-in-out;
}

.product-section.hidden {
    @apply opacity-0 pointer-events-none;
    transform: translateY(10px);
}

.product-section.active {
    @apply opacity-100;
    transform: translateY(0);
}

/* Quick Add Button Animation */
.group:hover .quick-add {
    animation: pulse 1s infinite;
}

@keyframes pulse {
    0%, 100% { transform: scale(1); }
    50% { transform: scale(1.1); }
}

/* Responsive Grid Adjustments */
@media (max-width: 640px) {
    .filter-btn {
        @apply px-3 py-1.5 text-[10px];
    }
}
</style>

{{-- Filter JavaScript --}}
<script>
function filterProducts(filter) {
    // Get all sections and buttons
    const sections = document.querySelectorAll('.product-section');
    const buttons = document.querySelectorAll('.filter-btn');
    
    // Hide all sections with animation
    sections.forEach(section => {
        section.classList.remove('active');
        section.classList.add('hidden');
    });
    
    // Remove active class from all buttons
    buttons.forEach(btn => {
        btn.classList.remove('active');
    });
    
    // Show selected section with delay for smooth transition
    setTimeout(() => {
        const targetSection = document.getElementById(filter + '-products');
        if (targetSection) {
            targetSection.classList.remove('hidden');
            requestAnimationFrame(() => {
                targetSection.classList.add('active');
            });
        }
        
        // Activate the clicked button
        const activeBtn = document.querySelector(`[data-filter="${filter}"]`);
        if (activeBtn) {
            activeBtn.classList.add('active');
        }
    }, 100);
}

// Initialize on page load
document.addEventListener('DOMContentLoaded', () => {
    // Set initial filter
    filterProducts('new');
    
    // Add smooth scroll behavior
    document.querySelectorAll('.filter-btn').forEach(btn => {
        btn.addEventListener('click', (e) => {
            e.preventDefault();
            const filter = btn.dataset.filter;
            filterProducts(filter);
        });
    });
});

// Add keyboard navigation
document.addEventListener('keydown', (e) => {
    if (e.key === 'ArrowLeft' || e.key === 'ArrowRight') {
        const filters = ['new', 'featured', 'sale'];
        const activeFilter = document.querySelector('.filter-btn.active').dataset.filter;
        const currentIndex = filters.indexOf(activeFilter);
        
        let newIndex;
        if (e.key === 'ArrowLeft') {
            newIndex = currentIndex > 0 ? currentIndex - 1 : filters.length - 1;
        } else {
            newIndex = currentIndex < filters.length - 1 ? currentIndex + 1 : 0;
        }
        
        filterProducts(filters[newIndex]);
    }
});
</script>