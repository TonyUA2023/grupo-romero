@extends('layouts.app')

@section('title', 'Galería - GRC Clínica Optométrica')

@section('content')
<section class="py-20">
    <div class="container mx-auto px-4">
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">Nuestro Espacio</h2>
            <p class="text-gray-600 max-w-2xl mx-auto">Descubre nuestras instalaciones y tecnología de última generación</p>
        </div>
        
        <!-- Filtros de categoría -->
        <div class="flex flex-wrap justify-center gap-3 mb-8">
            <button class="filter-btn px-4 py-2 rounded-full bg-blue-600 text-white" data-filter="all">Todo</button>
            @foreach($categories as $category)
            <button class="filter-btn px-4 py-2 rounded-full bg-gray-200 hover:bg-gray-300" data-filter="{{ Str::slug($category) }}">
                {{ $category }}
            </button>
            @endforeach
        </div>
        
        <!-- Grid de galería -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 gallery-grid">
            @foreach($galleryItems as $item)
            <div class="gallery-item overflow-hidden rounded-xl shadow-lg transition-all duration-300 hover:shadow-xl" 
                 data-category="{{ Str::slug($item->category) }}">
                <div class="relative group">
                    <img src="{{ asset('storage/' . $item->image) }}" 
                         alt="{{ $item->title }}" 
                         class="w-full h-72 object-cover transition-transform duration-500 group-hover:scale-110">
                    
                    <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-40 transition-all duration-300 flex items-center justify-center">
                        <div class="text-center opacity-0 group-hover:opacity-100 transform translate-y-4 group-hover:translate-y-0 transition-all duration-300">
                            <h3 class="text-white text-xl font-bold mb-2">{{ $item->title }}</h3>
                            <p class="text-gray-200">{{ $item->description }}</p>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

@push('scripts')
<script>
    // Filtrado de galería
    document.querySelectorAll('.filter-btn').forEach(button => {
        button.addEventListener('click', function() {
            const filter = this.getAttribute('data-filter');
            
            // Actualizar botones activos
            document.querySelectorAll('.filter-btn').forEach(btn => {
                btn.classList.remove('bg-blue-600', 'text-white');
                btn.classList.add('bg-gray-200', 'hover:bg-gray-300');
            });
            this.classList.remove('bg-gray-200', 'hover:bg-gray-300');
            this.classList.add('bg-blue-600', 'text-white');
            
            // Filtrar items
            document.querySelectorAll('.gallery-item').forEach(item => {
                if (filter === 'all' || item.getAttribute('data-category') === filter) {
                    item.classList.remove('hidden');
                } else {
                    item.classList.add('hidden');
                }
            });
        });
    });
</script>
@endpush
@endsection