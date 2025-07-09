@extends('layouts.app')

@section('title', 'Contacto - GRC Clínica Optométrica')

@section('content')
<section class="py-20">
    <div class="container mx-auto px-4">
        @if(session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-8" role="alert">
            <p>{{ session('success') }}</p>
        </div>
        @endif
        
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
            <!-- Información de contacto -->
            <div>
                <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-6">Visítanos en nuestra clínica</h2>
                
                <div class="space-y-6 mb-8">
                    <div class="flex items-start">
                        <div class="text-blue-600 text-xl mr-4 mt-1">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-800 mb-1">Dirección</h3>
                            <p class="text-gray-600">{{ $settings['address']->value }}</p>
                        </div>
                    </div>
                    
                    <div class="flex items-center">
                        <div class="text-blue-600 text-xl mr-4">
                            <i class="fas fa-phone-alt"></i>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-800 mb-1">Teléfono</h3>
                            <p class="text-gray-600">{{ $settings['phone']->value }}</p>
                        </div>
                    </div>
                    
                    <div class="flex items-center">
                        <div class="text-blue-600 text-xl mr-4">
                            <i class="fab fa-whatsapp"></i>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-800 mb-1">WhatsApp</h3>
                            <p class="text-gray-600">{{ $settings['whatsapp']->value }}</p>
                        </div>
                    </div>
                    
                    <div class="flex items-center">
                        <div class="text-blue-600 text-xl mr-4">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-800 mb-1">Email</h3>
                            <p class="text-gray-600">{{ $settings['email']->value }}</p>
                        </div>
                    </div>
                </div>
                
                <!-- Mapa -->
                <div class="rounded-xl overflow-hidden shadow-lg h-80">
                    {!! $settings['google_maps']->value !!}
                </div>
            </div>
            
            <!-- Formulario de contacto -->
            <div class="bg-white rounded-xl shadow-lg p-8">
                <h2 class="text-3xl font-bold text-gray-800 mb-6">Solicita una cita</h2>
                <p class="text-gray-600 mb-8">Completa el formulario y nos pondremos en contacto contigo a la brevedad</p>
                
                <form action="{{ route('contact.send') }}" method="POST">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nombre completo *</label>
                            <input type="text" id="name" name="name" required 
                                   class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200">
                        </div>
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email *</label>
                            <input type="email" id="email" name="email" required 
                                   class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200">
                        </div>
                        <div>
                            <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">Teléfono *</label>
                            <input type="tel" id="phone" name="phone" required 
                                   class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200">
                        </div>
                        <div>
                            <label for="service" class="block text-sm font-medium text-gray-700 mb-1">Servicio de interés</label>
                            <select id="service" name="service" 
                                    class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200">
                                <option value="">Seleccionar servicio</option>
                                @foreach($services as $service)
                                <option value="{{ $service->id }}">{{ $service->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    
                    <div class="mb-6">
                        <label for="message" class="block text-sm font-medium text-gray-700 mb-1">Mensaje *</label>
                        <textarea id="message" name="message" rows="4" required 
                                  class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200"></textarea>
                    </div>
                    
                    <button type="submit" class="w-full bg-blue-600 text-white px-6 py-4 rounded-lg font-bold hover:bg-blue-700 transition">
                        Enviar solicitud
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>

<!-- Horarios de atención -->
<section class="py-16 bg-blue-50">
    <div class="container mx-auto px-4 text-center">
        <h2 class="text-3xl font-bold text-gray-800 mb-6">Horarios de Atención</h2>
        
        <div class="max-w-3xl mx-auto bg-white rounded-xl shadow-lg p-8">
            @php
                $schedule = json_decode($settings['schedule']->value, true);
            @endphp
            <ul class="space-y-4">
                @foreach(['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'] as $day)
                <li class="flex justify-between items-center py-2 border-b border-gray-100">
                    <span class="capitalize font-medium">{{ trans("days.$day") }}:</span>
                    <span class="text-gray-600">{{ $schedule[$day] ?? 'Cerrado' }}</span>
                </li>
                @endforeach
            </ul>
            
            <div class="mt-8">
                <a href="{{ route('contact') }}" class="inline-block bg-blue-600 text-white px-8 py-3 rounded-full font-bold hover:bg-blue-700 transition">
                    <i class="fas fa-calendar-check mr-2"></i> Reservar Cita
                </a>
            </div>
        </div>
    </div>
</section>
@endsection