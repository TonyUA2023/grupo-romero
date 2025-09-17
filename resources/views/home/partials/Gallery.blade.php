{{-- ===== GALERÍA CREATIVA Y ELEGANTE - ESTILO ÓPTICA PREMIUM ===== --}}
<section class="py-20 lg:py-28 bg-gradient-to-br from-white via-gray-50 to-red-50/30 relative overflow-hidden">
    
    {{-- Elementos decorativos dinámicos --}}
    <div class="absolute top-0 right-0 w-96 h-96 bg-gradient-to-br from-red-200/20 to-blue-200/20 rounded-full blur-3xl animate-pulse-slow"></div>
    <div class="absolute bottom-0 left-0 w-80 h-80 bg-gradient-to-tl from-blue-200/20 to-red-200/20 rounded-full blur-2xl animate-float"></div>
    <div class="absolute top-1/3 left-1/2 w-32 h-32 bg-red-100/30 rounded-full blur-xl transform -translate-x-1/2"></div>
    
    {{-- Patrón de formas geométricas --}}
    <div class="absolute inset-0 opacity-5">
        <div class="absolute top-20 right-32 w-4 h-4 bg-red-600 rounded-full"></div>
        <div class="absolute top-40 right-64 w-2 h-2 bg-blue-600 rounded-full"></div>
        <div class="absolute bottom-32 left-32 w-6 h-6 bg-red-600 rounded-full"></div>
        <div class="absolute bottom-56 left-64 w-3 h-3 bg-blue-600 rounded-full"></div>
    </div>
    
    <div class="w-full mx-auto px-3 sm:px-4 lg:px-6 relative z-10">
        
        {{-- Encabezado espectacular --}}
        <div class="text-center mb-20 gallery-header-animate">
            {{-- Badge superior creativo --}}
            <div class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-red-600 to-blue-600 rounded-full mb-8 shadow-lg relative overflow-hidden">
                <div class="absolute inset-0 bg-white/10 rounded-full animate-pulse-gentle"></div>
                <svg class="w-5 h-5 text-white mr-3 relative z-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
                <span class="text-white font-bold uppercase tracking-wider text-sm relative z-10">Galería Visual</span>
            </div>
            
            {{-- Título principal creativo --}}
            <h2 class="text-5xl md:text-6xl lg:text-7xl font-bold mb-6 leading-tight">
                <span class="bg-gradient-to-r from-red-600 via-blue-600 to-red-600 bg-clip-text text-transparent bg-[length:200%_auto] animate-gradient-x">
                    Momentos
                </span>
                <br>
                <span class="text-gray-900 relative">
                    Memorables
                    <div class="absolute -bottom-3 left-0 right-0 h-1 bg-gradient-to-r from-red-600 to-blue-600 rounded-full transform scale-x-0 animate-scale-x"></div>
                </span>
            </h2>
            
            <p class="text-xl lg:text-2xl text-gray-600 max-w-5xl mx-auto leading-relaxed mb-8">
                Descubre la belleza de nuestra óptica a través de imágenes que capturan la esencia de la elegancia y la innovación en salud visual
            </p>
        </div>

        {{-- Grid de galería dinámico - Ocupa más espacio en pantalla --}}
        <div class="gallery-grid-container mb-16 w-full">
            <div class="grid grid-cols-12 gap-3 lg:gap-5 auto-rows-[180px] lg:auto-rows-[220px] xl:auto-rows-[250px]">
                @foreach($galleryItems as $index => $item)
                    @php
                        // Definir diferentes tamaños para crear un layout más dinámico
                        $layouts = [
                            'col-span-6 row-span-3', // Grande principal
                            'col-span-3 row-span-2', // Mediano alto
                            'col-span-3 row-span-2', // Mediano alto
                            'col-span-4 row-span-2', // Mediano ancho
                            'col-span-4 row-span-2', // Mediano ancho
                            'col-span-4 row-span-2', // Mediano ancho
                            'col-span-6 row-span-2', // Ancho
                            'col-span-3 row-span-2', // Mediano
                            'col-span-3 row-span-2', // Mediano
                        ];
                        $layout = $layouts[$index % count($layouts)];
                        
                        // Colores de borde alternos
                        $borderColors = ['border-red-200', 'border-blue-200', 'border-purple-200', 'border-pink-200'];
                        $borderColor = $borderColors[$index % count($borderColors)];
                        
                        // Gradientes de overlay
                        $overlayGradients = [
                            'from-red-600/80 to-blue-600/80',
                            'from-blue-600/80 to-purple-600/80',
                            'from-purple-600/80 to-red-600/80',
                            'from-red-600/80 to-pink-600/80'
                        ];
                        $overlayGradient = $overlayGradients[$index % count($overlayGradients)];
                        
                        $imageSrc = $item->image ? asset('storage/' . $item->image) : 'https://via.placeholder.com/800x600';
                    @endphp
                    
                    <div class="group gallery-item {{ $layout }} relative overflow-hidden rounded-2xl cursor-pointer transform transition-all duration-500 hover:scale-[1.02] hover:z-10"
                         style="animation-delay: {{ $index * 0.1 }}s;"
                         data-image="{{ $imageSrc }}"
                         data-title="{{ $item->title ?? 'Imagen de galería' }}"
                         data-description="{{ $item->description ?? 'Descubre la belleza y elegancia de nuestras instalaciones.' }}">
                        
                        {{-- Contenedor de imagen con efectos --}}
                        <div class="relative w-full h-full overflow-hidden bg-gray-100 border-2 {{ $borderColor }} group-hover:border-transparent transition-all duration-500">
                            
                            {{-- Imagen principal --}}
                            <img src="{{ $imageSrc }}" 
                                 alt="{{ $item->title ?? 'Imagen de galería' }}" 
                                 class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-700 ease-out"
                                 loading="lazy">
                            
                            {{-- Overlay gradiente creativo --}}
                            <div class="absolute inset-0 bg-gradient-to-br {{ $overlayGradient }} opacity-0 group-hover:opacity-100 transition-all duration-500"></div>
                            
                            {{-- Efectos de luz --}}
                            <div class="absolute inset-0 bg-gradient-to-tr from-white/0 via-white/5 to-white/20 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                            
                            {{-- Número del item (solo para los primeros 6) --}}
                            @if($index < 6)
                                <div class="absolute top-4 left-4 z-20">
                                    <div class="w-10 h-10 bg-white/20 backdrop-blur-sm border border-white/30 rounded-full flex items-center justify-center transform group-hover:scale-110 transition-transform duration-300">
                                        <span class="text-white font-bold text-sm">{{ sprintf('%02d', $index + 1) }}</span>
                                    </div>
                                </div>
                            @endif
                            
                            {{-- Icono de zoom creativo --}}
                            <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-all duration-300 transform group-hover:scale-100 scale-75">
                                <div class="relative">
                                    {{-- Círculo exterior animado --}}
                                    <div class="w-20 h-20 border-2 border-white/40 rounded-full animate-ping absolute"></div>
                                    {{-- Círculo interior --}}
                                    <div class="w-16 h-16 bg-white/20 backdrop-blur-sm border-2 border-white/60 rounded-full flex items-center justify-center relative z-10">
                                        <svg class="w-8 h-8 text-white transform group-hover:rotate-12 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"></path>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                            
                            {{-- Información del item --}}
                            <div class="absolute bottom-0 left-0 right-0 p-4 lg:p-6 transform translate-y-full group-hover:translate-y-0 transition-transform duration-500">
                                <div class="bg-white/95 backdrop-blur-sm rounded-xl p-4 border border-white/20">
                                    <h4 class="text-lg font-bold text-gray-900 mb-1 truncate">{{ $item->title ?? 'Imagen de galería' }}</h4>
                                    @if($item->description)
                                        <p class="text-sm text-gray-600 line-clamp-2">{{ $item->description }}</p>
                                    @endif
                                    
                                    {{-- Barra de progreso decorativa --}}
                                    <div class="mt-3 h-1 bg-gray-200 rounded-full overflow-hidden">
                                        <div class="h-full bg-gradient-to-r from-red-500 to-blue-500 rounded-full transform scale-x-0 group-hover:scale-x-100 transition-transform duration-1000 delay-300"></div>
                                    </div>
                                </div>
                            </div>
                            
                            {{-- Efecto de brillo --}}
                            <div class="absolute -top-20 -left-20 w-40 h-40 bg-white/10 rounded-full blur-xl transform group-hover:translate-x-32 group-hover:translate-y-32 transition-transform duration-1000 opacity-0 group-hover:opacity-100"></div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- CTA Section premium --}}
        <div class="text-center gallery-cta-animate">
            <div class="inline-flex flex-col sm:flex-row gap-4 items-center justify-center">
                <a href="{{ route('gallery.index') }}" 
                   class="group inline-flex items-center px-8 py-4 bg-gradient-to-r from-red-600 to-blue-600 text-white font-semibold rounded-2xl transform hover:scale-105 transition-all duration-300 shadow-xl hover:shadow-2xl relative overflow-hidden">
                    {{-- Efecto de onda --}}
                    <div class="absolute inset-0 bg-white/10 rounded-2xl transform scale-x-0 group-hover:scale-x-100 transition-transform duration-500 origin-left"></div>
                    
                    <svg class="w-6 h-6 mr-3 relative z-10 transform group-hover:rotate-12 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    <span class="relative z-10">Ver Galería Completa</span>
                    <svg class="w-5 h-5 ml-3 relative z-10 transform group-hover:translate-x-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                    </svg>
                </a>
                
                <div class="text-gray-600 text-sm font-medium flex items-center">
                    <div class="w-2 h-2 bg-green-500 rounded-full mr-2 animate-pulse"></div>
                    <span>{{ count($galleryItems) }}+ imágenes disponibles</span>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Modal de galería mejorado --}}
