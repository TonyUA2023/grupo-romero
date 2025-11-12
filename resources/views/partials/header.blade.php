{{-- 
    HEADER ACTUALIZADO PARA CLÍNICA LAURENT
    - Color de botón CTA y enlaces hover actualizados al azul corporativo (#004FFF).
    - Alt del logo actualizado.
--}}
<header class="bg-white shadow-sm fixed w-full z-50">
    <div class="container mx-auto px-4">
        <div class="flex justify-between items-center py-4">
            
            <a href="{{ route('home') }}" class="flex items-center">
                {{-- CAMBIO: Alt del logo actualizado --}}
                <img src="{{ asset('storage/'. $settings['logo']->value) }}" alt="Clínica Laurent" class="h-10">
            </a>
            
            <nav class="hidden md:flex space-x-8">
                {{-- CAMBIO: Hover de enlaces actualizado al azul corporativo --}}
                <a href="{{ route('services.index') }}" class="text-gray-700 hover:text-[#004FFF] transition">Servicios</a>
                <a href="{{ route('gallery.index') }}" class="text-gray-700 hover:text-[#004FFF] transition">Galería</a>
                <a href="{{ route('team.index') }}" class="text-gray-700 hover:text-[#004FFF] transition">Equipo</a>
                <a href="{{ route('blog.index') }}" class="text-gray-700 hover:text-[#004FFF] transition">Blog</a>
                <a href="{{ route('contact') }}" class="text-gray-700 hover:text-[#004FFF] transition">Contacto</a>
            </nav>
            
            <div class="hidden md:flex items-center space-x-4">
                {{-- 
                    CAMBIO: Botón CTA actualizado al azul corporativo 
                    - bg-blue-600 -> bg-[#004FFF]
                    - hover:bg-blue-700 -> hover:bg-[#003cb3] (un tono más oscuro)
                --}}
                <a href="{{ route('contact') }}" class="bg-[#004FFF] text-white px-4 py-2 rounded-full hover:bg-[#003cb3] transition">
                    <i class="fas fa-calendar-check mr-2"></i> Pedir Cita
                </a>
            </div>
            
            {{-- CAMBIO: Color de ícono actualizado al gris corporativo --}}
            <button class="md:hidden text-[#606060]" onclick="toggleMenu()">
                <i class="fas fa-bars text-2xl"></i>
            </button>
        </div>
        
        <div id="mobile-menu" class="hidden md:hidden py-4 border-t">
            <div class="flex flex-col space-y-4">
                {{-- CAMBIO: Hover de enlaces actualizado --}}
                <a href="{{ route('services.index') }}" class="text-gray-700 hover:text-[#004FFF] transition">Servicios</a>
                <a href="{{ route('gallery.index') }}" class="text-gray-700 hover:text-[#004FFF] transition">Galería</a>
                <a href="{{ route('team.index') }}" class="text-gray-700 hover:text-[#004FFF] transition">Equipo</a>
                <a href="{{ route('blog.index') }}" class="text-gray-700 hover:text-[#004FFF] transition">Blog</a>
                <a href="{{ route('contact') }}" class="text-gray-700 hover:text-[#004FFF] transition">Contacto</a>
                
                {{-- CAMBIO: Botón CTA móvil actualizado --}}
                <a href="{{ route('contact') }}" class="bg-[#004FFF] text-white px-4 py-2 rounded-full text-center mt-4 hover:bg-[#003cb3] transition">
                    <i class="fas fa-calendar-check mr-2"></i> Pedir Cita
                </a>
            </div>
        </div>
    </div>
</header>