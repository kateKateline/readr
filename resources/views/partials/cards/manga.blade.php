@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-6">Popular Manga</h1>
    
    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-6">
        @foreach($manga as $item)
            <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300">
                <a href="{{ route('comic.show', $item['endpoint']) }}">
                    <!-- Cover Image -->
                    <div class="aspect-[2/3] overflow-hidden bg-gray-200">
                        <img 
                            src="{{ $item['image'] }}" 
                            alt="{{ $item['title'] }}"
                            class="w-full h-full object-cover hover:scale-105 transition-transform duration-300"
                            loading="lazy"
                        >
                    </div>
                    
                    <!-- Manga Info -->
                    <div class="p-4">
                        <h3 class="font-semibold text-sm line-clamp-2 mb-2 min-h-[2.5rem]">
                            {{ $item['title'] }}
                        </h3>
                        <span class="inline-block px-2 py-1 bg-blue-100 text-blue-800 text-xs rounded">
                            {{ strtoupper($item['type']) }}
                        </span>
                    </div>
                </a>
            </div>
        @endforeach
    </div>

    @if($manga->isEmpty())
        <div class="text-center py-12">
            <p class="text-gray-500 text-lg">No manga found.</p>
        </div>
    @endif
</div>
@endsection