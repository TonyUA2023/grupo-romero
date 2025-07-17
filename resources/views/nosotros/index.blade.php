@extends('layouts.app')

@section('title', 'Nosotros - GRC Clínica Optométrica')
@section('description', 'Conoce a GRC Clínica Optométrica, líderes en salud visual con más de 20 años de experiencia cuidando la visión de miles de pacientes.')

@push('styles')
<style>
    :root {
        --black: #000000;
        --dark-gray: #1a1a1a;
        --medium-gray: #4a4a4a;
        --light-gray: #e5e5e5;
        --white: #ffffff;
        --transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
    }

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: 'Helvetica Neue', Arial, sans-serif;
        background: var(--white);
        color: var(--dark-gray);
        overflow-x: hidden;
    }

    /* Typography */
    .hero-title {
        font-size: clamp(3rem, 8vw, 6rem);
        font-weight: 100;
        letter-spacing: -0.02em;
        line-height: 0.9;
    }

    .section-title {
        font-size: clamp(2rem, 5vw, 3.5rem);
        font-weight: 200;
        letter-spacing: -0.01em;
        margin-bottom: 3rem;
    }

    .subtitle {
        font-size: clamp(1.2rem, 3vw, 1.5rem);
        font-weight: 300;
        line-height: 1.6;
        opacity: 0.8;
    }

    /* Animations */
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(40px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes scaleIn {
        from {
            opacity: 0;
            transform: scale(0.9);
        }
        to {
            opacity: 1;
            transform: scale(1);
        }
    }

    @keyframes lineGrow {
        from { transform: scaleX(0); }
        to { transform: scaleX(1); }
    }

    .animate-in {
        opacity: 0;
        animation: fadeInUp 1s forwards;
    }

    .delay-100 { animation-delay: 0.1s; }
    .delay-200 { animation-delay: 0.2s; }
    .delay-300 { animation-delay: 0.3s; }
    .delay-400 { animation-delay: 0.4s; }

    /* Hero Section */
    .hero-section {
        height: 100vh;
        position: relative;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
    }

    .hero-bg {
        position: absolute;
        inset: 0;
        z-index: -1;
    }

    .hero-bg img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        filter: grayscale(100%) contrast(1.2);
    }

    .hero-overlay {
        position: absolute;
        inset: 0;
        background: linear-gradient(to bottom, rgba(0,0,0,0.3), rgba(0,0,0,0.6));
        z-index: -1;
    }

    .hero-content {
        text-align: center;
        color: var(--white);
        padding: 0 1rem;
        max-width: 900px;
    }

    .scroll-indicator {
        position: absolute;
        bottom: 2rem;
        left: 50%;
        transform: translateX(-50%);
        color: var(--white);
        font-size: 1.5rem;
        animation: bounce 2s infinite;
    }

    @keyframes bounce {
        0%, 100% { transform: translateX(-50%) translateY(0); }
        50% { transform: translateX(-50%) translateY(10px); }
    }

    /* Section Styles */
    .section {
        padding: 5rem 1rem;
        position: relative;
    }

    .container {
        max-width: 1200px;
        margin: 0 auto;
    }

    .text-center { text-align: center; }
    .text-right { text-align: right; }

    /* Grid Layouts */
    .grid {
        display: grid;
        gap: 2rem;
    }

    .grid-2 {
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        align-items: center;
    }

    .grid-3 {
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    }

    .grid-4 {
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    }

    /* About Section */
    .about-image {
        position: relative;
        overflow: hidden;
        height: 600px;
    }

    .about-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        filter: grayscale(100%);
        transition: var(--transition);
    }

    .about-image:hover img {
        transform: scale(1.05);
    }

    .about-content {
        padding: 2rem;
    }

    .divider {
        width: 60px;
        height: 1px;
        background: var(--black);
        margin: 2rem 0;
        transform-origin: left;
        animation: lineGrow 1s ease-out forwards;
    }

    /* Timeline */
    .timeline {
        position: relative;
        padding: 2rem 0;
    }

    .timeline::before {
        content: '';
        position: absolute;
        left: 50%;
        top: 0;
        bottom: 0;
        width: 1px;
        background: var(--light-gray);
        transform: translateX(-50%);
    }

    .timeline-item {
        position: relative;
        padding: 2rem 0;
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 4rem;
        align-items: center;
    }

    .timeline-item::before {
        content: '';
        position: absolute;
        left: 50%;
        top: 50%;
        width: 12px;
        height: 12px;
        background: var(--black);
        border-radius: 50%;
        transform: translate(-50%, -50%);
        z-index: 1;
    }

    .timeline-content {
        padding: 2rem;
        background: var(--white);
        border: 1px solid var(--light-gray);
        transition: var(--transition);
    }

    .timeline-content:hover {
        box-shadow: 0 10px 40px rgba(0,0,0,0.1);
        transform: translateY(-5px);
    }

    .timeline-year {
        font-size: 3rem;
        font-weight: 100;
        opacity: 0.2;
        margin-bottom: 1rem;
    }

    /* Team Section */
    .team-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 2rem;
    }

    .team-member {
        position: relative;
        overflow: hidden;
        background: var(--white);
        transition: var(--transition);
    }

    .team-member:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 60px rgba(0,0,0,0.15);
    }

    .team-image {
        position: relative;
        height: 400px;
        overflow: hidden;
    }

    .team-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        filter: grayscale(100%);
        transition: var(--transition);
    }

    .team-member:hover .team-image img {
        transform: scale(1.1);
        filter: grayscale(0%);
    }

    .team-info {
        padding: 2rem;
        text-align: center;
        border: 1px solid var(--light-gray);
        border-top: none;
    }

    .team-name {
        font-size: 1.5rem;
        font-weight: 300;
        margin-bottom: 0.5rem;
    }

    .team-role {
        color: var(--medium-gray);
        font-size: 0.9rem;
        letter-spacing: 0.05em;
        text-transform: uppercase;
    }

    /* Values Section */
    .values-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 3rem;
        margin-top: 4rem;
    }

    .value-card {
        text-align: center;
        padding: 3rem 2rem;
        background: var(--white);
        border: 1px solid var(--light-gray);
        transition: var(--transition);
        position: relative;
        overflow: hidden;
    }

    .value-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 3px;
        background: var(--black);
        transform: scaleX(0);
        transform-origin: left;
        transition: transform 0.4s ease;
    }

    .value-card:hover::before {
        transform: scaleX(1);
    }

    .value-card:hover {
        box-shadow: 0 15px 40px rgba(0,0,0,0.1);
        transform: translateY(-5px);
    }

    .value-icon {
        font-size: 3rem;
        margin-bottom: 1.5rem;
        opacity: 0.8;
    }

    .value-title {
        font-size: 1.5rem;
        font-weight: 300;
        margin-bottom: 1rem;
    }

    /* Gallery Section */
    .gallery-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 1rem;
        margin-top: 3rem;
    }

    .gallery-item {
        position: relative;
        overflow: hidden;
        height: 300px;
        cursor: pointer;
    }

    .gallery-item img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        filter: grayscale(100%);
        transition: var(--transition);
    }

    .gallery-item:hover img {
        filter: grayscale(0%);
        transform: scale(1.1);
    }

    .gallery-overlay {
        position: absolute;
        inset: 0;
        background: rgba(0,0,0,0.7);
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        transition: var(--transition);
    }

    .gallery-item:hover .gallery-overlay {
        opacity: 1;
    }

    .gallery-text {
        color: var(--white);
        font-size: 1.2rem;
        font-weight: 300;
        transform: translateY(20px);
        transition: var(--transition);
    }

    .gallery-item:hover .gallery-text {
        transform: translateY(0);
    }

    /* CTA Section */
    .cta-section {
        background: var(--black);
        color: var(--white);
        padding: 6rem 1rem;
        text-align: center;
    }

    .cta-button {
        display: inline-block;
        padding: 1rem 3rem;
        margin-top: 2rem;
        border: 1px solid var(--white);
        color: var(--white);
        text-decoration: none;
        text-transform: uppercase;
        letter-spacing: 0.1em;
        font-size: 0.9rem;
        transition: var(--transition);
        position: relative;
        overflow: hidden;
    }

    .cta-button::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: var(--white);
        transition: left 0.4s ease;
        z-index: -1;
    }

    .cta-button:hover {
        color: var(--black);
    }

    .cta-button:hover::before {
        left: 0;
    }

    /* Stats Section */
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 2rem;
        text-align: center;
        padding: 4rem 0;
    }

    .stat-item {
        padding: 2rem;
    }

    .stat-number {
        font-size: 4rem;
        font-weight: 100;
        line-height: 1;
        margin-bottom: 0.5rem;
    }

    .stat-label {
        font-size: 0.9rem;
        text-transform: uppercase;
        letter-spacing: 0.1em;
        opacity: 0.7;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .hero-title {
            font-size: 3rem;
        }
        
        .section-title {
            font-size: 2rem;
        }
        
        .timeline-item {
            grid-template-columns: 1fr;
            gap: 2rem;
        }
        
        .timeline::before {
            left: 2rem;
        }
        
        .timeline-item::before {
            left: 2rem;
        }
        
        .about-image {
            height: 400px;
        }
        
        .stats-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    /* Parallax Effect */
    .parallax {
        position: relative;
        background-attachment: fixed;
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
        min-height: 400px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .parallax-overlay {
        position: absolute;
        inset: 0;
        background: rgba(0,0,0,0.5);
    }

    .parallax-content {
        position: relative;
        z-index: 1;
        text-align: center;
        color: var(--white);
        padding: 2rem;
    }

    /* Loading Animation */
    .loader {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: var(--white);
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 9999;
        transition: opacity 0.5s ease;
    }

    .loader.hidden {
        opacity: 0;
        pointer-events: none;
    }

    .loader-circle {
        width: 40px;
        height: 40px;
        border: 2px solid var(--light-gray);
        border-top-color: var(--black);
        border-radius: 50%;
        animation: spin 1s linear infinite;
    }

    @keyframes spin {
        to { transform: rotate(360deg); }
    }
</style>
@endpush

@section('content')

<!-- Loader -->
<div class="loader" id="loader">
    <div class="loader-circle"></div>
</div>

<!-- Hero Section -->
<section class="hero-section">
    <div class="hero-bg">
        <img src="{{ asset('images/about/hero-clinic-exterior.jpg') }}" alt="GRC Clínica Optométrica - Fachada Principal">
    </div>
    <div class="hero-overlay"></div>
    <div class="hero-content">
        <h1 class="hero-title animate-in">Visión Clara,<br>Futuro Brillante</h1>
        <p class="subtitle animate-in delay-200">Más de dos décadas transformando vidas a través del cuidado integral de la salud visual</p>
    </div>
    <div class="scroll-indicator">
        <i class="fas fa-chevron-down"></i>
    </div>
</section>

<!-- About Section -->
<section class="section">
    <div class="container">
        <div class="grid grid-2">
            <div class="about-content animate-in">
                <h2 class="section-title">Nuestra Historia</h2>
                <div class="divider"></div>
                <p class="subtitle">Fundada en 2001, GRC Clínica Optométrica nació con la visión de revolucionar el cuidado ocular en el Perú.</p>
                <p style="margin-top: 2rem; line-height: 1.8;">
                    Lo que comenzó como un pequeño consultorio familiar, hoy es una de las clínicas oftalmológicas más reconocidas del país. 
                    Nuestro compromiso con la excelencia médica y la atención personalizada nos ha permitido ganar la confianza de más de 
                    50,000 pacientes que han encontrado en nosotros no solo profesionales de la salud, sino verdaderos aliados en el 
                    cuidado de su visión.
                </p>
                <p style="margin-top: 1.5rem; line-height: 1.8;">
                    Equipados con tecnología de vanguardia y un equipo médico altamente especializado, continuamos escribiendo nuestra 
                    historia día a día, manteniendo siempre nuestro enfoque en lo más importante: tu salud visual.
                </p>
            </div>
            <div class="about-image animate-in delay-200">
                <img src="{{ asset('images/about/clinic-interior-modern.jpg') }}" alt="Interior moderno de GRC Clínica">
            </div>
        </div>
    </div>
</section>

<!-- Timeline Section -->
<section class="section" style="background: #fafafa;">
    <div class="container">
        <h2 class="section-title text-center animate-in">Nuestro Camino</h2>
        
        <div class="timeline">
            <div class="timeline-item animate-in">
                <div class="timeline-content">
                    <div class="timeline-year">2001</div>
                    <h3>El Comienzo</h3>
                    <p>Apertura del primer consultorio en Miraflores con solo 3 especialistas.</p>
                    <img src="{{ asset('images/about/timeline-2001.jpg') }}" alt="Primer consultorio 2001" style="width: 100%; margin-top: 1rem; filter: grayscale(100%);">
                </div>
                <div></div>
            </div>
            
            <div class="timeline-item animate-in delay-200">
                <div></div>
                <div class="timeline-content">
                    <div class="timeline-year">2008</div>
                    <h3>Expansión</h3>
                    <p>Inauguración de nuestra sede principal con tecnología de punta.</p>
                    <img src="{{ asset('images/about/timeline-2008.jpg') }}" alt="Nueva sede 2008" style="width: 100%; margin-top: 1rem; filter: grayscale(100%);">
                </div>
            </div>
            
            <div class="timeline-item animate-in delay-300">
                <div class="timeline-content">
                    <div class="timeline-year">2015</div>
                    <h3>Innovación</h3>
                    <p>Primeros en implementar cirugía láser de última generación en el país.</p>
                    <img src="{{ asset('images/about/timeline-2015.jpg') }}" alt="Tecnología láser 2015" style="width: 100%; margin-top: 1rem; filter: grayscale(100%);">
                </div>
                <div></div>
            </div>
            
            <div class="timeline-item animate-in delay-400">
                <div></div>
                <div class="timeline-content">
                    <div class="timeline-year">2024</div>
                    <h3>Presente</h3>
                    <p>20+ especialistas, 50,000+ pacientes atendidos y líderes en salud visual.</p>
                    <img src="{{ asset('images/about/timeline-2024.jpg') }}" alt="GRC hoy" style="width: 100%; margin-top: 1rem; filter: grayscale(100%);">
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Mission Vision Values -->
<section class="section">
    <div class="container">
        <h2 class="section-title text-center animate-in">Nuestros Pilares</h2>
        
        <div class="values-grid">
            <div class="value-card animate-in">
                <div class="value-icon">
                    <i class="fas fa-bullseye"></i>
                </div>
                <h3 class="value-title">Misión</h3>
                <p>Brindar atención oftalmológica integral de excelencia, utilizando tecnología avanzada y un equipo humano comprometido con mejorar la calidad de vida de nuestros pacientes a través del cuidado de su salud visual.</p>
            </div>
            
            <div class="value-card animate-in delay-100">
                <div class="value-icon">
                    <i class="fas fa-eye"></i>
                </div>
                <h3 class="value-title">Visión</h3>
                <p>Ser reconocidos como la clínica oftalmológica líder en el Perú, referente en innovación tecnológica, excelencia médica y calidez humana, contribuyendo a que más personas disfruten de una visión saludable.</p>
            </div>
            
            <div class="value-card animate-in delay-200">
                <div class="value-icon">
                    <i class="fas fa-heart"></i>
                </div>
                <h3 class="value-title">Valores</h3>
                <p>Excelencia médica, innovación constante, calidez humana, ética profesional, responsabilidad social y compromiso con la mejora continua en beneficio de nuestros pacientes.</p>
            </div>
        </div>
    </div>
</section>

<!-- Stats Section -->
<div class="parallax" style="background-image: url('{{ asset('images/about/parallax-stats.jpg') }}');">
    <div class="parallax-overlay"></div>
    <div class="parallax-content">
        <div class="container">
            <div class="stats-grid">
                <div class="stat-item animate-in">
                    <div class="stat-number">50K+</div>
                    <div class="stat-label">Pacientes Atendidos</div>
                </div>
                <div class="stat-item animate-in delay-100">
                    <div class="stat-number">23</div>
                    <div class="stat-label">Años de Experiencia</div>
                </div>
                <div class="stat-item animate-in delay-200">
                    <div class="stat-number">20+</div>
                    <div class="stat-label">Especialistas</div>
                </div>
                <div class="stat-item animate-in delay-300">
                    <div class="stat-number">98%</div>
                    <div class="stat-label">Satisfacción</div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Team Section -->
<section class="section">
    <div class="container">
        <h2 class="section-title text-center animate-in">Nuestro Equipo</h2>
        <p class="subtitle text-center animate-in delay-100" style="max-width: 600px; margin: 0 auto 3rem;">
            Profesionales altamente calificados comprometidos con tu salud visual
        </p>
        
        <div class="team-grid">
            <div class="team-member animate-in">
                <div class="team-image">
                    <img src="{{ asset('images/team/dr-romero-director.jpg') }}" alt="Dr. Carlos Romero">
                </div>
                <div class="team-info">
                    <h3 class="team-name">Dr. Carlos Romero</h3>
                    <p class="team-role">Director Médico</p>
                </div>
            </div>
            
            <div class="team-member animate-in delay-100">
                <div class="team-image">
                    <img src="{{ asset('images/team/dra-mendez-oftalmologia.jpg') }}" alt="Dra. Ana Méndez">
                </div>
                <div class="team-info">
                    <h3 class="team-name">Dra. Ana Méndez</h3>
                    <p class="team-role">Jefa de Oftalmología</p>
                </div>
            </div>
            
            <div class="team-member animate-in delay-200">
                <div class="team-image">
                    <img src="{{ asset('images/team/dr-silva-cirugia.jpg') }}" alt="Dr. Roberto Silva">
                </div>
                <div class="team-info">
                    <h3 class="team-name">Dr. Roberto Silva</h3>
                    <p class="team-role">Cirujano Oftalmólogo</p>
                </div>
            </div>
            
            <div class="team-member animate-in delay-300">
                <div class="team-image">
                    <img src="{{ asset('images/team/dra-torres-pediatrica.jpg') }}" alt="Dra. María Torres">
                </div>
                <div class="team-info">
                    <h3 class="team-name">Dra. María Torres</h3>
                    <p class="team-role">Oftalmología Pediátrica</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Facilities Gallery -->
<section class="section" style="background: #fafafa;">
    <div class="container">
        <h2 class="section-title text-center animate-in">Nuestras Instalaciones</h2>
        <p class="subtitle text-center animate-in delay-100" style="max-width: 600px; margin: 0 auto;">
            Espacios diseñados pensando en tu comodidad y equipados con la más alta tecnología
        </p>
        
        <div class="gallery-grid">
            <div class="gallery-item animate-in">
                <img src="{{ asset('images/facilities/reception-area.jpg') }}" alt="Área de recepción">
                <div class="gallery-overlay">
                    <p class="gallery-text">Área de Recepción</p>
                </div>
            </div>
            
            <div class="gallery-item animate-in delay-100">
                <img src="{{ asset('images/facilities/consultation-room.jpg') }}" alt="Consultorio">
                <div class="gallery-overlay">
                    <p class="gallery-text">Consultorios Especializados</p>
                </div>
            </div>
            
            <div class="gallery-item animate-in delay-200">
                <img src="{{ asset('images/facilities/surgery-room.jpg') }}" alt="Quirófano">
                <div class="gallery-overlay">
                    <p class="gallery-text">Quirófanos de Última Generación</p>
                </div>
            </div>
            
            <div class="gallery-item animate-in delay-300">
                <img src="{{ asset('images/facilities/diagnostic-equipment.jpg') }}" alt="Equipos de diagnóstico">
                <div class="gallery-overlay">
                    <p class="gallery-text">Equipos de Diagnóstico Avanzado</p>
                </div>
            </div>
            
            <div class="gallery-item animate-in delay-400">
                <img src="{{ asset('images/facilities/waiting-area.jpg') }}" alt="Sala de espera">
                <div class="gallery-overlay">
                    <p class="gallery-text">Cómodas Salas de Espera</p>
                </div>
            </div>
            
            <div class="gallery-item animate-in delay-500">
                <img src="{{ asset('images/facilities/optical-store.jpg') }}" alt="Óptica">
                <div class="gallery-overlay">
                    <p class="gallery-text">Óptica con las Mejores Marcas</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Technology Section -->
<section class="section">
    <div class="container">
        <div class="grid grid-2">
            <div class="animate-in">
                <h2 class="section-title">Tecnología de Vanguardia</h2>
                <div class="divider"></div>
                <p class="subtitle">Invertimos constantemente en los equipos más avanzados para ofrecerte diagnósticos precisos y tratamientos efectivos.</p>
                
                <div style="margin-top: 3rem;">
                    <h4 style="margin-bottom: 1rem; font-weight: 300;">Nuestros Equipos Incluyen:</h4>
                    <ul style="list-style: none; padding: 0;">
                        <li style="padding: 0.5rem 0; border-bottom: 1px solid #eee;">
                            <i class="fas fa-check" style="margin-right: 1rem;"></i>
                            Tomógrafo de Coherencia Óptica (OCT) de última generación
                        </li>
                        <li style="padding: 0.5rem 0; border-bottom: 1px solid #eee;">
                            <i class="fas fa-check" style="margin-right: 1rem;"></i>
                            Sistema de Cirugía Láser Excimer de alta precisión
                        </li>
                        <li style="padding: 0.5rem 0; border-bottom: 1px solid #eee;">
                            <i class="fas fa-check" style="margin-right: 1rem;"></i>
                            Microscopios quirúrgicos con tecnología 3D
                        </li>
                        <li style="padding: 0.5rem 0; border-bottom: 1px solid #eee;">
                            <i class="fas fa-check" style="margin-right: 1rem;"></i>
                            Campímetro computarizado para campo visual
                        </li>
                        <li style="padding: 0.5rem 0;">
                            <i class="fas fa-check" style="margin-right: 1rem;"></i>
                            Topógrafo corneal y aberrómetro
                        </li>
                    </ul>
                </div>
            </div>
            <div class="about-image animate-in delay-200">
                <img src="{{ asset('images/technology/oct-scanner.jpg') }}" alt="Escáner OCT de última generación">
            </div>
        </div>
    </div>
</section>

<!-- Certifications -->
<section class="section" style="background: #fafafa;">
    <div class="container">
        <h2 class="section-title text-center animate-in">Certificaciones y Reconocimientos</h2>
        
        <div class="grid grid-4" style="margin-top: 3rem;">
            <div class="text-center animate-in">
                <img src="{{ asset('images/certifications/iso-certification.png') }}" alt="ISO 9001:2015" style="height: 120px; margin: 0 auto 1rem; filter: grayscale(100%);">
                <p style="font-size: 0.9rem;">ISO 9001:2015</p>
            </div>
            <div class="text-center animate-in delay-100">
                <img src="{{ asset('images/certifications/minsa-certification.png') }}" alt="MINSA" style="height: 120px; margin: 0 auto 1rem; filter: grayscale(100%);">
                <p style="font-size: 0.9rem;">Certificación MINSA</p>
            </div>
            <div class="text-center animate-in delay-200">
                <img src="{{ asset('images/certifications/college-ophthalmology.png') }}" alt="Colegio de Oftalmólogos" style="height: 120px; margin: 0 auto 1rem; filter: grayscale(100%);">
                <p style="font-size: 0.9rem;">Colegio de Oftalmólogos del Perú</p>
            </div>
            <div class="text-center animate-in delay-300">
                <img src="{{ asset('images/certifications/quality-award.png') }}" alt="Premio Calidad" style="height: 120px; margin: 0 auto 1rem; filter: grayscale(100%);">
                <p style="font-size: 0.9rem;">Premio Nacional a la Calidad 2023</p>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="cta-section">
    <div class="container">
        <h2 class="section-title animate-in" style="color: white;">Tu Visión es Nuestra Prioridad</h2>
        <p class="subtitle animate-in delay-100" style="color: rgba(255,255,255,0.9); max-width: 600px; margin: 0 auto;">
            Agenda tu cita hoy y descubre por qué miles de pacientes confían en nosotros para el cuidado de su salud visual.
        </p>
        <a href="{{ route('contact') }}" class="cta-button animate-in delay-200">
            Agendar Consulta
        </a>
    </div>
</section>

@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Hide loader
    setTimeout(() => {
        document.getElementById('loader').classList.add('hidden');
    }, 1000);

    // Intersection Observer for animations
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
                observer.unobserve(entry.target);
            }
        });
    }, observerOptions);

    // Observe all animated elements
    document.querySelectorAll('.animate-in').forEach(el => {
        el.style.opacity = '0';
        el.style.transform = 'translateY(40px)';
        observer.observe(el);
    });

    // Smooth scroll
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });

    // Parallax effect
    window.addEventListener('scroll', () => {
        const scrolled = window.pageYOffset;
        const parallax = document.querySelectorAll('.parallax');
        
        parallax.forEach(element => {
            const speed = 0.5;
            element.style.backgroundPositionY = -(scrolled * speed) + 'px';
        });
    });

    // Gallery lightbox (basic implementation)
    document.querySelectorAll('.gallery-item').forEach(item => {
        item.addEventListener('click', function() {
            const img = this.querySelector('img');
            const lightbox = document.createElement('div');
            lightbox.style.cssText = `
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: rgba(0,0,0,0.9);
                display: flex;
                align-items: center;
                justify-content: center;
                z-index: 9999;
                cursor: pointer;
            `;
            
            const lightboxImg = document.createElement('img');
            lightboxImg.src = img.src;
            lightboxImg.style.cssText = `
                max-width: 90%;
                max-height: 90%;
                object-fit: contain;
            `;
            
            lightbox.appendChild(lightboxImg);
            document.body.appendChild(lightbox);
            
            lightbox.addEventListener('click', () => {
                lightbox.remove();
            });
        });
    });
});
</script>
@endpush