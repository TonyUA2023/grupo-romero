@extends('layouts.app')

@section('title', 'GRC Clínica Optométrica - Excelencia en Salud Visual')
@section('description', 'Centro de optometría de vanguardia con tecnología avanzada. Diagnósticos precisos, tratamientos personalizados y atención excepcional.')

@section('content')

{{-- ===== INCLUIR PARTIALS DE SECCIONES ===== --}}

{{-- Hero Section --}}
@include('home.partials.Hero')

{{-- Brands Section --}}
@include('home.partials.Brands')
{{-- Men's Products Section --}}
@include('home.partials.MensProducts')
{{-- Video Spotlight Section --}}
@include('home.partials.VideoSpotlight')



{{-- Products Section (General/Featured) --}}
@include('home.partials.ProductCategories')

{{-- Products Section (General/Featured) --}}
@include('home.partials.Products')

{{-- NUEVAS SECCIONES DE PRODUCTOS POR GÉNERO --}}



{{-- Services Section --}}
@include('home.partials.Services')

{{-- Team Section --}}
@include('home.partials.Team')

{{-- Facilities Section --}}
@include('home.partials.Facilities')

{{-- Blog Section --}}
@include('home.partials.Blog')

{{-- Video Tour Section --}}
@include('home.partials.VideoTour')

{{-- Gallery Section --}}
@include('home.partials.Gallery')

{{-- Testimonials Section --}}
@include('home.partials.Testimonials')

{{-- Video Testimonials Section --}}
@include('home.partials.VideoTestimonials')

{{-- ===== SCRIPTS BÁSICOS NECESARIOS ===== --}}
<script>
// ===== CONFIGURACIÓN BÁSICA =====
const config = {
    animationDuration: 800,
    scrollOffset: 100,
    testimonialAutoPlay: true,
    testimonialInterval: 5000
};

// ===== FUNCIONALIDAD BÁSICA DEL MODAL =====
function openModal(imageSrc, title, description) {
    const modal = document.getElementById('imageModal');
    if (!modal) return;
    
    const modalImage = document.getElementById('modalImage');
    const modalTitle = document.getElementById('modalTitle');
    const modalDescription = document.getElementById('modalDescription');
    
    if (modalImage) modalImage.src = imageSrc;
    if (modalTitle) modalTitle.textContent = title || '';
    if (modalDescription) modalDescription.textContent = description || '';
    
    modal.classList.remove('opacity-0', 'invisible');
    document.body.style.overflow = 'hidden';
}

function openGalleryModal(imageSrc, title, description) {
    openModal(imageSrc, title, description);
}

function closeImageModal() {
    const modal = document.getElementById('imageModal');
    if (!modal) return;
    
    modal.classList.add('opacity-0', 'invisible');
    document.body.style.overflow = 'auto';
}

// ===== TESTIMONIAL CAROUSEL BÁSICO =====
let currentTestimonialSlide = 0;
let testimonialInterval;

function nextTestimonial() {
    const track = document.getElementById('testimonialTrack');
    if (!track) return;
    
    const totalItems = track.querySelectorAll('.testimonial-item').length;
    if (totalItems === 0) return;
    
    const visibleItems = getVisibleTestimonialItems();
    const maxIndex = Math.max(0, totalItems - visibleItems);
    
    currentTestimonialSlide = currentTestimonialSlide >= maxIndex ? 0 : currentTestimonialSlide + 1;
    updateTestimonialPosition();
}

function prevTestimonial() {
    const track = document.getElementById('testimonialTrack');
    if (!track) return;
    
    const totalItems = track.querySelectorAll('.testimonial-item').length;
    if (totalItems === 0) return;
    
    const visibleItems = getVisibleTestimonialItems();
    const maxIndex = Math.max(0, totalItems - visibleItems);
    
    currentTestimonialSlide = currentTestimonialSlide <= 0 ? maxIndex : currentTestimonialSlide - 1;
    updateTestimonialPosition();
}

function goToTestimonial(index) {
    currentTestimonialSlide = index;
    updateTestimonialPosition();
}

function updateTestimonialPosition() {
    const track = document.getElementById('testimonialTrack');
    if (!track) return;
    
    const visibleItems = getVisibleTestimonialItems();
    const offset = -currentTestimonialSlide * (100 / visibleItems);
    track.style.transform = `translateX(${offset}%)`;
    
    // Actualizar dots
    const dots = document.querySelectorAll('[data-dot]');
    dots.forEach((dot, index) => {
        if (index === currentTestimonialSlide) {
            dot.classList.add('bg-white', 'w-8');
            dot.classList.remove('bg-white/30');
        } else {
            dot.classList.remove('bg-white', 'w-8');
            dot.classList.add('bg-white/30');
        }
    });
}

function getVisibleTestimonialItems() {
    if (window.innerWidth >= 1024) return 3;
    if (window.innerWidth >= 768) return 2;
    return 1;
}

// ===== HERO SLIDER BÁSICO =====
let currentHeroSlide = 0;
let heroInterval;

function changeHeroSlide(index) {
    const heroSlides = document.querySelectorAll('.hero-bg-slide');
    const heroContents = document.querySelectorAll('.hero-content-slide');
    const heroDots = document.querySelectorAll('.hero-dots button');
    
    heroSlides.forEach((slide, i) => {
        slide.classList.toggle('opacity-100', i === index);
        slide.classList.toggle('opacity-0', i !== index);
    });

    heroContents.forEach((content, i) => {
        content.classList.toggle('opacity-100', i === index);
        content.classList.toggle('opacity-0', i !== index);
    });

    heroDots.forEach((dot, i) => {
        dot.classList.toggle('bg-white', i === index);
        dot.classList.toggle('bg-white/50', i !== index);
    });

    currentHeroSlide = index;
}

function autoChangeHero() {
    const heroSlidesCount = document.querySelectorAll('.hero-bg-slide').length;
    if (heroSlidesCount === 0) return;
    
    currentHeroSlide = (currentHeroSlide + 1) % heroSlidesCount;
    changeHeroSlide(currentHeroSlide);
}

// ===== PRODUCTS FILTER =====
function filterProducts(filter) {
    // Actualizar botones activos
    document.querySelectorAll('.filter-btn').forEach(btn => {
        btn.classList.remove('active');
    });
    
    const activeBtn = document.querySelector(`[data-filter="${filter}"]`);
    if (activeBtn) activeBtn.classList.add('active');
    
    // Ocultar todas las secciones
    document.querySelectorAll('.product-section').forEach(section => {
        section.style.opacity = '0';
        setTimeout(() => {
            section.classList.add('hidden');
        }, 300);
    });
    
    // Mostrar la sección correspondiente
    let sectionId = '';
    switch(filter) {
        case 'featured':
            sectionId = 'featured-products';
            break;
        case 'new':
            sectionId = 'new-products';
            break;
        case 'under150':
            sectionId = 'under150-products';
            break;
    }
    
    const activeSection = document.getElementById(sectionId);
    if (activeSection) {
        setTimeout(() => {
            activeSection.classList.remove('hidden');
            activeSection.style.opacity = '1';
        }, 310);
    }
}

// ===== GÉNERO PRODUCTS CAROUSEL =====
function scrollGenderProducts(gender, direction) {
    const container = document.getElementById(`${gender}-products-container`);
    if (!container) return;
    
    const scrollAmount = 320; // Ancho de una tarjeta + gap
    
    if (direction === 'left') {
        container.scrollBy({ left: -scrollAmount, behavior: 'smooth' });
    } else {
        container.scrollBy({ left: scrollAmount, behavior: 'smooth' });
    }
}

// ===== INICIALIZACIÓN =====
document.addEventListener('DOMContentLoaded', function() {
    console.log('GRC Clínica Optométrica - Inicializando...');
    
    // Inicializar testimonial autoplay si existe
    const testimonialTrack = document.getElementById('testimonialTrack');
    if (testimonialTrack && config.testimonialAutoPlay) {
        testimonialInterval = setInterval(nextTestimonial, config.testimonialInterval);
        
        // Pausar en hover
        testimonialTrack.addEventListener('mouseenter', () => {
            if (testimonialInterval) {
                clearInterval(testimonialInterval);
            }
        });
        
        testimonialTrack.addEventListener('mouseleave', () => {
            if (config.testimonialAutoPlay) {
                testimonialInterval = setInterval(nextTestimonial, config.testimonialInterval);
            }
        });
    }
    
    // Inicializar hero autoplay si existe
    const heroSlides = document.querySelectorAll('.hero-bg-slide');
    if (heroSlides.length > 1) {
        heroInterval = setInterval(autoChangeHero, 8000);
    }
    
    // Cerrar modal con ESC
    document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape') {
            closeImageModal();
        }
    });
    
    // Actualizar año actual
    const yearElements = document.querySelectorAll('.current-year');
    yearElements.forEach(el => {
        el.textContent = new Date().getFullYear();
    });
    
    // Lazy Loading básico para imágenes
    const lazyImages = document.querySelectorAll('img[loading="lazy"]');
    if ('IntersectionObserver' in window) {
        const imageObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const img = entry.target;
                    if (img.dataset.src) {
                        img.src = img.dataset.src;
                        img.removeAttribute('data-src');
                    }
                    img.classList.add('loaded');
                    imageObserver.unobserve(img);
                }
            });
        });
        
        lazyImages.forEach(img => imageObserver.observe(img));
    }
    
    console.log('GRC Clínica Optométrica - Inicialización completa');
});

