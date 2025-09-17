@extends('layouts.app')

@section('title', 'Contacto - GRC Clínica Optométrica')

@section('content')
<!-- Hero Section con gradiente moderno -->
<section class="relative py-32 overflow-hidden">
    <!-- Fondo con gradiente más oscuro -->
    <div class="absolute inset-0 bg-gradient-to-br from-gray-100 via-gray-50 to-gray-100"></div>
    
    <!-- Overlay oscuro adicional para mayor profundidad -->
    <div class="absolute inset-0 bg-gray-900 opacity-5"></div>
    
    <!-- Patrón con mayor opacidad -->
    <div class="absolute inset-0 opacity-10">
        <div class="absolute inset-0" style="background-image: url('data:image/svg+xml,%3Csvg width="60" height="60" viewBox="0 0 60 60" xmlns="http://www.w3.org/2000/svg"%3E%3Cg fill="none" fill-rule="evenodd"%3E%3Cg fill="%239C92AC" fill-opacity="0.4"%3E%3Cpath d="M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z"/%3E%3C/g%3E%3C/g%3E%3C/svg%3E'); background-size: 60px 60px;"></div>
    </div>
    
    <div class="container mx-auto px-4 relative z-10">
        <div class="text-center max-w-3xl mx-auto">
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-gray-900 mb-6 leading-tight">
                Estamos aquí para <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-purple-600">cuidar tu visión</span>
            </h1>
            <p class="text-lg md:text-xl text-gray-700 font-light">
                Visítanos en nuestra clínica o contáctanos para agendar tu cita. Tu salud visual es nuestra prioridad.
            </p>
        </div>
    </div>
