@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-12">
    @if($page->featured_image)
    <img src="{{ asset('storage/' . $page->featured_image) }}" alt="{{ $page->title }}" class="w-full h-96 object-cover rounded-xl mb-8">
    @endif
    
    <h1 class="text-4xl font-bold mb-6">{{ $page->title }}</h1>
    
    <div class="prose max-w-none">
        {!! $page->content !!}
    </div>
    
    @foreach($sections as $section)
    <div class="my-12">
        @if($section->title)
        <h2 class="text-3xl font-bold mb-4">{{ $section->title }}</h2>
        @endif
        
        @if($section->subtitle)
        <p class="text-xl text-gray-700 mb-6">{{ $section->subtitle }}</p>
        @endif
        
        @if($section->type === 'hero')
        <div class="relative h-96 rounded-xl overflow-hidden">
            <img src="{{ asset('storage/' . $section->image) }}" alt="{{ $section->title }}" class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-black bg-opacity-40 flex items-center justify-center">
                <div class="text-white text-center px-4">
                    <h3 class="text-3xl font-bold mb-4">{{ $section->title }}</h3>
                    <p class="text-xl mb-6 max-w-2xl">{{ $section->subtitle }}</p>
                    <a href="#" class="bg-white text-blue-900 px-6 py-3 rounded-full font-bold">Saber más</a>
                </div>
            </div>
        </div>
        @elseif($section->type === 'features')
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach(json_decode($section->data, true) as $feature)
            <div class="bg-gray-50 p-6 rounded-xl">
                <div class="text-blue-600 text-4xl mb-4">
                    <i class="{{ $feature['icon'] }}"></i>
                </div>
                <h4 class="text-xl font-bold mb-2">{{ $feature['title'] }}</h4>
                <p>{{ $feature['description'] }}</p>
            </div>
            @endforeach
        </div>
        @endif
    </div>
    @endforeach
</div>
@endsection