// ===== FUNCIONES PARA COMPATIBILIDAD CON COMPONENTES =====

// Para Video Testimonials
function nextVideoTestimonial() {
    if (typeof window.nextVideoTestimonial === 'function') {
        window.nextVideoTestimonial();
    }
}

function prevVideoTestimonial() {
    if (typeof window.prevVideoTestimonial === 'function') {
        window.prevVideoTestimonial();
    }
}

// Para Products Modal
function openProductModal(productId) {
    if (typeof window.openProductModal === 'function') {
        window.openProductModal(productId);
    }
}

function closeProductModal() {
    if (typeof window.closeProductModal === 'function') {
        window.closeProductModal();
    }
}

// Limpiar intervalos al cambiar de página
window.addEventListener('beforeunload', function() {
    if (testimonialInterval) clearInterval(testimonialInterval);
    if (heroInterval) clearInterval(heroInterval);
});
</script>

{{-- ===== ESTILOS MÍNIMOS NECESARIOS ===== --}}
<style>
/* Reset básico */
* {
    scroll-behavior: smooth;
}

/* Transiciones suaves */
.transition-opacity {
    transition: opacity 0.3s ease;
}

.transition-transform {
    transition: transform 0.3s ease;
}

/* Modal básico */
.opacity-0 {
    opacity: 0;
}