</section>
<!-- Sección principal de contacto -->
<section class="py-20 relative">
    <div class="container mx-auto px-4">
        @if(session('success'))
        <div class="max-w-4xl mx-auto mb-8">
            <div class="bg-gradient-to-r from-green-50 to-emerald-50 border border-green-200 rounded-2xl p-6 flex items-center space-x-4">
                <div class="flex-shrink-0">
                    <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center">
                        <i class="fas fa-check text-green-600 text-lg"></i>
                    </div>
                </div>
                <div class="flex-1">
                    <p class="text-green-800 font-medium">{{ session('success') }}</p>
                </div>
            </div>
        </div>
        @endif
        
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 max-w-7xl mx-auto">
            <!-- Información de contacto -->
            <div>
                <div class="mb-12">
                    <h2 class="text-4xl font-bold text-gray-900 mb-4">Información de contacto</h2>
                    <p class="text-gray-600 text-lg font-light">Encuentra todos los detalles para visitarnos o comunicarte con nosotros.</p>
                </div>
                
                <!-- Tarjetas de información -->
                <div class="space-y-6">
                    <!-- Dirección -->
                    <div class="group bg-white rounded-2xl p-6 shadow-lg hover:shadow-2xl transition-all duration-300 border border-gray-100">
                        <div class="flex items-start space-x-4">
                            <div class="flex-shrink-0">
                                <div class="w-14 h-14 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl flex items-center justify-center transform group-hover:scale-110 transition-transform duration-300">
                                    <i class="fas fa-map-marker-alt text-white text-xl"></i>
                                </div>
                            </div>
                            <div class="flex-1">
                                <h3 class="text-lg font-semibold text-gray-900 mb-2">Dirección</h3>
                                <p class="text-gray-600 mb-3">Av. 9 de Diciembre 580</p>
                                <a href="https://maps.app.goo.gl/ckLSyRJ21GsiRAjd6" 
                                   target="_blank"
                                   class="inline-flex items-center text-blue-600 hover:text-blue-700 font-medium text-sm group-hover:translate-x-1 transition-transform duration-300">
                                    <span>Ver en Google Maps</span>
                                    <i class="fas fa-arrow-right ml-2"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Teléfono -->
                    <div class="group bg-white rounded-2xl p-6 shadow-lg hover:shadow-2xl transition-all duration-300 border border-gray-100">
                        <div class="flex items-start space-x-4">
                            <div class="flex-shrink-0">
                                <div class="w-14 h-14 bg-gradient-to-br from-emerald-500 to-emerald-600 rounded-xl flex items-center justify-center transform group-hover:scale-110 transition-transform duration-300">
                                    <i class="fas fa-phone-alt text-white text-xl"></i>
                                </div>
                            </div>
                            <div class="flex-1">
                                <h3 class="text-lg font-semibold text-gray-900 mb-2">Teléfono</h3>
                                <p class="text-gray-600 mb-3">923 323 517</p>
                                <a href="tel:+51923323517" 
                                   class="inline-flex items-center text-emerald-600 hover:text-emerald-700 font-medium text-sm group-hover:translate-x-1 transition-transform duration-300">
                                    <span>Llamar ahora</span>
                                    <i class="fas fa-phone ml-2"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    
                    <!-- WhatsApp -->
                    <div class="group bg-white rounded-2xl p-6 shadow-lg hover:shadow-2xl transition-all duration-300 border border-gray-100">
                        <div class="flex items-start space-x-4">
                            <div class="flex-shrink-0">
                                <div class="w-14 h-14 bg-gradient-to-br from-green-500 to-green-600 rounded-xl flex items-center justify-center transform group-hover:scale-110 transition-transform duration-300">
                                    <i class="fab fa-whatsapp text-white text-2xl"></i>
                                </div>
                            </div>
                            <div class="flex-1">
                                <h3 class="text-lg font-semibold text-gray-900 mb-2">WhatsApp</h3>
                                <p class="text-gray-600 mb-3">923 323 517</p>
                                <a href="https://wa.me/51923323517?text=Hola%20GRC%20Clínica%20Optométrica,%20me%20gustaría%20agendar%20una%20cita" 
                                   target="_blank"
                                   class="inline-flex items-center text-green-600 hover:text-green-700 font-medium text-sm group-hover:translate-x-1 transition-transform duration-300">
                                    <span>Enviar mensaje</span>
                                    <i class="fab fa-whatsapp ml-2"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Email -->
                    <div class="group bg-white rounded-2xl p-6 shadow-lg hover:shadow-2xl transition-all duration-300 border border-gray-100">
                        <div class="flex items-start space-x-4">
                            <div class="flex-shrink-0">
                                <div class="w-14 h-14 bg-gradient-to-br from-purple-500 to-purple-600 rounded-xl flex items-center justify-center transform group-hover:scale-110 transition-transform duration-300">
                                    <i class="fas fa-envelope text-white text-xl"></i>
                                </div>
                            </div>
                            <div class="flex-1">
                                <h3 class="text-lg font-semibold text-gray-900 mb-2">Email</h3>
                                <p class="text-gray-600 mb-3">clinicagrc@gmail.com</p>
                                <a href="mailto:clinicagrc@gmail.com" 
                                   class="inline-flex items-center text-purple-600 hover:text-purple-700 font-medium text-sm group-hover:translate-x-1 transition-transform duration-300">
                                    <span>Enviar correo</span>
                                    <i class="fas fa-envelope ml-2"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Mapa mejorado -->
                <div class="mt-10">
                    <div class="bg-white rounded-2xl shadow-2xl overflow-hidden border border-gray-100">
                        <iframe 
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3901.405040462462!2d-75.20797232418458!3d-12.084399842604116!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x910e96ff1779080b%3A0x2e9cb4ec40d81cc6!2sAv%209%20de%20Diciembre%20580%2C%20Huancayo%2012003%2C%20Per%C3%BA!5e0!3m2!1ses-419!2sus!4v1753831113477!5m2!1ses-419!2sus"
                            width="100%" 
                            height="350" 
                            style="border:0;" 
                            allowfullscreen="" 
                            loading="lazy"
                            class="w-full">
                        </iframe>
                        <div class="p-4 bg-gradient-to-r from-blue-50 to-purple-50">
                            <p class="text-sm text-gray-600 flex items-center justify-center">
                                <i class="fas fa-map-pin mr-2 text-blue-600"></i>
                                Av. 9 de Diciembre 580, Huancayo
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Formulario de contacto mejorado -->
            <div>
                <div class="bg-white rounded-3xl shadow-2xl p-8 md:p-10 border border-gray-100">
                    <div class="mb-8">
                        <h2 class="text-3xl font-bold text-gray-900 mb-3">Agenda tu cita</h2>
                        <p class="text-gray-600">Completa el formulario y te contactaremos en menos de 24 horas.</p>
                    </div>
                    
                    <form action="{{ route('contact.send') }}" method="POST" class="space-y-6">
                        @csrf
                        
                        <!-- Campos del formulario con diseño mejorado -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="group">
                                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                                    Nombre completo <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <input type="text" 
                                           id="name" 
                                           name="name" 
                                           required 
                                           class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-blue-500 focus:ring-4 focus:ring-blue-100 transition-all duration-300 pl-11">
                                    <i class="fas fa-user absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                                </div>
                            </div>
                            
                            <div class="group">
                                <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                                    Email <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <input type="email" 
                                           id="email" 
                                           name="email" 
                                           required 
                                           class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-blue-500 focus:ring-4 focus:ring-blue-100 transition-all duration-300 pl-11">
                                    <i class="fas fa-envelope absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                                </div>
                            </div>
                            
                            <div class="group">
                                <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">
                                    Teléfono <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <input type="tel" 
                                           id="phone" 
                                           name="phone" 
                                           required 
                                           class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-blue-500 focus:ring-4 focus:ring-blue-100 transition-all duration-300 pl-11">
                                    <i class="fas fa-phone absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                                </div>
                            </div>
                            
                            <div class="group">
                                <label for="service" class="block text-sm font-medium text-gray-700 mb-2">
                                    Servicio de interés
                                </label>
                                <div class="relative">
                                    <select id="service" 
                                            name="service" 
                                            class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-blue-500 focus:ring-4 focus:ring-blue-100 transition-all duration-300 pl-11 appearance-none">
                                        <option value="">Seleccionar servicio</option>
                                        @foreach($services as $service)
                                        <option value="{{ $service->id }}">{{ $service->name }}</option>
                                        @endforeach
                                    </select>
                                    <i class="fas fa-stethoscope absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                                    <i class="fas fa-chevron-down absolute right-4 top-1/2 transform -translate-y-1/2 text-gray-400 pointer-events-none"></i>
                                </div>
                            </div>
                        </div>
                        
                        <div class="group">
                            <label for="message" class="block text-sm font-medium text-gray-700 mb-2">
                                Mensaje <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <textarea id="message" 
                                          name="message" 
                                          rows="4" 
                                          required 
                                          placeholder="Cuéntanos cómo podemos ayudarte..."
                                          class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-blue-500 focus:ring-4 focus:ring-blue-100 transition-all duration-300 resize-none"></textarea>
                            </div>
                        </div>
                        
                        <button type="submit" 
                                class="w-full bg-gradient-to-r from-blue-600 to-purple-600 text-white px-8 py-4 rounded-xl font-semibold hover:from-blue-700 hover:to-purple-700 transform hover:scale-[1.02] transition-all duration-300 shadow-lg hover:shadow-xl">
                            <i class="fas fa-paper-plane mr-2"></i>
                            Enviar solicitud
                        </button>
                    </form>
                    
                    <!-- Información adicional -->
                    <div class="mt-8 pt-8 border-t border-gray-100">
                        <div class="flex items-center justify-center space-x-6 text-sm text-gray-500">
                            <div class="flex items-center">
                                <i class="fas fa-shield-alt text-green-500 mr-2"></i>
                                <span>Datos seguros</span>
                            </div>
                            <div class="flex items-center">
                                <i class="fas fa-clock text-blue-500 mr-2"></i>
                                <span>Respuesta rápida</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Horarios de atención con diseño mejorado -->
