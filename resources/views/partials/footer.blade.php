<footer class="bg-gray-900 text-white pt-16 pb-8">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
            <!-- Información -->
            <div>
                <img src="{{ asset('storage/' . $settings['logo']->value) }}" alt="GRC Clínica Optométrica" class="h-12 mb-6">
                <p class="text-gray-400 mb-6">{{ $settings['site_description']->value }}</p>
                
                <div class="flex space-x-4">
                    @if($settings['facebook']->value)
                    <a href="{{ $settings['facebook']->value }}" class="text-gray-400 hover:text-white transition" target="_blank">
                        <i class="fab fa-facebook-f text-xl"></i>
                    </a>
                    @endif
                    
                    @if($settings['instagram']->value)
                    <a href="{{ $settings['instagram']->value }}" class="text-gray-400 hover:text-white transition" target="_blank">
                        <i class="fab fa-instagram text-xl"></i>
                    </a>
                    @endif
                    
                    @if($settings['linkedin']->value)
                    <a href="{{ $settings['linkedin']->value }}" class="text-gray-400 hover:text-white transition" target="_blank">
                        <i class="fab fa-linkedin-in text-xl"></i>
                    </a>
                    @endif
                </div>
            </div>
            
            <!-- Enlaces Rápidos -->
            <div>
                <h3 class="text-lg font-semibold mb-6">Enlaces Rápidos</h3>
                <ul class="space-y-3">
                    <li><a href="{{ route('services.index') }}" class="text-gray-400 hover:text-white transition">Servicios</a></li>
                    <li><a href="{{ route('gallery.index') }}" class="text-gray-400 hover:text-white transition">Galería</a></li>
                    <li><a href="{{ route('team.index') }}" class="text-gray-400 hover:text-white transition">Nuestro Equipo</a></li>
                    <li><a href="{{ route('blog.index') }}" class="text-gray-400 hover:text-white transition">Blog</a></li>
                    <li><a href="{{ route('contact') }}" class="text-gray-400 hover:text-white transition">Contacto</a></li>
                </ul>
            </div>
            
            <!-- Horarios -->
            <div>
                <h3 class="text-lg font-semibold mb-6">Horarios</h3>
                @php
                    $schedule = json_decode($settings['schedule']->value, true);
                @endphp
                <ul class="space-y-3">
                    @foreach(['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'] as $day)
                    <li class="flex justify-between">
                        <span class="capitalize">{{ trans("days.$day") }}:</span>
                        <span class="text-gray-400">{{ $schedule[$day] ?? 'Cerrado' }}</span>
                    </li>
                    @endforeach
                </ul>
            </div>
            
            <!-- Contacto -->
            <div>
                <h3 class="text-lg font-semibold mb-6">Contacto</h3>
                <ul class="space-y-4">
                    <li class="flex items-start">
                        <i class="fas fa-map-marker-alt mt-1 mr-3 text-blue-500"></i>
                        <span class="text-gray-400">{{ $settings['address']->value }}</span>
                    </li>
                    <li class="flex items-center">
                        <i class="fas fa-phone-alt mr-3 text-blue-500"></i>
                        <a href="tel:{{ $settings['phone']->value }}" class="text-gray-400 hover:text-white transition">
                            {{ $settings['phone']->value }}
                        </a>
                    </li>
                    <li class="flex items-center">
                        <i class="fab fa-whatsapp mr-3 text-blue-500"></i>
                        <a href="https://wa.me/{{ $settings['whatsapp']->value }}" class="text-gray-400 hover:text-white transition" target="_blank">
                            {{ $settings['whatsapp']->value }}
                        </a>
                    </li>
                    <li class="flex items-center">
                        <i class="fas fa-envelope mr-3 text-blue-500"></i>
                        <a href="mailto:{{ $settings['email']->value }}" class="text-gray-400 hover:text-white transition">
                            {{ $settings['email']->value }}
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        
        <div class="border-t border-gray-800 mt-12 pt-6 text-center text-gray-500">
            <p>&copy; {{ date('Y') }} GRC Clínica Optométrica. Todos los derechos reservados.</p>
        </div>
    </div>
</footer>