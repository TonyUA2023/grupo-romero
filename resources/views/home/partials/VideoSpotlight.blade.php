{{-- Video Spotlight Section - Ultra Compact Magazine Style --}}
<section class="w-full py-4 lg:py-6 bg-black">
    {{-- Full Width Layout --}}
    <div class="px-2 sm:px-3 lg:px-4">
        
        {{-- Compact Header --}}
        <div class="text-center mb-4">
            <p class="text-[10px] uppercase tracking-widest text-gray-500">EXPERIENCIA VISUAL</p>
            <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold text-white">
                DISEÑO EN <span class="font-light italic text-red-500">MOVIMIENTO</span>
            </h2>
            <p class="text-sm text-gray-400 mt-1">Descubre cada detalle en alta definición</p>
        </div>

        {{-- Video Grid - Medium Cards --}}
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-1 md:gap-2">
            
            @php
                $productsToShow = $videoSpotlightProducts->isNotEmpty() ? $videoSpotlightProducts : $featuredProducts->take(10);
            @endphp

            @forelse($productsToShow as $index => $product)
                <div class="group relative aspect-[9/16] bg-black overflow-hidden rounded">
                    {{-- Video Element --}}
                    <video 
                        class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" 
                        muted 
                        loop 
                        playsinline
                        preload="metadata"
                        data-product-id="{{ $product->id }}">
                        <source src="{{ $product->video ? asset('storage/' . $product->video) : 'https://placehold.co/900x1600/000000/333333.mp4?text=Video' }}" type="video/mp4">
                    </video>

                    {{-- Dark Gradient Overlay --}}
                    <div class="absolute inset-0 bg-gradient-to-t from-black via-black/20 to-transparent"></div>

                    {{-- Hover Play Icon --}}
                    <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300 pointer-events-none">
                        <div class="bg-white/20 backdrop-blur-sm rounded-full p-3">
                            <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M6.3 2.841A1.5 1.5 0 004 4.11V15.89a1.5 1.5 0 002.3 1.269l9.344-5.89a1.5 1.5 0 000-2.538L6.3 2.84z"/>
                            </svg>
                        </div>
                    </div>

                    {{-- Sound Toggle --}}
                    <button class="absolute top-2 right-2 mute-toggle bg-black/60 backdrop-blur-sm p-1.5 rounded-full opacity-0 group-hover:opacity-100 transition-all duration-300 z-10" 
                            data-video-id="{{ $product->id }}">
                        <svg class="w-3 h-3 text-white mute-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.586 15H4a1 1 0 01-1-1v-4a1 1 0 011-1h1.586l4.707-4.707C10.923 3.663 12 4.109 12 5v14c0 .891-1.077 1.337-1.707.707L5.586 15z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 14l4-4m0 4l-4-4"/>
                        </svg>
                        <svg class="w-3 h-3 text-white unmute-icon hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.536 8.464a5 5 0 010 7.072m2.828-9.9a9 9 0 010 12.728M5.586 15H4a1 1 0 01-1-1v-4a1 1 0 011-1h1.586l4.707-4.707C10.923 3.663 12 4.109 12 5v14c0 .891-1.077 1.337-1.707.707L5.586 15z"/>
                        </svg>
                    </button>

                    {{-- Product Info Overlay --}}
                    <div class="absolute bottom-0 left-0 right-0 p-3">
                        <div class="text-white">
                            @if($product->brand)
                                <p class="text-[10px] uppercase tracking-wider text-red-400">
                                    {{ $product->brand->name }}
                                </p>
                            @endif
                            <h3 class="text-xs font-light line-clamp-1 mb-1">
                                {{ $product->name }}
                            </h3>
                            <div class="flex items-center justify-between">
                                <p class="text-sm lg:text-base font-semibold">
                                    @if($product->sale_price)
                                        <span class="text-red-500">S/ {{ number_format($product->sale_price, 0) }}</span>
                                        <span class="text-[10px] line-through text-gray-400 ml-1">{{ number_format($product->price, 0) }}</span>
                                    @else
                                        S/ {{ number_format($product->price, 0) }}
                                    @endif
                                </p>
                                <button onclick="openProductModal({{ $product->id }})" 
                                        class="bg-white text-black px-3 py-1.5 text-[10px] font-bold uppercase hover:bg-gray-200 transition-all duration-300 rounded">
                                    VER MÁS
                                </button>
                            </div>
                        </div>
                    </div>

                    {{-- Badge --}}
                    @if($product->is_new)
                        <div class="absolute top-2 left-2">
                            <div class="bg-red-600 text-white text-[9px] px-2 py-1 font-bold rounded">
                                HOT
                            </div>
                        </div>
                    @elseif($product->discount_percentage > 0)
                        <div class="absolute top-2 left-2">
                            <div class="bg-green-500 text-white text-[9px] px-2 py-1 font-bold rounded">
                                -{{ $product->discount_percentage }}%
                            </div>
                        </div>
                    @endif
                </div>
            @empty
                <div class="col-span-full text-center py-16">
                    <p class="text-gray-500 text-lg">No hay videos disponibles</p>
                </div>
            @endforelse
        </div>
    </div>
