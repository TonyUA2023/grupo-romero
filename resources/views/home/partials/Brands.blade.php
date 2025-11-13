{{-- ============================================
   SECCIÓN DE MARCAS – PREMIUM BLACK EDITION
   ============================================ --}}
<div class="bg-black py-20 relative overflow-hidden">

    {{-- Glow sutil detrás del título --}}
    <div class="absolute inset-0 pointer-events-none opacity-20 blur-3xl"
         style="background: radial-gradient(circle at center, #ffffff20 0%, transparent 70%);">
    </div>

    <div class="container mx-auto px-4 relative z-10">

        {{-- Título elegante y minimal --}}
        <h2 class="text-center text-[#e5e5e5]/60 font-light uppercase tracking-[0.35em] text-xs mb-14">
            Marcas que confían en nosotros
        </h2>

        {{-- Contenedor principal del carrusel --}}
        <div class="relative h-24 overflow-hidden group">

            {{-- Gradiente izquierda --}}
            <div class="absolute top-0 left-0 w-32 h-full 
                        bg-gradient-to-r from-black via-black/80 to-transparent z-10"></div>

            {{-- Gradiente derecha --}}
            <div class="absolute top-0 right-0 w-32 h-full 
                        bg-gradient-to-l from-black via-black/80 to-transparent z-10"></div>

            {{-- Track del carrusel --}}
            <div id="brands-carousel-tall" class="absolute top-0 left-0 flex h-full items-center">

                @php
                    $doubledBrands = $brands->concat($brands);
                @endphp

                @foreach($doubledBrands as $brand)
                    <div class="flex-shrink-0 h-full flex justify-center items-center mx-8">

                        {{-- Logo con efecto glow al hover --}}
                        <img src="{{ asset('storage/' . $brand->logo) }}"
                             alt="Logo de {{ $brand->name }}"
                             class="h-full w-auto object-contain
                                    transition-all duration-500 ease-out
                                    group-hover:scale-[1.12]
                                    hover:brightness-125 hover:drop-shadow-[0_0_10px_#fff3]"
                             loading="lazy">
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

{{-- Animación y estilos adicionales --}}
<style>
@keyframes scroll-left-tall {
    0% { transform: translateX(0); }
    100% { transform: translateX(-50%); }
}

#brands-carousel-tall {
    animation: scroll-left-tall 45s linear infinite;
    will-change: transform;
}

.group:hover #brands-carousel-tall {
    animation-play-state: paused;
}
</style>
