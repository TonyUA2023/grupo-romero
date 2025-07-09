<header class="bg-white shadow-sm fixed w-full z-50">
    <div class="container mx-auto px-4">
        <div class="flex justify-between items-center py-4">
            <!-- Logo -->
            <a href="{{ route('home') }}" class="flex items-center">
                <img src="{{ asset('storage/' . $settings['logo']->value) }}" alt="GRC Clínica Optométrica" class="h-10">
            </a>
            
            <!-- Desktop Navigation -->
            <nav class="hidden md:flex space-x-8">
                <a href="{{ route('services.index') }}" class="hover:text-blue-600 transition">Servicios</a>
                <a href="{{ route('gallery.index') }}" class="hover:text-blue-600 transition">Galería</a>
                <a href="{{ route('team.index') }}" class="hover:text-blue-600 transition">Equipo</a>
                <a href="{{ route('blog.index') }}" class="hover:text-blue-600 transition">Blog</a>
                <a href="{{ route('contact') }}" class="hover:text-blue-600 transition">Contacto</a>
            </nav>
            
            <!-- Botones de acción -->
            <div class="hidden md:flex items-center space-x-4">
                <a href="{{ route('contact') }}" class="bg-blue-600 text-white px-4 py-2 rounded-full hover:bg-blue-700 transition">
                    <i class="fas fa-calendar-check mr-2"></i> Pedir Cita
                </a>
            </div>
            
            <!-- Mobile menu button -->
            <button class="md:hidden text-gray-700" onclick="toggleMenu()">
                <i class="fas fa-bars text-2xl"></i>
            </button>
        </div>
        
        <!-- Mobile Navigation -->
        <div id="mobile-menu" class="hidden md:hidden py-4 border-t">
            <div class="flex flex-col space-y-4">
                <a href="{{ route('services.index') }}" class="hover:text-blue-600 transition">Servicios</a>
                <a href="{{ route('gallery.index') }}" class="hover:text-blue-600 transition">Galería</a>
                <a href="{{ route('team.index') }}" class="hover:text-blue-600 transition">Equipo</a>
                <a href="{{ route('blog.index') }}" class="hover:text-blue-600 transition">Blog</a>
                <a href="{{ route('contact') }}" class="hover:text-blue-600 transition">Contacto</a>
                <a href="{{ route('contact') }}" class="bg-blue-600 text-white px-4 py-2 rounded-full text-center mt-4">
                    <i class="fas fa-calendar-check mr-2"></i> Pedir Cita
                </a>
            </div>
        </div>
    </div>
</header>