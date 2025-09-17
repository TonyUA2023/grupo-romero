<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'GRC Clínica Optométrica - Cuidamos tu visión')</title>
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.13.10/dist/cdn.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/intersect@3.x.x/dist/cdn.min.js"></script>


    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Sen:wght@400..800&display=swap" rel="stylesheet">    
    <style>
        /* ===== CONFIGURACIÓN BÁSICA ===== */
        body {
            font-family: 'Sen', sans-serif;
            font-weight: 300;
            letter-spacing: 0.025em;
        }
        
        h1, h2, h3, h4, h5, h6 {
            font-weight: 400;
        }

        /* ===== SCROLLBAR PERSONALIZADO ROJO ===== */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        ::-webkit-scrollbar-thumb {
            background: linear-gradient(45deg, #ef4444, #dc2626);
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(45deg, #dc2626, #b91c1c);
        }

        /* Firefox */
        * {
            scrollbar-width: thin;
            scrollbar-color: #ef4444 #f1f1f1;
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
            background: linear-gradient(135deg, #ef4444, #dc2626);
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
            color: #374151;
            letter-spacing: 0.1em;
            margin: 0;
            transition: all 0.3s ease;
        }

        .clinic-logo h2 {
            font-size: 1.5rem;
            font-weight: 700;
            color: #ef4444;
            margin: -0.25rem 0 0 0;
            letter-spacing: 0.1em;
            transition: all 0.3s ease;
        }

        .clinic-logo p {
            font-size: 0.875rem;
            color: #6b7280;
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
            color: #ef4444;
            transform: translateY(-2px);
        }

        .nav-link.active {
            color: #ef4444;
            border-bottom: 2px solid #ef4444;
            padding-bottom: 0.5rem;
        }

        .nav-link::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            width: 0;
            height: 2px;
            background: linear-gradient(45deg, #ef4444, #dc2626);
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

        /* Pulse animation */
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
            background: linear-gradient(135deg, #ef4444, #dc2626);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
            z-index: 199;
            box-shadow: 0 4px 20px rgba(239, 68, 68, 0.3);
        }

        .scroll-top.visible {
            opacity: 1;
            visibility: visible;
        }

        .scroll-top:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(239, 68, 68, 0.5);
        }

        /* ===== FOOTER STYLES ===== */
        /* Animaciones del footer */
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

        /* Links del footer */
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

        /* Efectos hover mejorados */
        .footer-social {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .footer-social:hover {
            transform: translateY(-2px) scale(1.05);
        }

        /* Newsletter mejorado */
        .footer-newsletter input:focus {
            transform: translateY(-1px);
            box-shadow: 0 10px 25px rgba(59, 130, 246, 0.15);
        }

        /* Horario mejorado */
        .footer-schedule .bg-gray-50:hover {
            transform: translateX(5px);
        }

        /* ===== RESPONSIVE DESIGN ===== */
        @media (max-width: 1024px) {
            .clinic-logo h1 {
                font-size: 1.5rem;
            }
            .clinic-logo h2 {
                font-size: 1.25rem;
            }
            .clinic-logo p {
                font-size: 0.75rem;
            }
            
            .header-compact .clinic-logo h1 {
                font-size: 1.1rem;
            }
            .header-compact .clinic-logo h2 {
                font-size: 0.9rem;
            }
        }

        @media (max-width: 640px) {
            .whatsapp-container {
                bottom: 20px;
                right: 20px;
            }

            .whatsapp-message {
                display: none;
            }

            .whatsapp-button {
                width: 60px;
                height: 60px;
            }

            .whatsapp-button i {
                font-size: 28px;
            }

            .scroll-top {
                bottom: 20px;
                left: 20px;
                width: 45px;
                height: 45px;
            }

            .footer-section h3 {
                text-align: center;
                margin-bottom: 1.5rem;
            }
            
            .footer-section ul {
                text-align: center;
            }
            
            .footer-social {
                width: 48px;
                height: 48px;
            }
        }

        /* Focus styles para accesibilidad */
        .nav-link:focus,
        button:focus,
        a:focus {
            outline: 2px solid #ef4444;
            outline-offset: 2px;
        }

        /* Reduced motion */
        @media (prefers-reduced-motion: reduce) {
            *,
            *::before,
            *::after {
                animation-duration: 0.01ms !important;
                animation-iteration-count: 1 !important;
                transition-duration: 0.01ms !important;
            }
        }

        /* Efectos adicionales del footer */
        .border-l-4 {
            border-left-width: 4px;
        }
    </style>
</head>

<body class="bg-white text-gray-900 antialiased overflow-x-hidden">
   
    <!-- Header Principal -->
    <header id="headerMain" class="header-main">
        <!-- Top Bar -->
        <div class="top-bar">
            <div class="relative z-10">
                Los mejores servicios desde S/100
            </div>
        </div>
        
        <!-- Main Header -->
        <div class="bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-center items-center py-6">
                    <!-- Logo Centrado -->
                    <div class="clinic-logo">
                        <h1>CLÍNICA</h1>
                        <h2>GRUPO ROMERO</h2>
                        <p>OPTOMETRICA & OPTICAS</p>
                    </div>
                </div>
            </div>
            
            <!-- Navigation -->
            <nav class="border-t border-gray-200" role="navigation" aria-label="Navegación principal">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <!-- Desktop Navigation -->
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
                    
                    <!-- Mobile Navigation -->
                    <div class="lg:hidden flex justify-between items-center py-4">
                        <button 
                            id="mobileMenuButton" 
                            class="p-2 rounded-md text-gray-700 hover:text-red-500 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-inset"
                            aria-expanded="false"
                            aria-controls="mobile-menu"
                            aria-label="Abrir menú de navegación">
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                            </svg>
                        </button>
                        
                        <a href="{{ url('/contacto') }}" 
                           class="inline-flex items-center px-4 py-2 bg-red-500 text-white text-sm font-medium rounded-md hover:bg-red-600 transition-colors duration-300">
                            <i class="fas fa-calendar-check mr-2" aria-hidden="true"></i>
                            Cita
                        </a>
                    </div>
                </div>
            </nav>
        </div>
    </header>

    <!-- Header Compacto para Scroll -->
    <header id="headerCompact" class="header-compact" style="display: none;">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center py-3">
                <!-- Logo Compacto -->
                <div class="clinic-logo">
                    <h1>CLÍNICA</h1>
                    <h2>GRUPO ROMERO</h2>
                    <p>OPTOMETRICA & OPTICAS</p>
                </div>
                
                <!-- Navigation Compacta -->
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
                
                <!-- Mobile Menu Button Compact -->
                <div class="lg:hidden">
                    <button 
                        id="mobileMenuButtonCompact" 
                        class="p-2 rounded-md text-gray-700 hover:text-red-500 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-inset"
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

    <!-- Mobile Menu Overlay -->
    <div id="mobile-menu-overlay" class="mobile-menu-overlay"></div>
    
    <!-- Mobile Menu -->
    <div id="mobile-menu" class="mobile-menu" aria-hidden="true">
        <div class="flex flex-col h-full">
            <!-- Mobile Header -->
            <div class="flex items-center justify-between p-4 border-b border-gray-200">
                <div class="clinic-logo">
                    <h3 class="text-lg font-bold text-gray-800">CLÍNICA</h3>
                    <h4 class="text-lg font-bold text-red-500 -mt-1">GRUPO ROMERO</h4>
                </div>
                <button 
                    id="closeMobileMenu" 
                    class="p-2 rounded-md text-gray-700 hover:text-red-500 focus:outline-none focus:ring-2 focus:ring-red-500"
                    aria-label="Cerrar menú">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
            
            <!-- Mobile Navigation Links -->
            <nav class="flex-1 px-4 py-6 space-y-1 overflow-y-auto" role="navigation" aria-label="Navegación móvil">
                <a href="{{ url('/') }}" 
                   class="block px-3 py-3 text-base font-medium {{ request()->is('/') ? 'text-red-500 bg-red-50' : 'text-gray-700 hover:text-red-500 hover:bg-gray-50' }} rounded-md transition-colors duration-300">
                    Inicio
                </a>
                <a href="{{ url('/catalogo') }}" 
                   class="block px-3 py-3 text-base font-medium {{ request()->is('catalogo*') ? 'text-red-500 bg-red-50' : 'text-gray-700 hover:text-red-500 hover:bg-gray-50' }} rounded-md transition-colors duration-300">
                    Catálogo
                </a>
                <a href="{{ url('/servicios') }}" 
                   class="block px-3 py-3 text-base font-medium {{ request()->is('servicios*') ? 'text-red-500 bg-red-50' : 'text-gray-700 hover:text-red-500 hover:bg-gray-50' }} rounded-md transition-colors duration-300">
                    Servicios
                </a>
                <a href="{{ url('/blogs') }}" 
                   class="block px-3 py-3 text-base font-medium {{ request()->is('blogs*') ? 'text-red-500 bg-red-50' : 'text-gray-700 hover:text-red-500 hover:bg-gray-50' }} rounded-md transition-colors duration-300">
                    Blogs
                </a>
                <a href="{{ url('/contacto') }}" 
                   class="block px-3 py-3 text-base font-medium {{ request()->is('contacto*') ? 'text-red-500 bg-red-50' : 'text-gray-700 hover:text-red-500 hover:bg-gray-50' }} rounded-md transition-colors duration-300">
                    Contacto
                </a>
            </nav>
            
            <!-- Mobile Footer -->
            <div class="border-t border-gray-200 p-4">
                <a href="{{ url('/contacto') }}" 
                   class="block w-full text-center px-4 py-3 bg-red-500 text-white font-medium rounded-md hover:bg-red-600 transition-colors duration-300">
                    <i class="fas fa-calendar-check mr-2" aria-hidden="true"></i>
                    Reservar Cita
                </a>
                
                <!-- Contact info in mobile -->
                <div class="mt-4 space-y-3">
                    <a href="tel:+51923323517" class="flex items-center text-gray-600 hover:text-red-500 transition-colors">
                        <i class="fas fa-phone mr-3 text-red-500"></i>
                        <span>923 323 517</span>
                    </a>
                    <a href="mailto:clinicagrc@gmail.com" class="flex items-center text-gray-600 hover:text-red-500 transition-colors">
                        <i class="fas fa-envelope mr-3 text-red-500"></i>
                        <span>clinicagrc@gmail.com</span>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- WhatsApp Floating Button -->
    <div class="whatsapp-container" id="whatsappContainer">
        <div class="whatsapp-message">
            <strong>¡Hola!</strong> ¿En qué podemos ayudarte?
        </div>
        <a href="https://wa.me/51923323517?text=Hola%20GRC%20Clínica%20Optométrica,%20me%20gustaría%20realizar%20una%20consulta%20sobre%20sus%20servicios" 
           target="_blank" 
           class="whatsapp-button"
           id="whatsappButton"
           aria-label="Contactar por WhatsApp">
            <i class="fab fa-whatsapp"></i>
            <span class="whatsapp-notification"></span>
        </a>
    </div>

    <!-- Scroll to Top Button -->
    <button class="scroll-top" id="scrollTop">
        <i class="fas fa-arrow-up text-white"></i>
    </button>

    <!-- Main Content -->
    <main class="relative">
        @yield('content')
    </main>

    <!-- Footer Rediseñado -->
    <footer class="bg-white py-20 lg:py-24 relative overflow-hidden border-t border-gray-100">
        
        {{-- Elementos decorativos de fondo --}}
        <div class="absolute top-0 left-0 w-96 h-96 bg-red-50 rounded-full blur-3xl opacity-50 -translate-x-1/2 -translate-y-1/2"></div>
        <div class="absolute bottom-0 right-0 w-96 h-96 bg-blue-50 rounded-full blur-3xl opacity-50 translate-x-1/2 translate-y-1/2"></div>
        <div class="absolute top-1/2 left-1/2 w-64 h-64 bg-gray-50 rounded-full blur-2xl opacity-30 transform -translate-x-1/2 -translate-y-1/2"></div>
        
        {{-- Patrón de formas geométricas sutiles --}}
        <div class="absolute inset-0 opacity-5">
            <div class="absolute top-32 right-64 w-3 h-3 bg-red-400 rounded-full"></div>
            <div class="absolute top-48 right-32 w-2 h-2 bg-blue-400 rounded-full"></div>
            <div class="absolute bottom-48 left-32 w-4 h-4 bg-red-300 rounded-full"></div>
            <div class="absolute bottom-32 left-64 w-2 h-2 bg-blue-300 rounded-full"></div>
        </div>
        
        <div class="w-full px-4 sm:px-6 lg:px-8 relative z-10">
            
            {{-- Grid principal de enlaces --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 lg:gap-16">
                
                {{-- Servicios --}}
                <div class="footer-section">
                    <h3 class="text-lg font-bold text-gray-900 mb-8 uppercase tracking-wider relative">
                        Servicios
                        <div class="absolute -bottom-2 left-0 w-12 h-0.5 bg-red-500"></div>
                    </h3>
                    <ul class="space-y-4">
                        <li><a href="/servicios" class="footer-link group flex items-center text-gray-600 hover:text-red-600 font-medium transition-all duration-300">
                            <div class="w-2 h-2 bg-red-200 rounded-full mr-3 group-hover:bg-red-500 transition-colors duration-300"></div>
                            Medida de Vista
                        </a></li>
                        <li><a href="/servicios" class="footer-link group flex items-center text-gray-600 hover:text-red-600 font-medium transition-all duration-300">
                            <div class="w-2 h-2 bg-red-200 rounded-full mr-3 group-hover:bg-red-500 transition-colors duration-300"></div>
                            Examen Visual Completo
                        </a></li>
                        <li><a href="/servicios" class="footer-link group flex items-center text-gray-600 hover:text-red-600 font-medium transition-all duration-300">
                            <div class="w-2 h-2 bg-red-200 rounded-full mr-3 group-hover:bg-red-500 transition-colors duration-300"></div>
                            Descarte de Enfermedades
                        </a></li>
                        <li><a href="/servicios" class="footer-link group flex items-center text-gray-600 hover:text-red-600 font-medium transition-all duration-300">
                            <div class="w-2 h-2 bg-red-200 rounded-full mr-3 group-hover:bg-red-500 transition-colors duration-300"></div>
                            Asesoría de Imagen
                        </a></li>
                        <li><a href="/servicios" class="footer-link group flex items-center text-gray-600 hover:text-red-600 font-medium transition-all duration-300">
                            <div class="w-2 h-2 bg-red-200 rounded-full mr-3 group-hover:bg-red-500 transition-colors duration-300"></div>
                            Mantenimiento de Monturas
                        </a></li>
                        <li><a href="/servicios" class="footer-link group flex items-center text-gray-600 hover:text-red-600 font-medium transition-all duration-300">
                            <div class="w-2 h-2 bg-red-200 rounded-full mr-3 group-hover:bg-red-500 transition-colors duration-300"></div>
                            Adaptación de Lentes
                        </a></li>
                    </ul>
                </div>
                
                {{-- Productos --}}
                <div class="footer-section">
                    <h3 class="text-lg font-bold text-gray-900 mb-8 uppercase tracking-wider relative">
                        Productos
                        <div class="absolute -bottom-2 left-0 w-12 h-0.5 bg-blue-500"></div>
                    </h3>
                    <ul class="space-y-4">
                        <li><a href="/catalogo?page=1&marca=ferretti" class="footer-link group flex items-center text-gray-600 hover:text-blue-600 font-medium transition-all duration-300">
                            <div class="w-2 h-2 bg-blue-200 rounded-full mr-3 group-hover:bg-blue-500 transition-colors duration-300"></div>
                            Monturas Premium
                        </a></li>
                        <li><a href="/catalogo?page=1&genero=mujer" class="footer-link group flex items-center text-gray-600 hover:text-blue-600 font-medium transition-all duration-300">
                            <div class="w-2 h-2 bg-blue-200 rounded-full mr-3 group-hover:bg-blue-500 transition-colors duration-300"></div>
                            Para Mujeres
                        </a></li>
                        <li><a href="/catalogo?page=1&genero=hombre" class="footer-link group flex items-center text-gray-600 hover:text-blue-600 font-medium transition-all duration-300">
                            <div class="w-2 h-2 bg-blue-200 rounded-full mr-3 group-hover:bg-blue-500 transition-colors duration-300"></div>
                            Para Hombres
                        </a></li>
                        <li><a href="/catalogo?is_new=1&page=1" class="footer-link group flex items-center text-gray-600 hover:text-blue-600 font-medium transition-all duration-300">
                            <div class="w-2 h-2 bg-blue-200 rounded-full mr-3 group-hover:bg-blue-500 transition-colors duration-300"></div>
                            Nuevas Colecciones
                        </a></li>
                        <li><a href="/catalogo" class="footer-link group flex items-center text-gray-600 hover:text-blue-600 font-medium transition-all duration-300">
                            <div class="w-2 h-2 bg-blue-200 rounded-full mr-3 group-hover:bg-blue-500 transition-colors duration-300"></div>
                            Lentes de Sol
                        </a></li>
                        <li><a href="/catalogo" class="footer-link group flex items-center text-gray-600 hover:text-blue-600 font-medium transition-all duration-300">
                            <div class="w-2 h-2 bg-blue-200 rounded-full mr-3 group-hover:bg-blue-500 transition-colors duration-300"></div>
                            Accesorios
                        </a></li>
                    </ul>
                </div>
                
                {{-- Información --}}
                <div class="footer-section">
                    <h3 class="text-lg font-bold text-gray-900 mb-8 uppercase tracking-wider relative">
                        Información
                        <div class="absolute -bottom-2 left-0 w-12 h-0.5 bg-red-500"></div>
                    </h3>
                    <ul class="space-y-4">
                        <li><a href="/nosotros" class="footer-link group flex items-center text-gray-600 hover:text-red-600 font-medium transition-all duration-300">
                            <div class="w-2 h-2 bg-red-200 rounded-full mr-3 group-hover:bg-red-500 transition-colors duration-300"></div>
                            Sobre Nosotros
                        </a></li>
                        <li><a href="/especialistas" class="footer-link group flex items-center text-gray-600 hover:text-red-600 font-medium transition-all duration-300">
                            <div class="w-2 h-2 bg-red-200 rounded-full mr-3 group-hover:bg-red-500 transition-colors duration-300"></div>
                            Nuestro Equipo
                        </a></li>
                        <li><a href="/blogs" class="footer-link group flex items-center text-gray-600 hover:text-red-600 font-medium transition-all duration-300">
                            <div class="w-2 h-2 bg-red-200 rounded-full mr-3 group-hover:bg-red-500 transition-colors duration-300"></div>
                            Blog de Salud Visual
                        </a></li>
                        <li><a href="/contacto" class="footer-link group flex items-center text-gray-600 hover:text-red-600 font-medium transition-all duration-300">
                            <div class="w-2 h-2 bg-red-200 rounded-full mr-3 group-hover:bg-red-500 transition-colors duration-300"></div>
                            Preguntas Frecuentes
                        </a></li>
                        <li><a href="/contacto" class="footer-link group flex items-center text-gray-600 hover:text-red-600 font-medium transition-all duration-300">
                            <div class="w-2 h-2 bg-red-200 rounded-full mr-3 group-hover:bg-red-500 transition-colors duration-300"></div>
                            Términos y Condiciones
                        </a></li>
                        <li><a href="/contacto" class="footer-link group flex items-center text-gray-600 hover:text-red-600 font-medium transition-all duration-300">
                            <div class="w-2 h-2 bg-red-200 rounded-full mr-3 group-hover:bg-red-500 transition-colors duration-300"></div>
                            Política de Privacidad
                        </a></li>
                    </ul>
                </div>
                
                {{-- Contacto Rápido --}}
                <div class="footer-section">
                    <h3 class="text-lg font-bold text-gray-900 mb-8 uppercase tracking-wider relative">
                        Contacto Rápido
                        <div class="absolute -bottom-2 left-0 w-12 h-0.5 bg-blue-500"></div>
                    </h3>
                    <ul class="space-y-6">
                        <li>
                            <a href="https://maps.app.goo.gl/TRibRft4VDC53A8V6" 
                               target="_blank"
                               class="flex items-start group hover:bg-blue-50 p-3 rounded-xl transition-all duration-300">
                                <div class="flex-shrink-0 w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center mr-3 group-hover:bg-blue-500 transition-colors duration-300">
                                    <svg class="w-5 h-5 text-blue-600 group-hover:text-white transition-colors duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <span class="footer-link text-gray-600 group-hover:text-blue-600 font-medium transition-colors duration-300">
                                        Av. 9 de Diciembre 580<br>
                                        Huancayo, Junín
                                    </span>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="tel:+51923323517" class="flex items-center group hover:bg-red-50 p-3 rounded-xl transition-all duration-300">
                                <div class="flex-shrink-0 w-10 h-10 bg-red-100 rounded-lg flex items-center justify-center mr-3 group-hover:bg-red-500 transition-colors duration-300">
                                    <svg class="w-5 h-5 text-red-600 group-hover:text-white transition-colors duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                    </svg>
                                </div>
                                <span class="footer-link text-gray-600 group-hover:text-red-600 font-medium transition-colors duration-300">923 323 517</span>
                            </a>
                        </li>
                        <li>
                            <a href="https://wa.me/51923323517?text=Hola%20GRC%20Clínica%20Optométrica" 
                               target="_blank"
                               class="flex items-center group hover:bg-green-50 p-3 rounded-xl transition-all duration-300">
                                <div class="flex-shrink-0 w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center mr-3 group-hover:bg-green-500 transition-colors duration-300">
                                    <svg class="w-5 h-5 text-green-600 group-hover:text-white transition-colors duration-300" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893A11.821 11.821 0 0020.885 3.109"/>
                                    </svg>
                                </div>
                                <span class="footer-link text-gray-600 group-hover:text-green-600 font-medium transition-colors duration-300">WhatsApp</span>
                            </a>
                        </li>
                        <li>
                            <a href="mailto:clinicagrc@gmail.com" class="flex items-center group hover:bg-blue-50 p-3 rounded-xl transition-all duration-300">
                                <div class="flex-shrink-0 w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center mr-3 group-hover:bg-blue-500 transition-colors duration-300">
                                    <svg class="w-5 h-5 text-blue-600 group-hover:text-white transition-colors duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 7.89a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                                <span class="footer-link text-gray-600 group-hover:text-blue-600 font-medium transition-colors duration-300">clinicagrc@gmail.com</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            
            {{-- Separador elegante --}}
            <div class="my-16 flex items-center">
                <div class="flex-1 h-px bg-red-200"></div>
                <div class="mx-4 w-3 h-3 bg-red-500 rounded-full"></div>
                <div class="flex-1 h-px bg-blue-200"></div>
                <div class="mx-4 w-3 h-3 bg-blue-500 rounded-full"></div>
                <div class="flex-1 h-px bg-red-200"></div>
            </div>
            
            {{-- Horario y Newsletter --}}
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                
                {{-- Horario --}}
                <div class="footer-schedule">
                    <h3 class="text-lg font-bold text-gray-900 mb-6 uppercase tracking-wider">Horario de Atención</h3>
                    <div class="bg-gray-50 border-l-4 border-red-500 rounded-2xl p-6 hover:bg-red-50 transition-colors duration-300 group">
                        <div class="flex items-center space-x-4">
                            <div class="flex-shrink-0">
                                <div class="w-14 h-14 bg-white rounded-xl flex items-center justify-center shadow-lg group-hover:shadow-xl transition-shadow duration-300 border-2 border-red-100">
                                    <svg class="w-7 h-7 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                            </div>
                            <div>
                                <p class="font-bold text-gray-900 text-lg">Lunes a Domingo</p>
                                <p class="text-blue-600 font-semibold">9:00 AM - 7:00 PM</p>
                                <p class="text-gray-500 text-sm mt-1">Atención continua</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                {{-- Newsletter --}}
                <div class="footer-newsletter">
                    <h3 class="text-lg font-bold text-gray-900 mb-6 uppercase tracking-wider">Suscríbete a nuestro Newsletter</h3>
                    <p class="text-gray-600 mb-4">Recibe ofertas exclusivas y consejos de salud visual</p>
                    <form class="flex flex-col sm:flex-row gap-3" onsubmit="handleNewsletterSubmit(event)">
                        <div class="flex-1 relative">
                            <input type="email" 
                                   name="email"
                                   placeholder="Tu correo electrónico" 
                                   required
                                   class="w-full px-5 py-3 rounded-xl border-2 border-gray-200 focus:border-blue-500 focus:ring-4 focus:ring-blue-100 transition-all duration-300 pr-10">
                            <svg class="absolute right-3 top-1/2 transform -translate-y-1/2 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 7.89a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        <button type="submit" 
                                class="px-8 py-3 bg-red-600 hover:bg-red-700 text-white font-bold rounded-xl hover:shadow-xl transform hover:scale-105 transition-all duration-300 border-2 border-red-700 relative overflow-hidden group">
                            <span class="relative z-10">Suscribir</span>
                            <div class="absolute bottom-0 left-0 w-full h-1 bg-blue-500"></div>
                        </button>
                    </form>
                </div>
            </div>
        </div>
        
        {{-- Bottom Footer --}}
        <div class="border-t-2 border-gray-100 mt-16">
            <div class="w-full px-4 sm:px-6 lg:px-8 py-12">
                <div class="flex flex-col lg:flex-row items-center justify-between space-y-8 lg:space-y-0">
                    
                    {{-- Redes Sociales --}}
                    <div class="flex items-center space-x-6">
                        <span class="text-sm text-gray-500 font-medium mr-4">Síguenos:</span>
                        <a href="https://www.facebook.com/opticasgrckids" 
                           target="_blank"
                           class="footer-social w-12 h-12 bg-blue-100 hover:bg-blue-600 text-blue-600 hover:text-white rounded-xl flex items-center justify-center transition-all duration-300 transform hover:scale-110 shadow-lg hover:shadow-xl">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                            </svg>
                        </a>
                        <a href="#" 
                           class="footer-social w-12 h-12 bg-red-100 hover:bg-red-600 text-red-600 hover:text-white rounded-xl flex items-center justify-center transition-all duration-300 transform hover:scale-110 shadow-lg hover:shadow-xl">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12.017 0C5.396 0 .029 5.367.029 11.987c0 5.079 3.158 9.417 7.618 11.174-.105-.949-.199-2.403.041-3.439.219-.937 1.406-5.957 1.406-5.957s-.359-.72-.359-1.781c0-1.663.967-2.911 2.168-2.911 1.024 0 1.518.769 1.518 1.688 0 1.029-.653 2.567-.992 3.992-.285 1.193.6 2.165 1.775 2.165 2.128 0 3.768-2.245 3.768-5.487 0-2.861-2.063-4.869-5.008-4.869-3.41 0-5.409 2.562-5.409 5.199 0 1.033.394 2.143.889 2.741.099.12.112.225.085.345-.09.375-.293 1.199-.334 1.363-.053.225-.172.271-.402.165-1.495-.69-2.433-2.878-2.433-4.646 0-3.776 2.748-7.252 7.92-7.252 4.158 0 7.392 2.967 7.392 6.923 0 4.135-2.607 7.462-6.233 7.462-1.214 0-2.357-.629-2.748-1.378l-.748 2.853c-.271 1.043-1.002 2.35-1.492 3.146C9.57 23.812 10.763 24.009 12.017 24.009c6.624 0 11.99-5.367 11.99-11.988C24.007 5.367 18.641.001.012.001z"/>
                            </svg>
                        </a>
                        <a href="https://wa.me/51923323517" 
                           target="_blank"
                           class="footer-social w-12 h-12 bg-green-100 hover:bg-green-600 text-green-600 hover:text-white rounded-xl flex items-center justify-center transition-all duration-300 transform hover:scale-110 shadow-lg hover:shadow-xl">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893A11.821 11.821 0 0020.885 3.109"/>
                            </svg>
                        </a>
                        <a href="#" 
                           class="footer-social w-12 h-12 bg-red-100 hover:bg-red-600 text-red-600 hover:text-white rounded-xl flex items-center justify-center transition-all duration-300 transform hover:scale-110 shadow-lg hover:shadow-xl">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/>
                            </svg>
                        </a>
                    </div>
                    
                    {{-- Métodos de pago --}}
                    <div class="flex items-center space-x-4">
                        <span class="text-sm text-gray-500 font-medium mr-2">Aceptamos:</span>
                        <div class="flex items-center space-x-3">
                            <div class="w-12 h-8 bg-blue-600 rounded-lg flex items-center justify-center">
                                <svg class="w-8 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M15.27 0H4.73C2.122 0 0 2.122 0 4.73v14.54C0 21.878 2.122 24 4.73 24h10.54c2.608 0 4.73-2.122 4.73-4.73V4.73C24 2.122 21.878 0 19.27 0z"/>
                                    <path d="M7.333 6.667h9.334v2.666H7.333zm0 4h9.334v2.666H7.333zm0 4h6v2.666h-6z" fill="#FFF"/>
                                </svg>
                            </div>
                            <div class="w-12 h-8 bg-red-600 rounded-lg flex items-center justify-center">
                                <svg class="w-8 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                                    <circle cx="8" cy="12" r="6"/>
                                    <circle cx="16" cy="12" r="6"/>
                                </svg>
                            </div>
                            <div class="w-12 h-8 bg-blue-500 rounded-lg flex items-center justify-center">
                                <span class="text-white font-bold text-xs">AE</span>
                            </div>
                            <div class="w-12 h-8 bg-green-600 rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-4 text-white" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 0C5.373 0 0 5.373 0 12s5.373 12 12 12 12-5.373 12-12S18.627 0 12 0zm0 22C6.486 22 2 17.514 2 12S6.486 2 12 2s10 4.486 10 10-4.486 10-10 10z"/>
                                    <path d="M12 6v6l4 4"/>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
                
                {{-- Derechos de autor --}}
                <div class="mt-12 pt-8 border-t border-gray-200 text-center">
                    <div class="flex flex-col md:flex-row items-center justify-center space-y-4 md:space-y-0 md:space-x-8">
                        <p class="text-sm text-gray-500 font-medium">
                            &copy; {{ date('Y') }} GRC Clínica Optométrica. Todos los derechos reservados.
                        </p>
                        <p class="text-sm text-gray-500 font-medium flex items-center">
                            Desarrollado con 
                            <svg class="w-4 h-4 text-red-500 mx-1" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                            </svg>
                            en Huancayo, Perú
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- Scripts del Header y Footer -->
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
                
                // Update aria states
                mobileMenuButton.setAttribute('aria-expanded', 'true');
                if (mobileMenuButtonCompact) {
                    mobileMenuButtonCompact.setAttribute('aria-expanded', 'true');
                }
                mobileMenu.setAttribute('aria-hidden', 'false');
                
                // Focus management
                const firstLink = mobileMenu.querySelector('a');
                if (firstLink) {
                    setTimeout(() => firstLink.focus(), 100);
                }
            }
            
            function closeMobileMenuFunc() {
                mobileMenu.classList.remove('active');
                mobileMenuOverlay.classList.remove('active');
                document.body.style.overflow = '';
                
                // Update aria states
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
            
            // Close mobile menu on escape key
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

            // Show message after 3 seconds
            setTimeout(() => {
                if (!hasInteracted) {
                    whatsappContainer.classList.add('show-message');
                    
                    messageTimeout = setTimeout(() => {
                        whatsappContainer.classList.remove('show-message');
                    }, 5000);
                }
            }, 3000);

            // Show message on hover
            whatsappButton.addEventListener('mouseenter', () => {
                clearTimeout(messageTimeout);
                whatsappContainer.classList.add('show-message');
            });

            whatsappButton.addEventListener('mouseleave', () => {
                messageTimeout = setTimeout(() => {
                    whatsappContainer.classList.remove('show-message');
                }, 2000);
            });

            // Hide notification dot after first interaction
            whatsappButton.addEventListener('click', () => {
                hasInteracted = true;
                const notification = whatsappButton.querySelector('.whatsapp-notification');
                if (notification) {
                    notification.style.display = 'none';
                }
            });

            // ===== FOOTER FUNCTIONALITY =====
            // Manejar suscripción al newsletter
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
                
                // Simular envío
                button.disabled = true;
                button.querySelector('span').textContent = 'Enviando...';
                button.classList.add('opacity-75');
                
                setTimeout(() => {
                    button.querySelector('span').textContent = '¡Suscrito!';
                    button.classList.remove('bg-red-600', 'hover:bg-red-700');
                    button.classList.add('bg-green-600');
                    
                    setTimeout(() => {
                        button.disabled = false;
                        button.querySelector('span').textContent = originalText;
                        button.classList.remove('opacity-75', 'bg-green-600');
                        button.classList.add('bg-red-600', 'hover:bg-red-700');
                        form.reset();
                    }, 2000);
                }, 1500);
            };
            
            // Intersection Observer para animaciones del footer
            const observerOptions = {
                threshold: 0.1,
                rootMargin: '0px 0px -50px 0px'
            };

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.style.opacity = '1';
                        entry.target.style.transform = 'translateY(0)';
                    }
                });
            }, observerOptions);

            // Observar secciones del footer
            const footerSections = document.querySelectorAll('.footer-section');
            footerSections.forEach(section => {
                observer.observe(section);
            });

            console.log('🎉 Layout completo inicializado correctamente');
        });

        // ===== GLOBAL FUNCTIONS =====
        window.scrollToSection = function(sectionId) {
            const section = document.getElementById(sectionId);
            if (section) {
                section.scrollIntoView({ behavior: 'smooth' });
            }
        };
    </script>
    
    @yield('scripts')
</body>
</html>