<div id="galleryModal" class="gallery-modal-overlay">
    <div class="gallery-modal-background"></div>
    
    <div class="gallery-modal-container">
        {{-- Botón cerrar --}}
        <button onclick="closeGalleryModal()" 
                class="gallery-modal-close group">
            <svg class="w-6 h-6 transform group-hover:rotate-90 transition-transform duration-300" 
                 fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>
        
        {{-- Contenido del modal --}}
        <div class="gallery-modal-content">
            {{-- Contenedor de imagen --}}
            <div class="gallery-modal-image-container">
                <img id="modalImage" 
                     src="" 
                     alt="" 
                     class="gallery-modal-image"
                     loading="lazy">
                <div class="gallery-modal-image-overlay"></div>
            </div>
            
            {{-- Información --}}
            <div class="gallery-modal-info">
                <h3 id="modalTitle" class="gallery-modal-title"></h3>
                <p id="modalDescription" class="gallery-modal-description"></p>
                
                {{-- Decoración inferior --}}
                <div class="gallery-modal-footer">
                    <div class="gallery-modal-dots">
                        <div class="gallery-dot-red"></div>
                        <div class="gallery-dot-blue"></div>
                        <div class="gallery-dot-purple"></div>
                    </div>
                    <span class="gallery-modal-badge">Galería Premium</span>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Estilos CSS específicos para el modal y animaciones --}}