<section class="py-20 bg-gradient-to-br from-blue-50 via-purple-50 to-pink-50 relative overflow-hidden">
    <!-- Elementos decorativos -->
    <div class="absolute top-0 right-0 w-96 h-96 bg-blue-200 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob"></div>
    <div class="absolute bottom-0 left-0 w-96 h-96 bg-purple-200 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob animation-delay-2000"></div>
    
    <div class="container mx-auto px-4 relative z-10">
        <div class="text-center mb-12">
            <h2 class="text-4xl font-bold text-gray-900 mb-4">Horarios de Atención</h2>
            <p class="text-lg text-gray-600 font-light">Estamos disponibles para atenderte durante toda la semana</p>
        </div>
        
        <div class="max-w-4xl mx-auto">
            <div class="bg-white/90 backdrop-blur-lg rounded-3xl shadow-2xl p-10 border border-white/50">
                <!-- Horario simplificado -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-10">
                    <div class="text-center">
                        <div class="inline-flex items-center justify-center w-16 h-16 bg-gradient-to-br from-blue-100 to-purple-100 rounded-2xl mb-4">
                            <i class="fas fa-calendar-alt text-2xl text-blue-600"></i>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">Todos los días</h3>
                        <p class="text-gray-600">Lunes a Domingo</p>
                    </div>
                    
                    <div class="text-center">
                        <div class="inline-flex items-center justify-center w-16 h-16 bg-gradient-to-br from-purple-100 to-pink-100 rounded-2xl mb-4">
                            <i class="fas fa-clock text-2xl text-purple-600"></i>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">9:00 AM - 7:00 PM</h3>
                        <p class="text-gray-600">Horario continuo</p>
                    </div>
                </div>
                
                <!-- CTA -->
                <div class="text-center pt-8 border-t border-gray-100">
                    <p class="text-gray-600 mb-6">¿Necesitas una cita urgente? Contáctanos por WhatsApp</p>
                    <a href="https://wa.me/51923323517?text=Hola%20GRC%20Clínica%20Optométrica,%20necesito%20una%20cita%20urgente" 
                       target="_blank"
                       class="inline-flex items-center bg-gradient-to-r from-green-600 to-green-700 text-white px-8 py-4 rounded-full font-semibold hover:from-green-700 hover:to-green-800 transform hover:scale-105 transition-all duration-300 shadow-lg">
                        <i class="fab fa-whatsapp mr-3 text-xl"></i>
                        Agendar cita por WhatsApp
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Sección de CTA final -->
<section class="py-20 bg-gradient-to-r from-blue-600 to-purple-600 relative overflow-hidden">
    <div class="absolute inset-0 bg-black/10"></div>
    <div class="container mx-auto px-4 relative z-10">
        <div class="text-center max-w-3xl mx-auto">
            <h2 class="text-3xl md:text-4xl font-bold text-white mb-6">
                ¿Listo para cuidar tu salud visual?
            </h2>
            <p class="text-xl text-white/90 mb-10 font-light">
                Nuestro equipo de especialistas está esperando para brindarte la mejor atención
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="tel:+51923323517" 
                   class="inline-flex items-center justify-center bg-white text-blue-600 px-8 py-4 rounded-full font-semibold hover:bg-gray-100 transform hover:scale-105 transition-all duration-300 shadow-lg">
                    <i class="fas fa-phone mr-3"></i>
                    Llamar ahora
                </a>
                <a href="https://wa.me/51923323517?text=Hola%20GRC%20Clínica%20Optométrica,%20me%20gustaría%20agendar%20una%20cita" 
                   target="_blank"
                   class="inline-flex items-center justify-center bg-green-500 text-white px-8 py-4 rounded-full font-semibold hover:bg-green-600 transform hover:scale-105 transition-all duration-300 shadow-lg">
                    <i class="fab fa-whatsapp mr-3 text-xl"></i>
                    WhatsApp
                </a>
            </div>
        </div>
    </div>
</section>

<style>
@keyframes blob {
    0% { transform: translate(0px, 0px) scale(1); }
    33% { transform: translate(30px, -50px) scale(1.1); }
    66% { transform: translate(-20px, 20px) scale(0.9); }
    100% { transform: translate(0px, 0px) scale(1); }
}

.animate-blob {
    animation: blob 7s infinite;
}

.animation-delay-2000 {
    animation-delay: 2s;
}
</style>
@endsection