</section>

{{-- Minimal Product Modal --}}
<div id="productModal" class="fixed inset-0 bg-black/95 backdrop-blur z-[999] hidden opacity-0 transition-all duration-300">
    <div class="flex items-center justify-center min-h-screen p-3">
        <div class="relative bg-black text-white max-w-5xl w-full max-h-[95vh] grid grid-cols-1 lg:grid-cols-2 gap-[2px] transform transition-transform duration-300 scale-95" id="modalContent">
            
            {{-- Close Button --}}
            <button onclick="closeProductModal()" 
                    class="absolute top-2 right-2 text-white/60 hover:text-white transition z-20 bg-black/50 backdrop-blur-sm rounded-full p-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>

            {{-- Image Gallery --}}
            <div class="bg-gray-900 p-3 max-h-[95vh] overflow-y-auto">
                <div class="aspect-square w-full bg-black">
                    <img id="modalMainImage" src="" alt="" class="w-full h-full object-cover">
                </div>
                <div id="modalThumbnailContainer" class="grid grid-cols-6 gap-[2px] mt-2">
                    {{-- Thumbnails load here --}}
                </div>
            </div>

            {{-- Product Info --}}
            <div class="bg-black p-6 flex flex-col max-h-[95vh] overflow-y-auto">
                <div>
                    <p id="modalBrandName" class="text-[10px] uppercase tracking-widest text-gray-500">MARCA</p>
                    <h2 id="modalProductName" class="text-2xl font-light mt-1">Producto</h2>
                    <p id="modalDescription" class="text-gray-400 mt-3 text-xs leading-relaxed"></p>
                </div>

                <div class="my-4 border-t border-white/10"></div>

                {{-- Specs Grid --}}
                <div class="grid grid-cols-3 gap-3 text-xs">
                    <div>
                        <span class="text-[10px] text-gray-500">GÉNERO</span>
                        <p id="modalGender" class="font-medium mt-0.5">-</p>
                    </div>
                    <div>
                        <span class="text-[10px] text-gray-500">MATERIAL</span>
                        <p id="modalFrameMaterial" class="font-medium mt-0.5">-</p>
                    </div>
                    <div>
                        <span class="text-[10px] text-gray-500">COLOR</span>
                        <p id="modalFrameColor" class="font-medium mt-0.5">-</p>
                    </div>
                </div>

                <div class="mt-auto pt-6">
                    <div class="flex items-end justify-between mb-3">
                        <div>
                            <span id="modalPrice" class="text-3xl font-light">S/0</span>
                            <span id="modalOriginalPrice" class="text-sm text-gray-500 line-through ml-2 hidden">S/0</span>
                        </div>
                        <div id="modalOfferBadge" class="bg-red-600 text-white px-2 py-1 text-[10px] font-bold hidden">
                            -<span id="modalDiscountPercentage"></span>%
                        </div>
                    </div>
                    <button class="w-full bg-white text-black py-2.5 text-sm font-medium hover:bg-gray-200 transition">
                        SOLICITAR INFORMACIÓN
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
/* Ultra compact modal styles */
#productModal.show { opacity: 1; }
#productModal.show #modalContent { transform: scale(1); }
body.modal-open { overflow: hidden; }
.thumbnail-active { outline: 1px solid #fff; outline-offset: 1px; }

/* Hide scrollbars but keep functionality */
.overflow-y-auto::-webkit-scrollbar { width: 2px; }
.overflow-y-auto::-webkit-scrollbar-track { background: transparent; }
.overflow-y-auto::-webkit-scrollbar-thumb { background: #333; }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Products data
    const productsData = {
        @foreach($productsToShow as $product)
            @php
                $allImages = collect();
                if ($product->featured_image) $allImages->push(asset('storage/' . $product->featured_image));
                if ($product->model_image) $allImages->push(asset('storage/' . $product->model_image));
                if ($product->images) {
                    foreach ($product->images as $img) {
                        $allImages->push(asset('storage/' . $img->image_path));
                    }
                }
            @endphp
            {{ $product->id }}: {
                id: {{ $product->id }},
                name: "{{ addslashes($product->name) }}",
                brand: "{{ addslashes($product->brand->name ?? 'Premium') }}",
                price: {{ $product->final_price }},
                originalPrice: {{ $product->price }},
                isOnSale: {{ $product->is_on_sale ? 'true' : 'false' }},
                discountPercentage: {{ $product->discount_percentage ?? 0 }},
                description: "{{ addslashes($product->description ?? 'Diseño exclusivo de alta calidad.') }}",
                gender: "{{ ucfirst($product->gender ?? 'Unisex') }}",
                frameMaterial: "{{ addslashes($product->frame_material ?? 'Premium') }}",
                frameColor: "{{ addslashes($product->frame_color ?? 'Classic') }}",
                images: @json($allImages->unique()->values())
            },
        @endforeach
    };

    // Auto-play videos on hover
    const videos = document.querySelectorAll('video');
    videos.forEach(video => {
        const parent = video.closest('.group');
        if (parent) {
            parent.addEventListener('mouseenter', () => {
                video.play().catch(() => {});
            });
            parent.addEventListener('mouseleave', () => {
                video.pause();
                video.currentTime = 0;
            });
        }
    });

    // Mute toggle
    document.querySelectorAll('.mute-toggle').forEach(button => {
        button.addEventListener('click', (e) => {
            e.stopPropagation();
            const videoId = button.dataset.videoId;
            const video = document.querySelector(`video[data-product-id="${videoId}"]`);
            if (video) {
                video.muted = !video.muted;
                button.querySelector('.mute-icon').classList.toggle('hidden', !video.muted);
                button.querySelector('.unmute-icon').classList.toggle('hidden', video.muted);
            }
        });
    });

    // Modal functions
    window.openProductModal = function(productId) {
        const product = productsData[productId];
        if (!product) return;

        const modal = document.getElementById('productModal');
        const mainImage = document.getElementById('modalMainImage');
        const thumbContainer = document.getElementById('modalThumbnailContainer');

        // Set product info
        document.getElementById('modalProductName').textContent = product.name;
        document.getElementById('modalBrandName').textContent = product.brand;
        document.getElementById('modalDescription').textContent = product.description;
        document.getElementById('modalGender').textContent = product.gender;
        document.getElementById('modalFrameMaterial').textContent = product.frameMaterial;
        document.getElementById('modalFrameColor').textContent = product.frameColor;
        document.getElementById('modalPrice').textContent = `S/${product.price}`;

        // Handle sale price
        const originalPrice = document.getElementById('modalOriginalPrice');
        const offerBadge = document.getElementById('modalOfferBadge');
        if (product.isOnSale) {
            originalPrice.textContent = `S/${product.originalPrice}`;
            originalPrice.classList.remove('hidden');
            document.getElementById('modalDiscountPercentage').textContent = product.discountPercentage;
            offerBadge.classList.remove('hidden');
        } else {
            originalPrice.classList.add('hidden');
            offerBadge.classList.add('hidden');
        }

        // Load images
        thumbContainer.innerHTML = '';
        if (product.images && product.images.length > 0) {
            mainImage.src = product.images[0];
            product.images.forEach((img, i) => {
                const thumb = document.createElement('img');
                thumb.src = img;
                thumb.className = 'w-full aspect-square object-cover cursor-pointer hover:opacity-80 transition';
                if (i === 0) thumb.classList.add('thumbnail-active');
                thumb.onclick = () => {
                    mainImage.src = img;
                    thumbContainer.querySelectorAll('img').forEach(t => t.classList.remove('thumbnail-active'));
                    thumb.classList.add('thumbnail-active');
                };
                thumbContainer.appendChild(thumb);
            });
        }

        // Show modal
        modal.classList.remove('hidden');
        document.body.classList.add('modal-open');
        requestAnimationFrame(() => modal.classList.add('show'));
    };

    window.closeProductModal = function() {
        const modal = document.getElementById('productModal');
        modal.classList.remove('show');
        setTimeout(() => {
            modal.classList.add('hidden');
            document.body.classList.remove('modal-open');
        }, 300);
    };

    // Close on backdrop click
    document.getElementById('productModal').addEventListener('click', (e) => {
        if (e.target.id === 'productModal') closeProductModal();
    });

    // Close on ESC
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') closeProductModal();
    });
});
</script>