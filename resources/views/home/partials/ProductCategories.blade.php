{{-- Categories Section - Bento Box Grid Style --}}
@if($productCategories->isNotEmpty())
<section class="py-4 lg:py-6 bg-gradient-to-br from-gray-900 via-black to-gray-900">
    {{-- Full Width Layout --}}
    <div class="px-2 sm:px-3 lg:px-4">
        
        {{-- Compact Header --}}
        <div class="mb-4 text-center">
            <p class="text-[10px] uppercase tracking-widest text-gray-500">DESCUBRE</p>
            <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold text-white">
                NUESTRAS <span class="font-light italic text-transparent bg-clip-text bg-gradient-to-r from-red-500 to-orange-500">COLECCIONES</span>
            </h2>
            <p class="text-sm text-gray-400 mt-1">Encuentra el estilo perfecto para cada ocasión</p>
        </div>

        {{-- Bento Box Grid Layout --}}
        <div class="grid grid-cols-4 md:grid-cols-6 gap-1 md:gap-2 auto-rows-[120px] md:auto-rows-[150px] lg:auto-rows-[180px]">
            
            @foreach($productCategories->take(5) as $index => $category)
                @php
                    // Diseño asimétrico tipo Bento Box
                    $gridClasses = '';
                    $contentPosition = '';
                    $textSize = '';
                    
                    switch($index) {
                        case 0:
                            // Gran tarjeta principal
                            $gridClasses = 'col-span-4 md:col-span-3 row-span-3 md:row-span-3';
                            $contentPosition = 'items-end';
                            $textSize = 'text-2xl md:text-3xl lg:text-4xl';
                            break;
                        case 1:
                            // Tarjeta vertical derecha
                            $gridClasses = 'col-span-2 md:col-span-3 row-span-2';
                            $contentPosition = 'items-center';
                            $textSize = 'text-lg md:text-xl lg:text-2xl';
                            break;
                        case 2:
                            // Tarjeta cuadrada pequeña
                            $gridClasses = 'col-span-2 row-span-2';
                            $contentPosition = 'items-end';
                            $textSize = 'text-base md:text-lg';
                            break;
                        case 3:
                            // Tarjeta horizontal ancha
                            $gridClasses = 'col-span-2 md:col-span-4 row-span-1';
                            $contentPosition = 'items-center';
                            $textSize = 'text-base md:text-lg';
                            break;
                        case 4:
                            // Tarjeta mediana
                            $gridClasses = 'col-span-2 row-span-2';
                            $contentPosition = 'items-end';
                            $textSize = 'text-base md:text-lg';
                            break;
                        default:
                            $gridClasses = 'col-span-2 row-span-2';
                            $contentPosition = 'items-end';
                            $textSize = 'text-base';
                    }
                @endphp

                <a href="#" 
                   class="group relative overflow-hidden block {{ $gridClasses }} rounded-sm md:rounded-lg">
                    
                    {{-- Background Image --}}
                    @if($category->image)
                        <img src="{{ asset('storage/' . $category->image) }}" 
                             alt="{{ $category->name }}"
                             class="absolute inset-0 w-full h-full object-cover transition-all duration-700 group-hover:scale-110 group-hover:rotate-1"
                             loading="lazy">
                    @else
                        <div class="absolute inset-0 bg-gradient-to-br from-gray-800 to-gray-900"></div>
                    @endif
                    
                    {{-- Dynamic Gradient Overlay --}}
                    <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/40 to-transparent opacity-80 group-hover:opacity-90 transition-opacity duration-500"></div>
                    
                    {{-- Hover Effect Color Overlay --}}
                    <div class="absolute inset-0 bg-gradient-to-br from-red-600/0 to-orange-600/0 group-hover:from-red-600/20 group-hover:to-orange-600/20 transition-all duration-500"></div>
                    
                    {{-- Content Container --}}
                    <div class="relative h-full flex {{ $contentPosition }} p-3 md:p-4 lg:p-6">
                        <div class="transform transition-all duration-500 group-hover:-translate-y-2">
                            {{-- Category Name --}}
                            <h3 class="{{ $textSize }} font-bold text-white mb-1 drop-shadow-lg">
                                {{ strtoupper($category->name) }}
                            </h3>
                            
                            {{-- Product Count or Description (if index is 0 or 1) --}}
                            @if($index < 2)
                                <p class="text-xs md:text-sm text-gray-300 opacity-0 group-hover:opacity-100 transition-opacity duration-500 max-w-[200px]">
                                    {{ $category->description ?? 'Explora la colección completa' }}
                                </p>
                            @endif
                            
                            {{-- Arrow Icon --}}
                            <div class="inline-flex items-center gap-1 mt-2 opacity-0 group-hover:opacity-100 transition-all duration-500 transform translate-x-[-10px] group-hover:translate-x-0">
                                <span class="text-[10px] uppercase tracking-wider text-white">Ver más</span>
                                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                    
                    {{-- Corner Badge for Main Category --}}
                    @if($index === 0)
                        <div class="absolute top-3 right-3">
                            <div class="bg-red-600 text-white text-[10px] px-3 py-1 font-bold rounded-full animate-pulse">
                                DESTACADO
                            </div>
                        </div>
                    @endif
                    
                    {{-- Product Count Badge --}}
                    @if($category->products_count ?? false)
                        <div class="absolute top-3 left-3 bg-black/60 backdrop-blur-sm text-white text-[10px] px-2 py-1 rounded">
                            {{ $category->products_count }} productos
                        </div>
                    @endif
                </a>
            @endforeach
        </div>

        {{-- Secondary Categories Strip (if more than 5 categories) --}}
        @if($productCategories->count() > 5)
            <div class="mt-4 grid grid-cols-3 md:grid-cols-6 gap-1">
                @foreach($productCategories->skip(5)->take(6) as $category)
                    <a href="#" 
                       class="group relative h-20 md:h-24 overflow-hidden rounded bg-gray-900 flex items-center justify-center">
                        
                        @if($category->image)
                            <img src="{{ asset('storage/' . $category->image) }}" 
                                 alt="{{ $category->name }}"
                                 class="absolute inset-0 w-full h-full object-cover opacity-30 group-hover:opacity-50 transition-opacity duration-300"
                                 loading="lazy">
                        @endif
                        
                        <div class="absolute inset-0 bg-black/50 group-hover:bg-black/30 transition-colors duration-300"></div>
                        
                        <h4 class="relative text-white text-xs md:text-sm font-medium text-center px-2 group-hover:scale-110 transition-transform duration-300">
                            {{ $category->name }}
                        </h4>
                    </a>
                @endforeach
            </div>
        @endif

        {{-- CTA Button --}}
        <div class="mt-6 text-center">
            <a href="#" 
               class="inline-flex items-center gap-2 text-sm font-medium text-white hover:text-orange-500 transition-colors duration-300 group">
                <span class="border-b border-white group-hover:border-orange-500">VER TODAS LAS CATEGORÍAS</span>
                <svg class="w-4 h-4 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                </svg>
            </a>
        </div>
    </div>
</section>
@endif