.invisible {
    visibility: hidden;
}

/* Hero slider */
.hero-bg-slide,
.hero-content-slide {
    transition: opacity 0.5s ease;
}

/* Products filter */
.filter-btn.active {
    background-color: #DC2626;
    color: white;
}

.product-section {
    transition: opacity 0.3s ease;
}

.product-section.hidden {
    display: none;
}

/* Testimonial carousel */
#testimonialTrack {
    transition: transform 0.5s ease;
}

/* Gender Products Carousel */
.gender-products-container {
    scroll-behavior: smooth;
    -webkit-overflow-scrolling: touch;
}

.gender-products-container::-webkit-scrollbar {
    height: 6px;
}

.gender-products-container::-webkit-scrollbar-track {
    background: #f1f1f1;
    border-radius: 10px;
}

.gender-products-container::-webkit-scrollbar-thumb {
    background: #DC2626;
    border-radius: 10px;
}

/* Lazy loading */
img.loaded {
    opacity: 1;
}

img[data-src] {
    opacity: 0.5;
    transition: opacity 0.3s ease;
}

/* Utilities */
.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.line-clamp-3 {
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

/* Focus states */
button:focus,
a:focus {
    outline: 2px solid #DC2626;
    outline-offset: 2px;
}

/* Responsive utilities */
@media (max-width: 768px) {
    .container {
        padding-left: 1rem;
        padding-right: 1rem;
    }
}

/* Print styles */
@media print {
    .no-print {
        display: none !important;
    }
}
</style>

@endsection