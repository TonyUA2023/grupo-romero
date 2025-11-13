<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>@yield('title', 'Clínica Visual y Oftalmológica Laurent - Cuidamos tu visión')</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.13.10/dist/cdn.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/intersect@3.x.x/dist/cdn.min.js"></script>

    <script>
    tailwind.config = {
      theme: {
        extend: {
          colors: {
            'primary': '#004FFF', // Azul Intenso 
            'primary-dark': '#003cb3', // Tono más oscuro para hover
            'accent': '#E2432C',   // Rojo Vibrante 
            'accent-dark': '#c93a2a',   // Tono más oscuro para hover
            'dark': '#606060',     // Gris Oscuro 
            'light': '#F2F2F2',    // Tono Claro [cite: 136]
          },
          fontFamily: {
            'sans': ['Poppins', 'sans-serif'] // FUENTE POPPINS 
          }
        }
      }
    }
    </script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,300;0,400;0,500;0,700;0,800;1,300&display=swap" rel="stylesheet">
    
    <style>
        /* ===== CONFIGURACIÓN BÁSICA (ACTUALIZADA) ===== */
        body {
            /* FUENTE POPPINS REQUERIDA POR MANUAL  */
            font-family: 'Poppins', sans-serif;
            font-weight: 300;
            letter-spacing: 0.025em;
        }
        
        h1, h2, h3, h4, h5, h6 {
            font-weight: 400;
        }

        /* ===== SCROLLBAR PERSONALIZADO (AZUL CORPORATIVO) ===== */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        /* COLOR ACTUALIZADO  */
        ::-webkit-scrollbar-thumb {
            background: linear-gradient(45deg, #004FFF, #003cb3);
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(45deg, #003cb3, #002a80);
        }

        /* Firefox */
        * {
            scrollbar-width: thin;
            /* COLOR ACTUALIZADO  */
            scrollbar-color: #004FFF #f1f1f1;
        }

        /* ===== HEADER STYLES NUEVO DISEÑO ===== */
        .header-main {
            background: white;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            position: relative;
            z-index: 50;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        /* Header compacto en scroll */
        .header-compact {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            transform: translateY(-100%);
            animation: slideDown 0.4s cubic-bezier(0.4, 0, 0.2, 1) forwards;
            box-shadow: 0 4px 25px rgba(0, 0, 0, 0.15);
            backdrop-filter: blur(10px);
            background: rgba(255, 255, 255, 0.95);
            z-index: 100;
        }

        .header-compact.visible {
            transform: translateY(0);
        }

        @keyframes slideDown {
            from {
                transform: translateY(-100%);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        /* Top bar styles */
        .top-bar {
            /* COLOR ACTUALIZADO  */
            background: linear-gradient(135deg, #004FFF, #003cb3);
            color: white;
            text-align: center;
            padding: 0.75rem 0;
            font-size: 0.875rem;
            font-weight: 500;
            position: relative;
            overflow: hidden;
        }

        .top-bar::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            animation: shine 3s infinite;
        }

        @keyframes shine {
            0% { left: -100%; }
            100% { left: 100%; }
        }

        /* Logo styles */
        .clinic-logo {
            text-align: center;
            transition: all 0.3s ease;
        }

        .clinic-logo h1 {
            font-size: 1.875rem;
            font-weight: 700;
            /* COLOR ACTUALIZADO  */
            color: #374151; /* Mantenido, es un gris oscuro */
            letter-spacing: 0.1em;
            margin: 0;
            transition: all 0.3s ease;
        }

        .clinic-logo h2 {
            font-size: 1.5rem;
            font-weight: 700;
            /* COLOR ACTUALIZADO  */
            color: #004FFF;
            margin: -0.25rem 0 0 0;
            letter-spacing: 0.1em;
            transition: all 0.3s ease;
        }

        .clinic-logo p {
            font-size: 0.875rem;
            /* COLOR ACTUALIZADO  */
            color: #606060;
            font-weight: 500;
            margin: 0.25rem 0 0 0;
            letter-spacing: 0.15em;
            transition: all 0.3s ease;
        }

        /* Logo compacto para scroll */
        .header-compact .clinic-logo {
            text-align: left;
        }

        .header-compact .clinic-logo h1 {
            font-size: 1.25rem;
        }

        .header-compact .clinic-logo h2 {
            font-size: 1rem;
            margin: -0.1rem 0 0 0;
        }

        .header-compact .clinic-logo p {
            font-size: 0.75rem;
            margin: 0;
        }

        /* Navigation styles */
        .nav-link {
            position: relative;
            color: #374151;
            font-weight: 500;
            font-size: 0.875rem;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            padding: 0.75rem 0;
            transition: all 0.3s ease;
            text-decoration: none;
        }

        .nav-link:hover {
            /* COLOR ACTUALIZADO  */
            color: #004FFF;
            transform: translateY(-2px);
        }

        .nav-link.active {
            /* COLOR ACTUALIZADO  */
            color: #004FFF;
            border-bottom: 2px solid #004FFF;
            padding-bottom: 0.5rem;
        }

        .nav-link::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            width: 0;
            height: 2px;
            /* COLOR ACTUALIZADO  */
            background: linear-gradient(45deg, #004FFF, #003cb3);
            transition: all 0.3s ease;
            transform: translateX(-50%);
        }

        .nav-link:hover::after {
            width: 100%;
        }

        /* Compact navbar styles */
        .header-compact .nav-link {
            font-size: 0.8rem;
            padding: 0.5rem 0;
        }

        /* Mobile menu styles mejorados */
        .mobile-menu {
            position: fixed;
            top: 0;
            right: 0;
            bottom: 0;
            width: 100%;
            background: rgba(255, 255, 255, 0.98);
            backdrop-filter: blur(20px);
            z-index: 150;
            transform: translateX(100%);
            transition: transform 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .mobile-menu.active {
            transform: translateX(0);
        }

        .mobile-menu-overlay {
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.6);
            z-index: 140;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
            backdrop-filter: blur(4px);
        }

        .mobile-menu-overlay.active {
            opacity: 1;
            visibility: visible;
        }

        /* WhatsApp Button Enhanced */
        .whatsapp-container {
            position: fixed;
            bottom: 30px;
            right: 30px;
            z-index: 200;
            display: flex;
            align-items: center;
            gap: 16px;
        }
        /* Colores de WhatsApp (se mantienen por identidad de marca de WhatsApp) */
        .whatsapp-message {
            background: white;
            color: #1a1a1a;
            padding: 16px 28px;
            border-radius: 30px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.15);
            font-size: 15px;
            font-weight: 500;
            letter-spacing: 0.025em;
            opacity: 0;
            transform: translateX(20px);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            pointer-events: none;
            white-space: nowrap;
            position: relative;
            border: 2px solid #25D366;
        }
        .whatsapp-message::after {
            content: '';
            position: absolute;
            right: -8px;
            top: 50%;
            transform: translateY(-50%);
            width: 0;
            height: 0;
            border-left: 8px solid #25D366;
            border-top: 6px solid transparent;
            border-bottom: 6px solid transparent;
        }
        .whatsapp-container.show-message .whatsapp-message {
            opacity: 1;
            transform: translateX(0);
            pointer-events: auto;
        }
        .whatsapp-button {
            width: 65px;
            height: 65px;
            background: linear-gradient(135deg, #25D366, #128C7E);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            box-shadow: 0 4px 30px rgba(37, 211, 102, 0.5);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
            text-decoration: none;
        }
        .whatsapp-button:hover {
            transform: translateY(-5px) scale(1.05);
            box-shadow: 0 8px 40px rgba(37, 211, 102, 0.6);
        }
        .whatsapp-button i {
            font-size: 32px;
            color: white;
            z-index: 2;
            position: relative;
        }
        .whatsapp-button::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            transform: translate(-50%, -50%) scale(0);
            animation: pulse 2s ease-out infinite;
        }
        @keyframes pulse {
            0% {
                transform: translate(-50%, -50%) scale(0);
                opacity: 1;
            }
            100% {
                transform: translate(-50%, -50%) scale(2);
                opacity: 0;
            }
        }

        /* Scroll to top button */
        .scroll-top {
            position: fixed;
            bottom: 30px;
            left: 30px;
            width: 50px;
            height: 50px;
            /* COLOR ACTUALIZADO  */
            background: linear-gradient(135deg, #004FFF, #003cb3);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
            z-index: 199;
            box-shadow: 0 4px 20px rgba(0, 79, 255, 0.3);
        }
        .scroll-top.visible {
            opacity: 1;
            visibility: visible;
        }
        .scroll-top:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0, 79, 255, 0.5);
        }

        /* ===== FOOTER STYLES ===== */
        .footer-section {
            animation: footerFadeInUp 0.8s ease-out forwards;
            opacity: 0;
        }
        .footer-section:nth-child(1) { animation-delay: 0.1s; }
        .footer-section:nth-child(2) { animation-delay: 0.2s; }
        .footer-section:nth-child(3) { animation-delay: 0.3s; }
        .footer-section:nth-child(4) { animation-delay: 0.4s; }
        @keyframes footerFadeInUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .footer-link {
            position: relative;
            transition: all 0.3s ease;
        }
        .footer-link::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: -2px;
            left: 0;
            background-color: currentColor;
            transition: width 0.3s ease;
        }
        .footer-link:hover::after {
            width: 100%;
        }
        .footer-social {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .footer-social:hover {
            transform: translateY(-2px) scale(1.05);
        }
        .footer-newsletter input:focus {
            transform: translateY(-1px);
            box-shadow: 0 10px 25px rgba(0, 79, 255, 0.15); /* COLOR ACTUALIZADO  */
        }
        .footer-schedule .bg-gray-50:hover {
            transform: translateX(5px);
        }

        /* ===== RESPONSIVE DESIGN ===== */
        @media (max-width: 1024px) {
            .clinic-logo h1 { font-size: 1.5rem; }
            .clinic-logo h2 { font-size: 1.25rem; }
            .clinic-logo p { font-size: 0.75rem; }
            .header-compact .clinic-logo h1 { font-size: 1.1rem; }
            .header-compact .clinic-logo h2 { font-size: 0.9rem; }
        }
        @media (max-width: 640px) {
            .whatsapp-container { bottom: 20px; right: 20px; }
            .whatsapp-message { display: none; }
            .whatsapp-button { width: 60px; height: 60px; }
            .whatsapp-button i { font-size: 28px; }
            .scroll-top { bottom: 20px; left: 20px; width: 45px; height: 45px; }
            .footer-section h3 { text-align: center; margin-bottom: 1.5rem; }
            .footer-section ul { text-align: center; }
            .footer-social { width: 48px; height: 48px; }
        }

        /* Focus styles para accesibilidad */
        .nav-link:focus,
        button:focus,
        a:focus {
            /* COLOR ACTUALIZADO  */
            outline: 2px solid #004FFF;
            outline-offset: 2px;
        }

        /* Reduced motion */
        @media (prefers-reduced-motion: reduce) {
            *, *::before, *::after {
                animation-duration: 0.01ms !important;
                animation-iteration-count: 1 !important;
                transition-duration: 0.01ms !important;
            }
        }
        .border-l-4 { border-left-width: 4px; }
    </style>
</head>

<body class="bg-white text-dark antialiased overflow-x-hidden">
    
    <header id="headerMain" class="header-main">
        <div class="top-bar">
            <div class="relative z-10">
                Los mejores servicios desde S/100
            </div>
        </div>
        
        <div class="bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-center items-center py-6">
                    <div class="clinic-logo">
                        <h1>LAURENT</h1>
                        <h2>CLÍNICA VISUAL</h2>
                        <p>Y OPTOMETRÍA</p>
                    </div>
                </div>
            </div>
            
            <nav class="border-t border-gray-200" role="navigation" aria-label="Navegación principal">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="hidden lg:flex justify-center items-center space-x-12 py-4" id="desktopNav">
                        <a href="{{ url('/') }}" 
                           class="nav-link {{ request()->is('/') ? 'active' : '' }}"
                           aria-current="{{ request()->is('/') ? 'page' : 'false' }}">
                            Inicio
                        </a>
                        <a href="{{ url('/catalogo') }}" 
                           class="nav-link {{ request()->is('catalogo*') ? 'active' : '' }}"
                           aria-current="{{ request()->is('catalogo*') ? 'page' : 'false' }}">
                            Catálogo
                        </a>
                        <a href="{{ url('/servicios') }}" 
                           class="nav-link {{ request()->is('servicios*') ? 'active' : '' }}"
                           aria-current="{{ request()->is('servicios*') ? 'page' : 'false' }}">
                            Servicios
                        </a>
                        <a href="{{ url('/blogs') }}" 
                           class="nav-link {{ request()->is('blogs*') ? 'active' : '' }}"
                           aria-current="{{ request()->is('blogs*') ? 'page' : 'false' }}">
                            Blogs
                        </a>
                        <a href="{{ url('/contacto') }}" 
                           class="nav-link {{ request()->is('contacto*') ? 'active' : '' }}"
                           aria-current="{{ request()->is('contacto*') ? 'page' : 'false' }}">
                            Contacto
                        </a>
                    </div>
                    
                    <div class="lg:hidden flex justify-between items-center py-4">
                        <button 
                            id="mobileMenuButton" 
                            class="p-2 rounded-md text-gray-700 hover:text-primary hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-primary focus:ring-inset"
                            aria-expanded="false"
                            aria-controls="mobile-menu"
                            aria-label="Abrir menú de navegación">
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                            </svg>
                        </button>
                        
                        <a href="{{ url('/contacto') }}" 
                           class="inline-flex items-center px-4 py-2 bg-primary text-white text-sm font-medium rounded-md hover:bg-primary-dark transition-colors duration-300">
                            <i class="fas fa-calendar-check mr-2" aria-hidden="true"></i>
                            Cita
                        </a>
                    </div>
                </div>
            </nav>
        </div>
    </header>

    <header id="headerCompact" class="header-compact" style="display: none;">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center py-3">
                <div class="clinic-logo">
                    <h1>LAURENT</h1>
                    <h2>CLÍNICA VISUAL</h2>
                    <p>Y OPTOMETRÍA</p>
                </div>
                
                <nav class="hidden lg:flex items-center space-x-8">
                    <a href="{{ url('/') }}" 
                       class="nav-link {{ request()->is('/') ? 'active' : '' }}">
                        Inicio
                    </a>
                    <a href="{{ url('/catalogo') }}" 
                       class="nav-link {{ request()->is('catalogo*') ? 'active' : '' }}">
                        Catálogo
                    </a>
                    <a href="{{ url('/servicios') }}" 
                       class="nav-link {{ request()->is('servicios*') ? 'active' : '' }}">
                        Servicios
                    </a>
                    <a href="{{ url('/blogs') }}" 
                       class="nav-link {{ request()->is('blogs*') ? 'active' : '' }}">
                        Blogs
                    </a>
                    <a href="{{ url('/contacto') }}" 
                       class="nav-link {{ request()->is('contacto*') ? 'active' : '' }}">
                        Contacto
                    </a>
                </nav>
                
                <div class="lg:hidden">
                    <button 
                        id="mobileMenuButtonCompact" 
                        class="p-2 rounded-md text-gray-700 hover:text-primary hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-primary focus:ring-inset"
                        aria-expanded="false"
                        aria-label="Abrir menú de navegación">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </header>

    <div id="mobile-menu-overlay" class="mobile-menu-overlay"></div>
    
    <div id="mobile-menu" class="mobile-menu" aria-hidden="true">
        <div class="flex flex-col h-full">
            <div class="flex items-center justify-between p-4 border-b border-gray-200">
                <div class="clinic-logo">
                    <h3 class="text-lg font-bold text-gray-800">LAURENT</h3>
                    <h4 class="text-lg font-bold text-primary -mt-1">CLÍNICA VISUAL</h4>
                </div>
                <button 
                    id="closeMobileMenu" 
                    class="p-2 rounded-md text-gray-700 hover:text-primary focus:outline-none focus:ring-2 focus:ring-primary"
                    aria-label="Cerrar menú">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
            
            <nav class="flex-1 px-4 py-6 space-y-1 overflow-y-auto" role="navigation" aria-label="Navegación móvil">
                <a href="{{ url('/') }}" 
                   class="block px-3 py-3 text-base font-medium {{ request()->is('/') ? 'text-primary bg-blue-50' : 'text-gray-700 hover:text-primary hover:bg-gray-50' }} rounded-md transition-colors duration-300">
                    Inicio
                </a>
                <a href="{{ url('/catalogo') }}" 
                   class="block px-3 py-3 text-base font-medium {{ request()->is('catalogo*') ? 'text-primary bg-blue-50' : 'text-gray-700 hover:text-primary hover:bg-gray-50' }} rounded-md transition-colors duration-300">
                    Catálogo
                </a>
                <a href="{{ url('/servicios') }}" 
                   class="block px-3 py-3 text-base font-medium {{ request()->is('servicios*') ? 'text-primary bg-blue-50' : 'text-gray-700 hover:text-primary hover:bg-gray-50' }} rounded-md transition-colors duration-300">
                    Servicios
                </a>
                <a href="{{ url('/blogs') }}" 
                   class="block px-3 py-3 text-base font-medium {{ request()->is('blogs*') ? 'text-primary bg-blue-50' : 'text-gray-700 hover:text-primary hover:bg-gray-50' }} rounded-md transition-colors duration-300">
                    Blogs
                </a>
                <a href="{{ url('/contacto') }}" 
                   class="block px-3 py-3 text-base font-medium {{ request()->is('contacto*') ? 'text-primary bg-blue-50' : 'text-gray-700 hover:text-primary hover:bg-gray-50' }} rounded-md transition-colors duration-300">
                    Contacto
                </a>
            </nav>
            
            <div class="border-t border-gray-200 p-4">
                <a href="{{ url('/contacto') }}" 
                   class="block w-full text-center px-4 py-3 bg-primary text-white font-medium rounded-md hover:bg-primary-dark transition-colors duration-300">
                    <i class="fas fa-calendar-check mr-2" aria-hidden="true"></i>
                    Reservar Cita
                </a>
                
                <div class="mt-4 space-y-3">
                    <a href="tel:+51923323517" class="flex items-center text-gray-600 hover:text-primary transition-colors">
                        <i class="fas fa-phone mr-3 text-primary"></i>
                        <span>923 323 517</span>
                    </a>
                    <a href="mailto:clinicagrc@gmail.com" class="flex items-center text-gray-600 hover:text-primary transition-colors">
                        <i class="fas fa-envelope mr-3 text-primary"></i>
                        <span>clinicagrc@gmail.com</span>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="whatsapp-container" id="whatsappContainer">
        <div class="whatsapp-message">
            <strong>¡Hola!</strong> ¿En qué podemos ayudarte?
        </div>
        <a href="https://wa.me/51923323517?text=Hola%20Clínica%20Laurent,%20me%20gustaría%20realizar%20una%20consulta%20sobre%20sus%20servicios" 
           target="_blank" 
           class="whatsapp-button"
           id="whatsappButton"
           aria-label="Contactar por WhatsApp">
            <i class="fab fa-whatsapp"></i>
            <span class="whatsapp-notification"></span>
        </a>
    </div>

    <button class="scroll-top" id="scrollTop">
        <i class="fas fa-arrow-up text-white"></i>
    </button>

    <main class="relative">
        @yield('content')
    </main>

    <footer class="bg-white py-20 lg:py-24 relative overflow-hidden border-t border-gray-100">
        
        <div class="absolute top-0 left-0 w-96 h-96 bg-blue-50 rounded-full blur-3xl opacity-50 -translate-x-1/2 -translate-y-1/2"></div>
        <div class="absolute bottom-0 right-0 w-96 h-96 bg-red-50 rounded-full blur-3xl opacity-50 translate-x-1/2 translate-y-1/2"></div>
        <div class="absolute top-1/2 left-1/2 w-64 h-64 bg-gray-50 rounded-full blur-2xl opacity-30 transform -translate-x-1/2 -translate-y-1/2"></div>
        
        <div class="absolute inset-0 opacity-5">
            <div class="absolute top-32 right-64 w-3 h-3 bg-primary rounded-full"></div>
            <div class="absolute top-48 right-32 w-2 h-2 bg-accent rounded-full"></div>
            <div class="absolute bottom-48 left-32 w-4 h-4 bg-primary rounded-full"></div>
            <div class="absolute bottom-32 left-64 w-2 h-2 bg-accent rounded-full"></div>
        </div>
        
        <div class="w-full px-4 sm:px-6 lg:px-8 relative z-10">
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 lg:gap-16">
                
                <div class="footer-section">
                    <h3 class="text-lg font-bold text-gray-900 mb-8 uppercase tracking-wider relative">
                        Servicios
                        <div class="absolute -bottom-2 left-0 w-12 h-0.5 bg-primary"></div>
                    </h3>
                    <ul class="space-y-4">
                        <li><a href="/servicios" class="footer-link group flex items-center text-dark hover:text-primary font-medium transition-all duration-300">
                            <div class="w-2 h-2 bg-blue-200 rounded-full mr-3 group-hover:bg-primary transition-colors duration-300"></div>
                            Medida de Vista
                        </a></li>
                        <li><a href="/servicios" class="footer-link group flex items-center text-dark hover:text-primary font-medium transition-all duration-300">
                            <div class="w-2 h-2 bg-blue-200 rounded-full mr-3 group-hover:bg-primary transition-colors duration-300"></div>
                            Examen Visual Completo
                        </a></li>
                        <li><a href="/servicios" class="footer-link group flex items-center text-dark hover:text-primary font-medium transition-all duration-300">
                            <div class="w-2 h-2 bg-blue-200 rounded-full mr-3 group-hover:bg-primary transition-colors duration-300"></div>
                            Descarte de Enfermedades
                        </a></li>
                        <li><a href="/servicios" class="footer-link group flex items-center text-dark hover:text-primary font-medium transition-all duration-300">
                            <div class="w-2 h-2 bg-blue-200 rounded-full mr-3 group-hover:bg-primary transition-colors duration-300"></div>
                            Asesoría de Imagen
                        </a></li>
                    </ul>
                </div>
                
                <div class="footer-section">
                    <h3 class="text-lg font-bold text-gray-900 mb-8 uppercase tracking-wider relative">
                        Productos
                        <div class="absolute -bottom-2 left-0 w-12 h-0.5 bg-accent"></div>
                    </h3>
                    <ul class="space-y-4">
                        <li><a href="/catalogo?page=1&marca=ferretti" class="footer-link group flex items-center text-dark hover:text-accent font-medium transition-all duration-300">
                            <div class="w-2 h-2 bg-red-200 rounded-full mr-3 group-hover:bg-accent transition-colors duration-300"></div>
                            Monturas Premium
                        </a></li>
                        <li><a href="/catalogo?page=1&genero=mujer" class="footer-link group flex items-center text-dark hover:text-accent font-medium transition-all duration-300">
                            <div class="w-2 h-2 bg-red-200 rounded-full mr-3 group-hover:bg-accent transition-colors duration-300"></div>
                            Para Mujeres
                        </a></li>
                        <li><a href="/catalogo?page=1&genero=hombre" class="footer-link group flex items-center text-dark hover:text-accent font-medium transition-all duration-300">
                            <div class="w-2 h-2 bg-red-200 rounded-full mr-3 group-hover:bg-accent transition-colors duration-300"></div>
                            Para Hombres
                        </a></li>
                        <li><a href="/catalogo" class="footer-link group flex items-center text-dark hover:text-accent font-medium transition-all duration-300">
                            <div class="w-2 h-2 bg-red-200 rounded-full mr-3 group-hover:bg-accent transition-colors duration-300"></div>
                            Lentes de Sol
                        </a></li>
                    </ul>
                </div>
                
                <div class="footer-section">
                    <h3 class="text-lg font-bold text-gray-900 mb-8 uppercase tracking-wider relative">
                        Información
                        <div class="absolute -bottom-2 left-0 w-12 h-0.5 bg-primary"></div>
                    </h3>
                    <ul class="space-y-4">
                        <li><a href="/nosotros" class="footer-link group flex items-center text-dark hover:text-primary font-medium transition-all duration-300">
                            <div class="w-2 h-2 bg-blue-200 rounded-full mr-3 group-hover:bg-primary transition-colors duration-300"></div>
                            Sobre Nosotros
                        </a></li>
                        <li><a href="/especialistas" class="footer-link group flex items-center text-dark hover:text-primary font-medium transition-all duration-300">
                            <div class="w-2 h-2 bg-blue-200 rounded-full mr-3 group-hover:bg-primary transition-colors duration-300"></div>
                            Nuestro Equipo
                        </a></li>
                        <li><a href="/blogs" class="footer-link group flex items-center text-dark hover:text-primary font-medium transition-all duration-300">
                            <div class="w-2 h-2 bg-blue-200 rounded-full mr-3 group-hover:bg-primary transition-colors duration-300"></div>
                            Blog de Salud Visual
                        </a></li>
                        <li><a href="/contacto" class="footer-link group flex items-center text-dark hover:text-primary font-medium transition-all duration-300">
                            <div class="w-2 h-2 bg-blue-200 rounded-full mr-3 group-hover:bg-primary transition-colors duration-300"></div>
                            Preguntas Frecuentes
                        </a></li>
                    </ul>
                </div>
                
                <div class="footer-section">
                    <h3 class="text-lg font-bold text-gray-900 mb-8 uppercase tracking-wider relative">
                        Contacto Rápido
                        <div class="absolute -bottom-2 left-0 w-12 h-0.5 bg-accent"></div>
                    </h3>
                    <ul class="space-y-6">
                        <li>
                            <a href="https://maps.app.goo.gl/TRibRft4VDC53A8V6" 
                               target="_blank"
                               class="flex items-start group hover:bg-blue-50 p-3 rounded-xl transition-all duration-300">
                                <div class="flex-shrink-0 w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center mr-3 group-hover:bg-primary transition-colors duration-300">
                                    <svg class="w-5 h-5 text-primary group-hover:text-white transition-colors duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <span class="footer-link text-dark group-hover:text-primary font-medium transition-colors duration-300">
                                        Av. 9 de Diciembre 580<br>
                                        Huancayo, Junín
                                    </span>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="tel:+51923323517" class="flex items-center group hover:bg-blue-50 p-3 rounded-xl transition-all duration-300">
                                <div class="flex-shrink-0 w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center mr-3 group-hover:bg-primary transition-colors duration-300">
                                    <svg class="w-5 h-5 text-primary group-hover:text-white transition-colors duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                    </svg>
                                </div>
                                <span class="footer-link text-dark group-hover:text-primary font-medium transition-colors duration-300">923 323 517</span>
                            </a>
                        </li>
                        <li>
                            <a href="mailto:clinicagrc@gmail.com" class="flex items-center group hover:bg-blue-50 p-3 rounded-xl transition-all duration-300">
                                <div class="flex-shrink-0 w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center mr-3 group-hover:bg-primary transition-colors duration-300">
                                    <svg class="w-5 h-5 text-primary group-hover:text-white transition-colors duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 7.89a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                                <span class="footer-link text-dark group-hover:text-primary font-medium transition-colors duration-300">clinicagrc@gmail.com</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            
            <div class="my-16 flex items-center">
                <div class="flex-1 h-px bg-blue-200"></div>
                <div class="mx-4 w-3 h-3 bg-primary rounded-full"></div>
                <div class="flex-1 h-px bg-red-200"></div>
                <div class="mx-4 w-3 h-3 bg-accent rounded-full"></div>
                <div class="flex-1 h-px bg-blue-200"></div>
            </div>
            
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                
                <div class="footer-schedule">
                    <h3 class="text-lg font-bold text-gray-900 mb-6 uppercase tracking-wider">Horario de Atención</h3>
                    <div class="bg-gray-50 border-l-4 border-primary rounded-2xl p-6 hover:bg-blue-50 transition-colors duration-300 group">
                        <div class="flex items-center space-x-4">
                            <div class="flex-shrink-0">
                                <div class="w-14 h-14 bg-white rounded-xl flex items-center justify-center shadow-lg group-hover:shadow-xl transition-shadow duration-300 border-2 border-blue-100">
                                    <svg class="w-7 h-7 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                            </div>
                            <div>
                                <p class="font-bold text-gray-900 text-lg">Lunes a Domingo</p>
                                <p class="text-accent font-semibold">9:00 AM - 7:00 PM</p>
                                <p class="text-dark text-sm mt-1">Atención continua</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="footer-newsletter">
                    <h3 class="text-lg font-bold text-gray-900 mb-6 uppercase tracking-wider">Suscríbete a nuestro Newsletter</h3>
                    <p class="text-dark mb-4">Recibe ofertas exclusivas y consejos de salud visual</p>
                    <form class="flex flex-col sm:flex-row gap-3" onsubmit="handleNewsletterSubmit(event)">
                        <div class="flex-1 relative">
                            <input type="email" 
                                   name="email"
                                   placeholder="Tu correo electrónico" 
                                   required
                                   class="w-full px-5 py-3 rounded-xl border-2 border-gray-200 focus:border-primary focus:ring-4 focus:ring-blue-100 transition-all duration-300 pr-10">
                            <svg class="absolute right-3 top-1/2 transform -translate-y-1/2 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 7.89a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        <button type="submit" 
                                class="px-8 py-3 bg-accent hover:bg-accent-dark text-white font-bold rounded-xl hover:shadow-xl transform hover:scale-105 transition-all duration-300 border-2 border-accent-dark relative overflow-hidden group">
                            <span class="relative z-10">Suscribir</span>
                            <div class="absolute bottom-0 left-0 w-full h-1 bg-primary"></div>
                        </button>
                    </form>
                </div>
            </div>
        </div>
        
        <div class="border-t-2 border-gray-100 mt-16">
            <div class="w-full px-4 sm:px-6 lg:px-8 py-12">
                <div class="flex flex-col lg:flex-row items-center justify-between space-y-8 lg:space-y-0">
                    
                    <div class="flex items-center space-x-6">
                        <span class="text-sm text-dark font-medium mr-4">Síguenos:</span>
                        <a href="https://www.facebook.com/opticasgrckids" 
                           target="_blank"
                           class="footer-social w-12 h-12 bg-blue-100 hover:bg-blue-600 text-blue-600 hover:text-white rounded-xl flex items-center justify-center transition-all duration-300 transform hover:scale-110 shadow-lg hover:shadow-xl">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                            </svg>
                        </a>
                        </div>
                    
                    <div class="flex items-center space-x-4">
                        <span class="text-sm text-dark font-medium mr-2">Aceptamos:</span>
                        </div>
                </div>
                
                <div class="mt-12 pt-8 border-t border-gray-200 text-center">
                    <div class="flex flex-col md:flex-row items-center justify-center space-y-4 md:space-y-0 md:space-x-8">
                        <p class="text-sm text-dark font-medium">
                            © {{ date('Y') }} Clínica Visual y Oftalmológica Laurent. Todos los derechos reservados.
                        </p>
                        <p class="text-sm text-dark font-medium flex items-center">
                            Desarrollado con 
                            <svg class="w-4 h-4 text-accent mx-1" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.T8-3.4 6.86-8.55 11.54L12 21.35z"/>
                            </svg>
                            en Huancayo, Perú
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Referencias a elementos
        const headerMain = document.getElementById('headerMain');
        const headerCompact = document.getElementById('headerCompact');
        const mobileMenuButton = document.getElementById('mobileMenuButton');
        const mobileMenuButtonCompact = document.getElementById('mobileMenuButtonCompact');
        const mobileMenu = document.getElementById('mobile-menu');
        const mobileMenuOverlay = document.getElementById('mobile-menu-overlay');
        const closeMobileMenu = document.getElementById('closeMobileMenu');
        const scrollTopBtn = document.getElementById('scrollTop');
        const whatsappContainer = document.getElementById('whatsappContainer');
        const whatsappButton = document.getElementById('whatsappButton');

        let lastScrollY = 0;
        let ticking = false;

        // ===== MANEJO DEL SCROLL PARA HEADER ===== 
        function updateHeader() {
            const scrollY = window.pageYOffset;
            const triggerPoint = headerMain.offsetHeight + 100;

            if (scrollY > triggerPoint) {
                // Mostrar header compacto
                if (!headerCompact.classList.contains('visible')) {
                    headerCompact.classList.add('visible');
                    headerCompact.style.display = 'block';
                }
            } else {
                // Ocultar header compacto
                if (headerCompact.classList.contains('visible')) {
                    headerCompact.classList.remove('visible');
                    setTimeout(() => {
                        if (!headerCompact.classList.contains('visible')) {
                            headerCompact.style.display = 'none';
                        }
                    }, 400);
                }
            }

            // Scroll to top button
            if (scrollY > 300) {
                scrollTopBtn.classList.add('visible');
            } else {
                scrollTopBtn.classList.remove('visible');
            }

            lastScrollY = scrollY;
            ticking = false;
        }

        function requestTick() {
            if (!ticking) {
                requestAnimationFrame(updateHeader);
                ticking = true;
            }
        }

        window.addEventListener('scroll', requestTick, { passive: true });

        // ===== MOBILE MENU FUNCTIONALITY =====
        function toggleMobileMenu() {
            const isOpen = mobileMenu.classList.contains('active');
            if (isOpen) {
                closeMobileMenuFunc();
            } else {
                openMobileMenu();
            }
        }
        function openMobileMenu() {
            mobileMenu.classList.add('active');
            mobileMenuOverlay.classList.add('active');
            document.body.style.overflow = 'hidden';
            mobileMenuButton.setAttribute('aria-expanded', 'true');
            if (mobileMenuButtonCompact) {
                mobileMenuButtonCompact.setAttribute('aria-expanded', 'true');
            }
            mobileMenu.setAttribute('aria-hidden', 'false');
            const firstLink = mobileMenu.querySelector('a');
            if (firstLink) {
                setTimeout(() => firstLink.focus(), 100);
            }
        }
        function closeMobileMenuFunc() {
            mobileMenu.classList.remove('active');
            mobileMenuOverlay.classList.remove('active');
            document.body.style.overflow = '';
            mobileMenuButton.setAttribute('aria-expanded', 'false');
            if (mobileMenuButtonCompact) {
                mobileMenuButtonCompact.setAttribute('aria-expanded', 'false');
            }
            mobileMenu.setAttribute('aria-hidden', 'true');
        }
        
        // Event listeners para mobile menu
        mobileMenuButton.addEventListener('click', toggleMobileMenu);
        if (mobileMenuButtonCompact) {
            mobileMenuButtonCompact.addEventListener('click', toggleMobileMenu);
        }
        closeMobileMenu.addEventListener('click', closeMobileMenuFunc);
        mobileMenuOverlay.addEventListener('click', closeMobileMenuFunc);
        
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && mobileMenu.classList.contains('active')) {
                closeMobileMenuFunc();
                mobileMenuButton.focus();
            }
        });

        // ===== SCROLL TO TOP FUNCTIONALITY =====
        scrollTopBtn.addEventListener('click', function() {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });

        // ===== WHATSAPP FUNCTIONALITY =====
        let messageTimeout;
        let hasInteracted = false;
        setTimeout(() => {
            if (!hasInteracted) {
                whatsappContainer.classList.add('show-message');
                messageTimeout = setTimeout(() => {
                    whatsappContainer.classList.remove('show-message');
                }, 5000);
            }
        }, 3000);
        whatsappButton.addEventListener('mouseenter', () => {
            clearTimeout(messageTimeout);
            whatsappContainer.classList.add('show-message');
        });
        whatsappButton.addEventListener('mouseleave', () => {
            messageTimeout = setTimeout(() => {
                whatsappContainer.classList.remove('show-message');
            }, 2000);
        });
        whatsappButton.addEventListener('click', () => {
            hasInteracted = true;
            const notification = whatsappButton.querySelector('.whatsapp-notification');
            if (notification) {
                notification.style.display = 'none';
            }
        });

        // ===== FOOTER FUNCTIONALITY =====
        window.handleNewsletterSubmit = function(event) {
            event.preventDefault();
            const form = event.target;
            const email = form.email.value;
            const button = form.querySelector('button[type="submit"]');
            const originalText = button.querySelector('span').textContent;
            
            if (!email || !email.includes('@')) {
                alert('Por favor, ingresa un email válido');
                return;
            }
            
            button.disabled = true;
            button.querySelector('span').textContent = 'Enviando...';
            button.classList.add('opacity-75');
            
            setTimeout(() => {
                button.querySelector('span').textContent = '¡Suscrito!';
                button.classList.remove('bg-accent', 'hover:bg-accent-dark');
                button.classList.add('bg-green-600');
                
                setTimeout(() => {
                    button.disabled = false;
                    button.querySelector('span').textContent = originalText;
                    button.classList.remove('opacity-75', 'bg-green-600');
                    button.classList.add('bg-accent', 'hover:bg-accent-dark');
                    form.reset();
                }, 2000);
            }, 1500);
        };
        
        // Intersection Observer para animaciones del footer
        const observerOptions = { threshold: 0.1, rootMargin: '0px 0px -50px 0px' };
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, observerOptions);
        const footerSections = document.querySelectorAll('.footer-section');
        footerSections.forEach(section => {
            observer.observe(section);
        });

        console.log('🎉 Layout Clínica Laurent inicializado correctamente');
    });

    // ===== GLOBAL FUNCTIONS =====
    window.scrollToSection = function(sectionId) {
        const section = document.getElementById(sectionId);
        if (section) {
            section.scrollIntoView({ behavior: 'smooth' });
        }
    };
    </script>
</body>
</html>