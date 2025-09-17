{{-- 
    Sección de Marcas - Estilo Carrusel de Logos Verticales
    Este componente combina la idea de un muro de logos con un carrusel infinito,
    presentando las imágenes en su altura completa para un mayor impacto visual.
--}}
<div class="bg-black py-16 lg:py-16">
    <div class="container mx-auto px-4">

        {{-- Título Sutil --}}
        <h2 class="text-center text-gray-400 font-light uppercase tracking-[0.3em] text-xs mb-12">
            Una selección de nuestras marcas de confianza
        </h2>

        {{-- 
            Contenedor del Carrusel
            - Se define una altura fija (h-24) que servirá como base para las imágenes.
            - 'overflow-hidden' es crucial para que el carrusel funcione.
        --}}
        <div class="relative h-24 overflow-hidden group">
            {{-- Máscara con gradiente en los bordes para un efecto de desvanecimiento --}}
            <div class="absolute top-0 left-0 w-24 h-full bg-gradient-to-r from-black to-transparent z-10"></div>
            <div class="absolute top-0 right-0 w-24 h-full bg-gradient-to-l from-black to-transparent z-10"></div>

            {{-- Pista del Carrusel con Animación --}}
            <div id="brands-carousel-tall" class="absolute top-0 left-0 flex h-full items-center">
                @php
                    // Duplicamos el array de marcas para el loop infinito.
                    $doubledBrands = $brands->concat($brands);
                @endphp

                @foreach($doubledBrands as $brand)
                    <div class="flex-shrink-0 h-full flex justify-center items-center mx-5">
                        {{-- 
                            Logo de la marca.
                            - 'h-full' hace que la imagen ocupe toda la altura del contenedor (h-24).
                            - 'w-auto' ajusta el ancho para mantener la proporción y evitar distorsión.
                        --}}
                        <img src="{{ asset('storage/' . $brand->logo) }}" 
                             alt="Logo de {{ $brand->name }}" 
                             class="h-full w-auto object-contain transition-transform duration-300 ease-in-out transform group-hover:scale-110" 
                             loading="lazy">
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

{{-- Estilos y Animación del Carrusel --}}
<style>
/* Define la animación de desplazamiento horizontal. */
@keyframes scroll-left-tall {
    0% {
        transform: translateX(0);
    }
    100% {
        transform: translateX(-50%);
    }
}

/* Aplica la animación al contenedor de los logos. */
#brands-carousel-tall {
    animation: scroll-left-tall 50s linear infinite;
    will-change: transform;
}

/* Pausa la animación al pasar el cursor sobre el carrusel. */
.group:hover #brands-carousel-tall {
    animation-play-state: paused;
}
</style>
