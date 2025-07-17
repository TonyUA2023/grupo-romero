<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Grupo Romero - Clínica Optométrica')</title>
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@200;300;400;500;600;700&family=Playfair+Display:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        body {
            font-family: 'Inter', sans-serif;
            font-weight: 300;
            letter-spacing: 0.025em;
        }
        h1, h2, h3, h4, h5, h6 {
            font-family: 'Playfair Display', serif;
            font-weight: 400;
        }
        .nav-link {
            position: relative;
            padding: 0.75rem 0;
            font-weight: 300;
            letter-spacing: 0.05em;
            transition: all 0.3s ease;
        }
        .nav-link::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            width: 0;
            height: 1px;
            background-color: #000;
            transition: all 0.3s ease;
            transform: translateX(-50%);
        }
        .nav-link:hover::after {
            width: 100%;
        }
        .mobile-menu {
            transform: translateX(100%);
            transition: transform 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        }
        .mobile-menu.active {
            transform: translateX(0);
        }
        .divider {
            height: 1px;
            background: linear-gradient(to right, transparent, #e5e7eb, transparent);
        }
        .logo {
            font-family: 'Playfair Display', serif;
            font-weight: 600;
            letter-spacing: 0.1em;
        }
        .section-divider {
            width: 100%;
            height: 1px;
            background: linear-gradient(90deg, transparent 0%, #d1d5db 50%, transparent 100%);
        }
    </style>
</head>
<body class="bg-white text-gray-900 antialiased overflow-x-hidden">
    <!-- Header -->
    <header class="bg-white border-b border-gray-100 sticky top-0 z-50 backdrop-blur-sm bg-white/95">
        <div class="max-w-9xl mx-auto px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <!-- Logo -->
                <div class="flex items-center">
                    <a href="{{ url('/') }}" class="logo text-2xl text-black tracking-wider">
                        GRUPO ROMERO
                    </a>
                </div>
                
                <!-- Desktop Navigation -->
                <nav class="hidden lg:flex items-center space-x-12">
                    @foreach ($navigationPages as $page)
                        <a href="{{ url($page->slug) }}" class="nav-link text-gray-700 hover:text-black text-sm uppercase {{ request()->is($page->slug) ? 'font-bold' : '' }}">
                            {{ $page->title }}
                        </a>
                    @endforeach
                </nav>
                
                <!-- Right side -->
                <div class="hidden lg:flex items-center space-x-6">
                    <button class="p-2 text-gray-600 hover:text-black transition-colors duration-300">
                        <i class="fas fa-search text-sm"></i>
                    </button>
                    <button class="p-2 text-gray-600 hover:text-black transition-colors duration-300">
                        <i class="fas fa-heart text-sm"></i>
                    </button>
                    <button class="p-2 text-gray-600 hover:text-black transition-colors duration-300">
                        <i class="fas fa-shopping-bag text-sm"></i>
                    </button>
                    <div class="w-px h-6 bg-gray-200"></div>
                    <a href="#" class="bg-black text-white px-6 py-2.5 text-sm font-light tracking-wider uppercase hover:bg-gray-800 transition-colors duration-300">
                        Reservar Cita
                    </a>
                </div>
                
                <!-- Mobile menu button -->
                <button class="lg:hidden p-2 text-gray-600 hover:text-black transition-colors duration-300" onclick="toggleMobileMenu()">
                    <i class="fas fa-bars text-lg"></i>
                </button>
            </div>
        </div>
    </header>

    <!-- Mobile Menu -->
    <div id="mobile-menu" class="mobile-menu fixed inset-y-0 right-0 w-full bg-white z-50 lg:hidden">
        <div class="flex flex-col h-full">
            <div class="flex items-center justify-between p-6 border-b border-gray-100">
                <span class="logo text-xl text-black tracking-wider">GRUPO ROMERO</span>
                <button onclick="toggleMobileMenu()" class="p-2 text-gray-600 hover:text-black transition-colors duration-300">
                    <i class="fas fa-times text-lg"></i>
                </button>
            </div>
            
            <nav class="flex-1 px-6 py-12 space-y-8">
                @foreach ($navigationPages as $page)
                    <a href="{{ url($page->slug) }}" class="block py-4 text-gray-700 hover:text-black font-light text-lg uppercase tracking-wider border-b border-gray-50 transition-colors duration-300">
                        {{ $page->title }}
                    </a>
                @endforeach
            </nav>
            
            <div class="p-6 border-t border-gray-100">
                <a href="#" class="block w-full bg-black text-white text-center py-4 text-sm font-light tracking-wider uppercase hover:bg-gray-800 transition-colors duration-300">
                    Reservar Cita
                </a>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <main class="min-h-screen">
        @yield('content')
    </main>

    <!-- Section Divider -->
    <div class="section-divider"></div>

    <!-- Newsletter Section -->
    <section class="bg-gray-50 py-24">
        <div class="max-w-4xl mx-auto px-6 lg:px-8 text-center">
            <h2 class="text-3xl lg:text-4xl font-light text-gray-900 mb-6">Mantente Conectado</h2>
            <p class="text-gray-600 mb-12 max-w-2xl mx-auto leading-relaxed">
                Recibe las últimas novedades sobre nuestros productos, consejos de salud visual y ofertas exclusivas.
            </p>
            
            <form class="flex max-w-md mx-auto">
                <input 
                    type="email" 
                    placeholder="Ingresa tu email" 
                    class="flex-1 px-4 py-3 bg-white border border-gray-200 focus:outline-none focus:border-gray-400 transition-colors duration-300 text-sm font-light"
                >
                <button 
                    type="submit" 
                    class="bg-black text-white px-8 py-3 hover:bg-gray-800 transition-colors duration-300 text-sm font-light tracking-wider uppercase"
                >
                    Suscribirse
                </button>
            </form>
        </div>
    </section>

    <!-- Section Divider -->
    <div class="section-divider"></div>

    <!-- Footer -->
    <footer class="bg-white py-20">
        <div class="max-w-9xl mx-auto px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 lg:gap-16">
                <!-- Productos -->
                <div>
                    <h3 class="text-lg font-light text-gray-900 mb-8 uppercase tracking-wider">Productos</h3>
                    <ul class="space-y-4">
                        <li><a href="#" class="text-gray-600 hover:text-black transition-colors duration-300 font-light">Lentes de Vista</a></li>
                        <li><a href="#" class="text-gray-600 hover:text-black transition-colors duration-300 font-light">Lentes de Sol</a></li>
                        <li><a href="#" class="text-gray-600 hover:text-black transition-colors duration-300 font-light">Lentes de Contacto</a></li>
                        <li><a href="#" class="text-gray-600 hover:text-black transition-colors duration-300 font-light">Accesorios</a></li>
                        <li><a href="#" class="text-gray-600 hover:text-black transition-colors duration-300 font-light">Nuevas Colecciones</a></li>
                    </ul>
                </div>
                
                <!-- Servicios -->
                <div>
                    <h3 class="text-lg font-light text-gray-900 mb-8 uppercase tracking-wider">Servicios</h3>
                    <ul class="space-y-4">
                        <li><a href="#" class="text-gray-600 hover:text-black transition-colors duration-300 font-light">Test de Estilo</a></li>
                        <li><a href="#" class="text-gray-600 hover:text-black transition-colors duration-300 font-light">Prueba Virtual</a></li>
                        <li><a href="#" class="text-gray-600 hover:text-black transition-colors duration-300 font-light">Exámenes de Vista</a></li>
                        <li><a href="#" class="text-gray-600 hover:text-black transition-colors duration-300 font-light">Renovación de Receta</a></li>
                    </ul>
                </div>
                
                <!-- Información -->
                <div>
                    <h3 class="text-lg font-light text-gray-900 mb-8 uppercase tracking-wider">Información</h3>
                    <ul class="space-y-4">
                        <li><a href="#" class="text-gray-600 hover:text-black transition-colors duration-300 font-light">Seguros Médicos</a></li>
                        <li><a href="#" class="text-gray-600 hover:text-black transition-colors duration-300 font-light">Promociones</a></li>
                        <li><a href="#" class="text-gray-600 hover:text-black transition-colors duration-300 font-light">Garantías</a></li>
                        <li><a href="#" class="text-gray-600 hover:text-black transition-colors duration-300 font-light">Cuidado de Lentes</a></li>
                    </ul>
                </div>
                
                <!-- Empresa -->
                <div>
                    <h3 class="text-lg font-light text-gray-900 mb-8 uppercase tracking-wider">Empresa</h3>
                    <ul class="space-y-4">
                        <li><a href="#" class="text-gray-600 hover:text-black transition-colors duration-300 font-light">Nuestra Historia</a></li>
                        <li><a href="#" class="text-gray-600 hover:text-black transition-colors duration-300 font-light">Responsabilidad Social</a></li>
                        <li><a href="#" class="text-gray-600 hover:text-black transition-colors duration-300 font-light">Testimonios</a></li>
                        <li><a href="#" class="text-gray-600 hover:text-black transition-colors duration-300 font-light">Trabaja con Nosotros</a></li>
                    </ul>
                </div>
            </div>
            
            <!-- Section Divider -->
            <div class="section-divider my-16"></div>
            
            <!-- Servicios Profesionales -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-12 lg:gap-16 mb-16">
                <div>
                    <h3 class="text-lg font-light text-gray-900 mb-8 uppercase tracking-wider">Servicios Profesionales</h3>
                    <ul class="space-y-4">
                        <li><a href="#" class="text-gray-600 hover:text-black transition-colors duration-300 font-light">Reservar Examen de Vista</a></li>
                        <li><a href="#" class="text-gray-600 hover:text-black transition-colors duration-300 font-light">Consulta Especializada</a></li>
                        <li><a href="#" class="text-gray-600 hover:text-black transition-colors duration-300 font-light">Medición de Distancia Pupilar</a></li>
                    </ul>
                </div>
                
                <div>
                    <h3 class="text-lg font-light text-gray-900 mb-8 uppercase tracking-wider">Ubicación</h3>
                    <ul class="space-y-4">
                        <li><a href="#" class="text-gray-600 hover:text-black transition-colors duration-300 font-light">Nuestra Clínica en Huancayo</a></li>
                        <li><a href="#" class="text-gray-600 hover:text-black transition-colors duration-300 font-light">Cómo Llegar</a></li>
                        <li><a href="#" class="text-gray-600 hover:text-black transition-colors duration-300 font-light">Horarios de Atención</a></li>
                    </ul>
                </div>
            </div>
            
            <!-- Section Divider -->
            <div class="section-divider mb-16"></div>
            
            <!-- Educación -->
            <div class="mb-16">
                <h3 class="text-lg font-light text-gray-900 mb-8 uppercase tracking-wider">Educación</h3>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                    <a href="#" class="text-gray-600 hover:text-black transition-colors duration-300 font-light">Guía de Lentes</a>
                    <a href="#" class="text-gray-600 hover:text-black transition-colors duration-300 font-light">Protección Solar</a>
                    <a href="#" class="text-gray-600 hover:text-black transition-colors duration-300 font-light">Salud Visual</a>
                    <a href="#" class="text-gray-600 hover:text-black transition-colors duration-300 font-light">Tecnología Óptica</a>
                </div>
            </div>
        </div>
        
        <!-- Bottom Footer -->
        <div class="border-t border-gray-100">
            <div class="max-w-7xl mx-auto px-6 lg:px-8 py-12">
                <div class="flex flex-col lg:flex-row items-center justify-between space-y-8 lg:space-y-0">
                    <div class="flex items-center space-x-8">
                        <span class="text-sm text-gray-500 font-light">Perú</span>
                        <div class="flex space-x-6">
                            <a href="#" class="text-gray-400 hover:text-black transition-colors duration-300">
                                <i class="fab fa-facebook-f text-sm"></i>
                            </a>
                            <a href="#" class="text-gray-400 hover:text-black transition-colors duration-300">
                                <i class="fab fa-instagram text-sm"></i>
                            </a>
                            <a href="#" class="text-gray-400 hover:text-black transition-colors duration-300">
                                <i class="fab fa-youtube text-sm"></i>
                            </a>
                            <a href="#" class="text-gray-400 hover:text-black transition-colors duration-300">
                                <i class="fab fa-linkedin-in text-sm"></i>
                            </a>
                        </div>
                    </div>
                    
                    <div class="text-center lg:text-right">
                        <p class="text-sm text-gray-500 font-light mb-2">¿Necesitas ayuda?</p>
                        <p class="text-sm text-gray-500 font-light">
                            Estamos aquí para ti. Encuentra respuestas a tus preguntas 
                            <a href="#" class="text-black hover:text-gray-600 transition-colors duration-300 underline">aquí</a>.
                        </p>
                    </div>
                </div>
                
                <!-- Contact Info -->
                <div class="mt-16 pt-12 border-t border-gray-100">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-12 text-center">
                        <div class="space-y-3">
                            <div class="w-12 h-12 mx-auto bg-gray-50 rounded-full flex items-center justify-center">
                                <i class="fas fa-map-marker-alt text-gray-600 text-sm"></i>
                            </div>
                            <p class="text-gray-600 font-light">Av. Giráldez 123, Huancayo, Junín</p>
                        </div>
                        <div class="space-y-3">
                            <div class="w-12 h-12 mx-auto bg-gray-50 rounded-full flex items-center justify-center">
                                <i class="fas fa-phone text-gray-600 text-sm"></i>
                            </div>
                            <p class="text-gray-600 font-light">+51 64 123 4567</p>
                        </div>
                        <div class="space-y-3">
                            <div class="w-12 h-12 mx-auto bg-gray-50 rounded-full flex items-center justify-center">
                                <i class="fas fa-envelope text-gray-600 text-sm"></i>
                            </div>
                            <p class="text-gray-600 font-light">info@gruporomero.com</p>
                        </div>
                    </div>
                </div>
                
                <!-- Legal Links -->
                <div class="mt-16 pt-12 border-t border-gray-100 text-center">
                    <div class="flex flex-wrap justify-center space-x-8 text-sm text-gray-500 font-light mb-8">
                        <a href="#" class="hover:text-black transition-colors duration-300">Política de Privacidad</a>
                        <a href="#" class="hover:text-black transition-colors duration-300">Términos de Uso</a>
                        <a href="#" class="hover:text-black transition-colors duration-300">Accesibilidad</a>
                        <a href="#" class="hover:text-black transition-colors duration-300">Cookies</a>
                    </div>
                    <p class="text-sm text-gray-400 font-light">
                        &copy; {{ date('Y') }} Grupo Romero. Todos los derechos reservados.
                    </p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script>
        function toggleMobileMenu() {
            const mobileMenu = document.getElementById('mobile-menu');
            mobileMenu.classList.toggle('active');
            document.body.classList.toggle('overflow-hidden');
        }
        
        // Close mobile menu when clicking outside
        document.addEventListener('click', function(event) {
            const mobileMenu = document.getElementById('mobile-menu');
            const menuButton = event.target.closest('.lg\\:hidden');
            
            if (!mobileMenu.contains(event.target) && !menuButton && mobileMenu.classList.contains('active')) {
                mobileMenu.classList.remove('active');
                document.body.classList.remove('overflow-hidden');
            }
        });
        
        // Close mobile menu on escape key
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                const mobileMenu = document.getElementById('mobile-menu');
                mobileMenu.classList.remove('active');
                document.body.classList.remove('overflow-hidden');
            }
        });
    </script>
    
    @yield('scripts')
</body>
</html>