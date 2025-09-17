{{-- 
    Sección de Catálogo por Género - Estilo Editorial Minimalista
    Este componente presenta las colecciones en un formato de pantalla dividida,
    inspirado en campañas de moda de alta costura. El diseño es limpio,
    directo y se enfoca completamente en la imagen.
--}}
<section id="gender-catalog" class="w-full h-auto lg:h-screen bg-black">
    {{-- 
        Grid sin espacios que se adapta a 3 columnas en escritorio 
        y a filas apiladas en móvil.
    --}}
    <div class="grid grid-cols-1 lg:grid-cols-3">

        {{-- Tarjeta de Hombres --}}
        @if(isset($menCoverProduct))
            <a href="{{-- route('catalog.men') --}}" 
               class="group relative overflow-hidden h-[60vh] lg:h-screen block">
                
                {{-- Imagen de Fondo con Efecto de Zoom Sutil --}}
                <div class="absolute inset-0 bg-cover bg-center transition-transform duration-700 ease-in-out group-hover:scale-105"
                     style="background-image: url('{{ $menCoverProduct->model_image_url ?? asset('storage/' . $menCoverProduct->featured_image) }}')">
                </div>
                
                {{-- Contenido de la Tarjeta con fondo sólido para el texto --}}
                <div class="relative h-full flex flex-col justify-end items-start p-8 text-white">
                    <div class="bg-black/70 backdrop-blur-sm px-5 py-3">
                        <h3 class="font-light uppercase tracking-[0.2em] text-sm">
                            Hombres
                        </h3>
                    </div>
                </div>
            </a>
        @endif

        {{-- Tarjeta de Mujeres --}}
        @if(isset($womenCoverProduct))
            <a href="{{-- route('catalog.women') --}}" 
               class="group relative overflow-hidden h-[60vh] lg:h-screen block">
                
                <div class="absolute inset-0 bg-cover bg-center transition-transform duration-700 ease-in-out group-hover:scale-105"
                     style="background-image: url('{{ $womenCoverProduct->model_image_url ?? asset('storage/' . $womenCoverProduct->featured_image) }}')">
                </div>
                
                <div class="relative h-full flex flex-col justify-end items-start p-8 text-white">
                     <div class="bg-black/70 backdrop-blur-sm px-5 py-3">
                        <h3 class="font-light uppercase tracking-[0.2em] text-sm">
                            Mujeres
                        </h3>
                    </div>
                </div>
            </a>
        @endif

        {{-- Tarjeta de Niños --}}
        @if(isset($kidCoverProduct))
            <a href="{{-- route('catalog.kids') --}}" 
               class="group relative overflow-hidden h-[60vh] lg:h-screen block">
                
                <div class="absolute inset-0 bg-cover bg-center transition-transform duration-700 ease-in-out group-hover:scale-105"
                     style="background-image: url('{{ $kidCoverProduct->model_image_url ?? asset('storage/' . $kidCoverProduct->featured_image) }}')">
                </div>
                
                <div class="relative h-full flex flex-col justify-end items-start p-8 text-white">
                    <div class="bg-black/70 backdrop-blur-sm px-5 py-3">
                        <h3 class="font-light uppercase tracking-[0.2em] text-sm">
                            Niños
                        </h3>
                    </div>
                </div>
            </a>
        @endif

    </div>
</section>