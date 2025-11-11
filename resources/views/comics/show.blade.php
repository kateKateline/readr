@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto py-10 text-[#c9d1d9]">

    {{-- 🔹 Banner dan Judul --}}
    <div class="mb-6 relative">
        <img src="{{ asset('storage/'.$comic->banner_image) }}" 
             alt="{{ $comic->title }}" 
             class="w-full h-64 object-cover rounded-lg mb-4">
        
        {{-- Label tipe comic (manga / manhwa / manhua) --}}
        <span class="
            absolute top-4 left-4 px-4 py-1 rounded-full text-sm font-semibold
            @if($comic->type === 'manga') bg-blue-600
            @elseif($comic->type === 'manhwa') bg-green-600
            @elseif($comic->type === 'manhua') bg-purple-600
            @else bg-gray-600
            @endif
        ">
            {{ strtoupper($comic->type) }}
        </span>

        <h1 class="text-3xl font-bold mb-2">{{ $comic->title }}</h1>
        <p class="text-gray-400">{{ $comic->author ?? 'Unknown' }}</p>
    </div>

    {{-- 🔹 Konten Utama --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
            <img src="{{ asset('storage/'.$comic->cover_image) }}" 
                 alt="{{ $comic->title }}" 
                 class="rounded-lg w-full object-cover shadow-lg">
        </div>

        <div>
            <h2 class="text-2xl font-semibold mb-2">Description</h2>
            <p class="text-gray-300 mb-4 leading-relaxed">{{ $comic->desc }}</p>

            <div class="space-y-1">
                <p><strong>📚 Genre:</strong> {{ $comic->genre }}</p>
                <p><strong>📅 Release Date:</strong> {{ $comic->release_date }}</p>
                <p><strong>🚀 Status:</strong> {{ ucfirst($comic->status) }}</p>
            </div>
        </div>
    </div>

    {{-- 🔹 Tombol Back --}}
    <div class="mt-10">
        <a href="{{ url('/') }}" 
           class="inline-block px-5 py-2 bg-[#21262d] text-white rounded-lg hover:bg-[#30363d] transition">
            ← Back to Home
        </a>
    </div>
</div>
@endsection
@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto py-10 text-[#c9d1d9]">

    {{-- 🔹 Banner dan Judul --}}
    <div class="mb-6 relative">
        <img src="{{ asset('storage/'.$comic->banner_image) }}" 
             alt="{{ $comic->title }}" 
             class="w-full h-64 object-cover rounded-lg mb-4">
        
        {{-- Label tipe comic (manga / manhwa / manhua) --}}
        <span class="
            absolute top-4 left-4 px-4 py-1 rounded-full text-sm font-semibold
            @if($comic->type === 'manga') bg-blue-600
            @elseif($comic->type === 'manhwa') bg-green-600
            @elseif($comic->type === 'manhua') bg-purple-600
            @else bg-gray-600
            @endif
        ">
            {{ strtoupper($comic->type) }}
        </span>

        <h1 class="text-3xl font-bold mb-2">{{ $comic->title }}</h1>
        <p class="text-gray-400">{{ $comic->author ?? 'Unknown' }}</p>
    </div>

    {{-- 🔹 Konten Utama --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
            <img src="{{ asset('storage/'.$comic->cover_image) }}" 
                 alt="{{ $comic->title }}" 
                 class="rounded-lg w-full object-cover shadow-lg">
        </div>

        <div>
            <h2 class="text-2xl font-semibold mb-2">Description</h2>
            <p class="text-gray-300 mb-4 leading-relaxed">{{ $comic->desc }}</p>

            <div class="space-y-1">
                <p><strong>📚 Genre:</strong> {{ $comic->genre }}</p>
                <p><strong>📅 Release Date:</strong> {{ $comic->release_date }}</p>
                <p><strong>🚀 Status:</strong> {{ ucfirst($comic->status) }}</p>
            </div>
        </div>
    </div>

    {{-- 🔹 Tombol Back --}}
    <div class="mt-10">
        <a href="{{ url('/') }}" 
           class="inline-block px-5 py-2 bg-[#21262d] text-white rounded-lg hover:bg-[#30363d] transition">
            ← Back to Home
        </a>
    </div>
</div>
@endsection