<style>
/* Animaciones personalizadas */
@keyframes gradient-x {
    0%, 100% {
        background-size: 200% 200%;
        background-position: left center;
    }
    50% {
        background-size: 200% 200%;
        background-position: right center;
    }
}

@keyframes scale-x {
    from { transform: scaleX(0); }
    to { transform: scaleX(1); }
}

@keyframes pulse-slow {
    0%, 100% { transform: scale(1); opacity: 0.3; }
    50% { transform: scale(1.05); opacity: 0.5; }
}

@keyframes float {
    0%, 100% { transform: translateY(0px) rotate(0deg); }
    50% { transform: translateY(-20px) rotate(180deg); }
}

@keyframes pulse-gentle {
    0%, 100% { transform: scale(1); opacity: 0.1; }
    50% { transform: scale(1.1); opacity: 0.3; }
}

@keyframes gallery-fade-in-up {
    from { opacity: 0; transform: translateY(40px); }
    to { opacity: 1; transform: translateY(0); }
}

/* Aplicar animaciones */
.animate-gradient-x { animation: gradient-x 3s ease infinite; }
.animate-scale-x { animation: scale-x 0.8s ease-out 0.5s forwards; }
.animate-pulse-slow { animation: pulse-slow 4s ease-in-out infinite; }
.animate-float { animation: float 6s ease-in-out infinite; }
.animate-pulse-gentle { animation: pulse-gentle 2s ease-in-out infinite; }

.gallery-header-animate { animation: gallery-fade-in-up 1s ease-out forwards; }
.gallery-item { animation: gallery-fade-in-up 0.8s ease-out forwards; opacity: 0; }
.gallery-cta-animate { animation: gallery-fade-in-up 1s ease-out 0.5s forwards; opacity: 0; }

/* Utilidades */
.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

/* === ESTILOS DEL MODAL === */
.gallery-modal-overlay {
    position: fixed !important;
    top: 0 !important;
    left: 0 !important;
    width: 100% !important;
    height: 100% !important;
    background: rgba(0, 0, 0, 0.9) !important;
    backdrop-filter: blur(5px);
    z-index: 9999 !important;
    display: none;
    opacity: 0;
    transition: opacity 0.3s ease-in-out;
    align-items: center;
    justify-content: center;
    padding: 1rem;
}

