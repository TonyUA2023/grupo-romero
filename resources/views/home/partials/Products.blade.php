{{-- Products Collection Section - Ultra Modern & Elegant Grid --}}
{{-- CAMBIO: Fondo actualizado a 'bg-light' (#F2F2F2) para suavidad visual --}}
<section class="py-12 lg:py-16 bg-light">
    {{-- Full Width Layout con padding ajustado --}}
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        
        {{-- Elegant Header --}}
        <div class="text-center mb-10">
            {{-- CAMBIO: Texto gris corporativo y fuente Poppins --}}
            <p class="text-xs font-medium uppercase tracking-[0.2em] text-dark/60 mb-2">Selección Exclusiva</p>
            <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold text-dark mb-3">
                Nuestra <span class="font-light italic text-primary">Colección</span>
            </h2>
            <div class="w-16 h-1 bg-accent mx-auto rounded-full"></div>
            <p class="text-dark/80 mt-4 max-w-2xl mx-auto font-light">Descubre monturas que combinan tecnología de vanguardia con las últimas tendencias en moda visual.</p>
        </div>

        {{-- Filter Pills - Elegant Style --}}
        <div class="flex flex-wrap justify-center gap-4 mb-10">
            {{-- 
                CAMBIO: Botones con bordes redondeados suaves y colores corporativos.
                Estado activo: bg-primary, text-white.
                Estado inactivo: bg-white, text-dark, border-gray-200.
            --}}
            <button onclick="filterProducts('new')" 
                    class="filter-btn active group" 
                    data-filter="new">
                <span class="relative z-10">NUEVOS INGRESOS</span>
            </button>
            <button onclick="filterProducts('featured')" 
                    class="filter-btn group" 
                    data-filter="featured">
                <span class="relative z-10">DESTACADOS</span>
            </button>
            <button onclick="filterProducts('sale')" 
                    class="filter-btn group" 
                    data-filter="sale">
                <span class="relative z-10">OFERTAS ESPECIALES</span>
            </button>
        </div>

        {{-- Products Container --}}
        <div class="relative min-h-[500px]">
            
            {{-- New Products Section --}}
            <div id="new-products" class="product-section active">
                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4 lg:gap-6">
                    @forelse($newProducts as $product)
                        {{-- CAMBIO: Tarjeta con fondo blanco, bordes redondeados y sombra suave --}}
                        <a href="#" class="group relative bg-white rounded-xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                            
                            {{-- Image Container --}}
                            <div class="aspect-[4/5] overflow-hidden bg-gray-100 relative">
                                @if($product->featured_image)
                                    <img src="{{ asset('storage/'. $product->featured_image) }}" 
                                         alt="{{ $product->name }}"
                                         class="w-full h-full object-cover object-center group-hover:scale-110 transition-transform duration-700"
                                         loading="lazy">
                                @elseif($product->model_image_url)
                                    <img src="{{ asset('storage/'. $product->model_image_url) }}" 
                                         alt="{{ $product->name }}"
                                         class="w-full h-full object-cover object-center group-hover:scale-110 transition-transform duration-700"
                                         loading="lazy">
                                @else
                                    <div class="w-full h-full flex items-center justify-center bg-gray-100 text-gray-300">
                                        <i class="fas fa-glasses text-4xl"></i>
                                    </div>
                                @endif

                                {{-- Overlay Gradiente en Hover --}}
                                <div class="absolute inset-0 bg-primary/10 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                                
                                {{-- Badge NUEVO (Color Accento) --}}
                                <div class="absolute top-3 left-3">
                                    <span class="bg-accent text-white text-[10px] font-bold px-3 py-1 rounded-full shadow-md tracking-wider">
                                        NUEVO
                                    </span>
                                </div>

                                {{-- Botón "Ver Más" (Aparece en Hover) --}}
                                <div class="absolute bottom-4 left-0 right-0 flex justify-center opacity-0 group-hover:opacity-100 translate-y-4 group-hover:translate-y-0 transition-all duration-300">
                                    <span class="bg-white text-primary font-medium text-xs px-4 py-2 rounded-full shadow-lg flex items-center gap-2 hover:bg-primary hover:text-white transition-colors">
                                        Ver Detalles <i class="fas fa-arrow-right text-[10px]"></i>
                                    </span>
                                </div>
                            </div>

                            {{-- Product Info --}}
                            <div class="p-4 text-center">
                                @if($product->brand)
                                    <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1">
                                        {{ $product->brand->name }}
                                    </p>
                                @endif
                                <h3 class="text-sm font-semibold text-dark group-hover:text-primary transition-colors mb-2 line-clamp-1">
                                    {{ $product->name }}
                                </h3>
                                <div class="flex items-center justify-center gap-2">
                                    @if($product->sale_price)
                                        <span class="text-accent font-bold text-lg">S/ {{ number_format($product->sale_price, 0) }}</span>
                                        <span class="text-xs text-gray-400 line-through">S/ {{ number_format($product->price, 0) }}</span>
                                    @else
                                        <span class="text-dark font-bold text-lg">S/ {{ number_format($product->price, 0) }}</span>
                                    @endif
                                </div>
                            </div>
                        </a>
                    @empty
                        <div class="col-span-full flex flex-col items-center justify-center py-16 text-center">
                            <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mb-4">
                                <i class="fas fa-box-open text-gray-400 text-2xl"></i>
                            </div>
                            <p class="text-dark/60 font-medium">No hay productos nuevos disponibles por el momento.</p>
                        </div>
                    @endforelse
                </div>
            </div>

            {{-- Featured Products Section --}}
            <div id="featured-products" class="product-section hidden">
                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4 lg:gap-6">
                    @forelse($featuredProducts->take(10) as $product)
                        <a href="#" class="group relative bg-white rounded-xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                            <div class="aspect-[4/5] overflow-hidden bg-gray-100 relative">
                                @if($product->model_image)
                                    <img src="{{ $product->model_image_url }}" 
                                         alt="{{ $product->name }}"
                                         class="w-full h-full object-cover object-center group-hover:scale-110 transition-transform duration-700" loading="lazy">
                                @elseif($product->featured_image)
                                    <img src="{{ asset('storage/'. $product->featured_image) }}" 
                                         alt="{{ $product->name }}"
                                         class="w-full h-full object-cover object-center group-hover:scale-110 transition-transform duration-700" loading="lazy">
                                @else
                                    <div class="w-full h-full flex items-center justify-center bg-gray-100 text-gray-300"><i class="fas fa-glasses text-4xl"></i></div>
                                @endif
                                
                                <div class="absolute inset-0 bg-primary/10 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                                
                                {{-- Badge DESTACADO (Color Primario) --}}
                                <div class="absolute top-3 left-3">
                                    <span class="bg-primary text-white text-[10px] font-bold px-3 py-1 rounded-full shadow-md tracking-wider">
                                        DESTACADO
                                    </span>
                                </div>

                                <div class="absolute bottom-4 left-0 right-0 flex justify-center opacity-0 group-hover:opacity-100 translate-y-4 group-hover:translate-y-0 transition-all duration-300">
                                    <span class="bg-white text-primary font-medium text-xs px-4 py-2 rounded-full shadow-lg flex items-center gap-2 hover:bg-primary hover:text-white transition-colors">
                                        Ver Detalles <i class="fas fa-arrow-right text-[10px]"></i>
                                    </span>
                                </div>
                            </div>
                            <div class="p-4 text-center">
                                @if($product->brand)
                                    <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1">{{ $product->brand->name }}</p>
                                @endif
                                <h3 class="text-sm font-semibold text-dark group-hover:text-primary transition-colors mb-2 line-clamp-1">{{ $product->name }}</h3>
                                <div class="flex items-center justify-center gap-2">
                                    @if($product->sale_price)
                                        <span class="text-accent font-bold text-lg">S/ {{ number_format($product->sale_price, 0) }}</span>
                                        <span class="text-xs text-gray-400 line-through">S/ {{ number_format($product->price, 0) }}</span>
                                    @else
                                        <span class="text-dark font-bold text-lg">S/ {{ number_format($product->price, 0) }}</span>
                                    @endif
                                </div>
                            </div>
                        </a>
                    @empty
                        <div class="col-span-full flex flex-col items-center justify-center py-16 text-center">
                            <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mb-4">
                                <i class="fas fa-star text-gray-400 text-2xl"></i>
                            </div>
                            <p class="text-dark/60 font-medium">No hay productos destacados disponibles.</p>
                        </div>
                    @endforelse
                </div>
            </div>

            {{-- Sale Products Section --}}
            <div id="sale-products" class="product-section hidden">
                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4 lg:gap-6">
                    @forelse($saleProducts as $product)
                        <a href="#" class="group relative bg-white rounded-xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                            <div class="aspect-[4/5] overflow-hidden bg-gray-100 relative">
                                @if($product->model_image)
                                    <img src="{{ $product->model_image_url }}" 
                                         alt="{{ $product->name }}"
                                         class="w-full h-full object-cover object-center group-hover:scale-110 transition-transform duration-700" loading="lazy">
                                @elseif($product->featured_image)
                                    <img src="{{ asset('storage/'. $product->featured_image) }}" 
                                         alt="{{ $product->name }}"
                                         class="w-full h-full object-cover object-center group-hover:scale-110 transition-transform duration-700" loading="lazy">
                                @else
                                    <div class="w-full h-full flex items-center justify-center bg-gray-100 text-gray-300"><i class="fas fa-glasses text-4xl"></i></div>
                                @endif
                                
                                <div class="absolute inset-0 bg-primary/10 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                                
                                {{-- Badge OFERTA (Color Accento) --}}
                                <div class="absolute top-3 left-3">
                                    @if($product->discount_percentage > 0)
                                        <span class="bg-accent text-white text-[10px] font-bold px-3 py-1 rounded-full shadow-md tracking-wider">
                                            -{{ $product->discount_percentage }}%
                                        </span>
                                    @else
                                        <span class="bg-accent text-white text-[10px] font-bold px-3 py-1 rounded-full shadow-md tracking-wider">
                                            OFERTA
                                        </span>
                                    @endif
                                </div>

                                <div class="absolute bottom-4 left-0 right-0 flex justify-center opacity-0 group-hover:opacity-100 translate-y-4 group-hover:translate-y-0 transition-all duration-300">
                                    <span class="bg-white text-primary font-medium text-xs px-4 py-2 rounded-full shadow-lg flex items-center gap-2 hover:bg-primary hover:text-white transition-colors">
                                        Ver Detalles <i class="fas fa-arrow-right text-[10px]"></i>
                                    </span>
                                </div>
                            </div>
                            <div class="p-4 text-center">
                                @if($product->brand)
                                    <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1">{{ $product->brand->name }}</p>
                                @endif
                                <h3 class="text-sm font-semibold text-dark group-hover:text-primary transition-colors mb-2 line-clamp-1">{{ $product->name }}</h3>
                                <div class="flex items-center justify-center gap-2">
                                    <span class="text-accent font-bold text-lg">S/ {{ number_format($product->sale_price ?? $product->price, 0) }}</span>
                                    @if($product->sale_price)
                                        <span class="text-xs text-gray-400 line-through">S/ {{ number_format($product->price, 0) }}</span>
                                    @endif
                                </div>
                            </div>
                        </a>
                    @empty
                        <div class="col-span-full flex flex-col items-center justify-center py-16 text-center">
                            <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mb-4">
                                <i class="fas fa-percent text-gray-400 text-2xl"></i>
                            </div>
                            <p class="text-dark/60 font-medium">No hay ofertas disponibles por el momento.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

        {{-- View All CTA --}}
        <div class="text-center mt-12">
            {{-- CAMBIO: Botón "Ver Todo" con estilos primarios --}}
            <a href="#" 
               class="inline-flex items-center gap-3 bg-primary hover:bg-primary-dark text-white font-semibold px-8 py-4 rounded-full transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl">
                <span>VER CATÁLOGO COMPLETO</span>
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                </svg>
            </a>
        </div>
    </div>
</section>

{{-- Styles for Filter System --}}
<style>
/* Filter Pills - Rediseñado para Tailwind */
.filter-btn {
    @apply px-6 py-3 text-xs font-bold uppercase tracking-wider rounded-full transition-all duration-300 border-2 overflow-hidden relative;
    @apply bg-white text-gray-500 border-gray-200;
}

.filter-btn:hover {
    @apply border-primary text-primary;
}

.filter-btn.active {
    @apply bg-primary text-white border-primary shadow-lg;
    transform: translateY(-2px);
}

/* Product Sections Animation */
.product-section {
    @apply absolute inset-0 w-full;
    transition: opacity 0.4s cubic-bezier(0.4, 0, 0.2, 1), transform 0.4s cubic-bezier(0.4, 0, 0.2, 1);
}

.product-section.hidden {
    @apply opacity-0 pointer-events-none;
    transform: translateY(20px);
}

.product-section.active {
    @apply opacity-100 relative; /* Relative para que ocupe espacio */
    transform: translateY(0);
}
</style>

{{-- Filter JavaScript (Sin cambios de lógica, solo funciona igual) --}}
<script>
function filterProducts(filter) {
    const sections = document.querySelectorAll('.product-section');
    const buttons = document.querySelectorAll('.filter-btn');
    
    // Ocultar todos
    sections.forEach(section => {
        section.classList.remove('active');
        section.classList.add('hidden');
    });
    
    // Desactivar botones
    buttons.forEach(btn => {
        btn.classList.remove('active');
    });
    
    // Mostrar seleccionado con pequeño delay
    setTimeout(() => {
        const targetSection = document.getElementById(filter + '-products');
        if (targetSection) {
            targetSection.classList.remove('hidden');
            // Forzar reflow para animación
            void targetSection.offsetWidth; 
            targetSection.classList.add('active');
        }
        
        const activeBtn = document.querySelector(`[data-filter="${filter}"]`);
        if (activeBtn) {
            activeBtn.classList.add('active');
        }
    }, 50);
}

document.addEventListener('DOMContentLoaded', () => {
    // Filtro inicial
    const initialFilter = document.querySelector('.filter-btn.active') ? document.querySelector('.filter-btn.active').dataset.filter : 'new';
    // Asegurarse que la sección correcta esté visible inicialmente sin animación
    const initialSection = document.getElementById(initialFilter + '-products');
    if(initialSection) {
        initialSection.classList.remove('hidden');
        initialSection.classList.add('active');
    }
});
</script>