.gallery-modal-overlay.show {
    opacity: 1 !important;
}

.gallery-modal-background {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    cursor: pointer;
}

.gallery-modal-container {
    position: relative;
    max-width: 95vw;
    max-height: 95vh;
    width: 100%;
    max-width: 1400px;
    z-index: 10;
}

.gallery-modal-close {
    position: absolute;
    top: -50px;
    right: 0;
    z-index: 20;
    width: 48px;
    height: 48px;
    background: rgba(255, 255, 255, 0.1);
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.2);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    cursor: pointer;
    transition: all 0.3s ease;
    outline: none;
}

.gallery-modal-close:hover {
    background: rgba(255, 255, 255, 0.2);
    transform: scale(1.1);
}

.gallery-modal-content {
    background: white;
    border-radius: 16px;
    overflow: hidden;
    box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
    transform: scale(0.9);
    transition: transform 0.3s ease-out;
    max-height: 90vh;
    display: flex;
    flex-direction: column;
}

.gallery-modal-overlay.show .gallery-modal-content {
    transform: scale(1);
}

.gallery-modal-image-container {
    position: relative;
    height: 70vh;
    min-height: 400px;
    max-height: 600px;
    overflow: hidden;
    background: #f3f4f6;
}

.gallery-modal-image {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.gallery-modal-image-overlay {
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    height: 100px;
    background: linear-gradient(to top, rgba(0, 0, 0, 0.5), transparent);
    pointer-events: none;
}

.gallery-modal-info {
    padding: 2rem;
    flex: 1;
    overflow-y: auto;
}

.gallery-modal-title {
    font-size: 1.875rem;
    font-weight: 700;
    color: #111827;
    margin-bottom: 1rem;
    line-height: 1.2;
}

.gallery-modal-description {
    color: #6b7280;
    font-size: 1.125rem;
    line-height: 1.75;
    margin-bottom: 2rem;
}

.gallery-modal-footer {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding-top: 1.5rem;
    border-top: 1px solid #e5e7eb;
}

.gallery-modal-dots {
    display: flex;
    gap: 0.5rem;
}

.gallery-dot-red, .gallery-dot-blue, .gallery-dot-purple {
    width: 8px;
    height: 8px;
    border-radius: 50%;
}

.gallery-dot-red { background: #ef4444; }
.gallery-dot-blue { background: #3b82f6; }
.gallery-dot-purple { background: #8b5cf6; }

.gallery-modal-badge {
    font-size: 0.875rem;
    color: #6b7280;
    font-weight: 500;
}

/* Responsive */
@media (max-width: 768px) {
    .gallery-modal-container {
        max-width: 98vw;
        max-height: 98vh;
    }
    
    .gallery-modal-close {
        top: -40px;
        width: 40px;
        height: 40px;
    }
    
    .gallery-modal-image-container {
        height: 60vh;
        min-height: 300px;
    }
    
    .gallery-modal-info {
        padding: 1.5rem;
    }
    
    .gallery-modal-title {
        font-size: 1.5rem;
    }
    
    .gallery-modal-description {
        font-size: 1rem;
    }
    
    /* Simplificar layout en móvil */
    .gallery-grid-container .grid > div:nth-child(1) {
        grid-column: span 12 !important;
        grid-row: span 2 !important;
    }
    
    .gallery-grid-container .grid > div:nth-child(n+2) {
        grid-column: span 6 !important;
        grid-row: span 1 !important;
    }
}

@media (max-width: 480px) {
    .gallery-modal-container {
        max-width: 100vw;
        max-height: 100vh;
        padding: 0.5rem;
    }
    
    .gallery-modal-image-container {
        height: 50vh;
        min-height: 250px;
    }
    
    .gallery-modal-info {
        padding: 1rem;
    }
}
</style>

{{-- JavaScript mejorado para la galería --}}
<script>
document.addEventListener('DOMContentLoaded', function() {
    console.log('Inicializando galería...');
    
    // Variables globales
    let isModalOpen = false;
    
    // Función para abrir modal de galería
    window.openGalleryModal = function(imageSrc, title, description) {
        console.log('Abriendo modal:', imageSrc, title, description);
        
        try {
            const modal = document.getElementById('galleryModal');
            const modalImage = document.getElementById('modalImage');
            const modalTitle = document.getElementById('modalTitle');
            const modalDescription = document.getElementById('modalDescription');
            
            // Verificar que todos los elementos existen
            if (!modal || !modalImage || !modalTitle || !modalDescription) {
                console.error('Elementos del modal no encontrados');
                return;
            }
            
            // Configurar contenido
            modalImage.src = imageSrc;
            modalImage.alt = title || 'Imagen de galería';
            modalTitle.textContent = title || 'Imagen de galería';
            modalDescription.textContent = description || 'Descubre la belleza y elegancia de nuestras instalaciones.';
            
            // Mostrar modal con animación
            modal.style.display = 'flex';
            
            // Forzar reflow antes de agregar la clase de animación
            modal.offsetHeight;
            
            setTimeout(() => {
                modal.classList.add('show');
            }, 10);
            
            // Prevenir scroll del body
            document.body.style.overflow = 'hidden';
            isModalOpen = true;
            
            console.log('Modal abierto exitosamente');
            
        } catch (error) {
            console.error('Error al abrir modal:', error);
        }
    };
    
    // Función para cerrar modal
    window.closeGalleryModal = function() {
        console.log('Cerrando modal...');
        
        try {
            const modal = document.getElementById('galleryModal');
            
            if (!modal) {
                console.error('Modal no encontrado');
                return;
            }
            
            // Animación de cierre
            modal.classList.remove('show');
            
            setTimeout(() => {
                modal.style.display = 'none';
                document.body.style.overflow = '';
                isModalOpen = false;
            }, 300);
            
            console.log('Modal cerrado exitosamente');
            
        } catch (error) {
            console.error('Error al cerrar modal:', error);
        }
    };
    
    // Event listener para cerrar modal con ESC
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && isModalOpen) {
            closeGalleryModal();
        }
    });
    
    // Event listener para cerrar modal al hacer clic fuera
    const modal = document.getElementById('galleryModal');
    if (modal) {
        const background = modal.querySelector('.gallery-modal-background');
        if (background) {
            background.addEventListener('click', closeGalleryModal);
        }
    }
    
    // Agregar event listeners a todos los elementos de la galería
    function initializeGalleryItems() {
        const galleryItems = document.querySelectorAll('.gallery-item[data-image]');
        console.log(`Encontrados ${galleryItems.length} elementos de galería`);
        
        galleryItems.forEach((item, index) => {
            item.addEventListener('click', function(e) {
                e.preventDefault();
                
                const imageSrc = this.getAttribute('data-image');
                const title = this.getAttribute('data-title');
                const description = this.getAttribute('data-description');
                
                if (imageSrc) {
                    openGalleryModal(imageSrc, title, description);
                }
            });
            
            // Agregar cursor pointer
            item.style.cursor = 'pointer';
        });
    }
    
    // Inicializar elementos de galería
    initializeGalleryItems();
    
    // Intersection Observer para animaciones de entrada
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
                entry.target.classList.add('animate-in');
            }
        });
    }, observerOptions);

    // Observar elementos animados
    const animatedElements = document.querySelectorAll('.gallery-item, .gallery-cta-animate');
    animatedElements.forEach(el => {
        observer.observe(el);
    });
    
    // Efecto parallax sutil para elementos decorativos
    let ticking = false;
    
    function updateParallax() {
        const scrolled = window.pageYOffset;
        const decorativeElements = document.querySelectorAll('.absolute[class*="bg-gradient"], .absolute[class*="bg-red"], .absolute[class*="bg-blue"]');
        
        decorativeElements.forEach((el, index) => {
            const rate = scrolled * -0.1 * (index + 1);
            el.style.transform = `translateY(${rate}px)`;
        });
        
        ticking = false;
    }

    window.addEventListener('scroll', () => {
        if (!ticking) {
            requestAnimationFrame(updateParallax);
            ticking = true;
        }
    });
    
    // Función para debugging
    window.debugGallery = function() {
        console.log('=== DEBUG GALERÍA ===');
        console.log('Modal element:', document.getElementById('galleryModal'));
        console.log('Modal image:', document.getElementById('modalImage'));
        console.log('Modal title:', document.getElementById('modalTitle'));
        console.log('Modal description:', document.getElementById('modalDescription'));
        console.log('Gallery items:', document.querySelectorAll('.gallery-item[data-image]'));
        console.log('Is modal open:', isModalOpen);
        console.log('====================');
    };
    
    // Manejar errores de carga de imágenes
    document.addEventListener('error', function(e) {
        if (e.target.tagName === 'IMG') {
            console.warn('Error cargando imagen:', e.target.src);
            // Opcional: imagen de respaldo
            // e.target.src = 'https://via.placeholder.com/800x600?text=Imagen+no+disponible';
        }
    }, true);
    
    console.log('Galería inicializada correctamente');
});
</script>