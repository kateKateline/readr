@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-6 py-12 text-[#c9d1d9]">

    {{-- Manga Section --}}
    <section class="mb-16">
        <h2 class="text-3xl font-bold mb-6 text-white">Manga</h2>
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-6">
            @forelse($manga as $item)
                <div class="bg-[#161b22] rounded-xl p-3 shadow hover:shadow-lg transition">
                    <img src="{{ asset('storage/'.$item->cover_image) }}" 
                         alt="{{ $item->title }}" 
                         class="rounded-lg w-full h-52 object-cover mb-3">
                    <h3 class="text-lg font-semibold truncate">{{ $item->title }}</h3>
                    <p class="text-sm text-gray-400">{{ $item->author ?? 'Unknown' }}</p>
                </div>
            @empty
                <p class="text-gray-400">Belum ada manga yang diunggah.</p>
            @endforelse
        </div>
    </section>

    {{-- Manhwa Section --}}
    <section class="mb-16">
        <h2 class="text-3xl font-bold mb-6 text-white">Manhwa</h2>
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-6">
            @forelse($manhwa as $item)
                <div class="bg-[#161b22] rounded-xl p-3 shadow hover:shadow-lg transition">
                    <img src="{{ asset('storage/'.$item->cover_image) }}" 
                         alt="{{ $item->title }}" 
                         class="rounded-lg w-full h-52 object-cover mb-3">
                    <h3 class="text-lg font-semibold truncate">{{ $item->title }}</h3>
                    <p class="text-sm text-gray-400">{{ $item->author ?? 'Unknown' }}</p>
                </div>
            @empty
                <p class="text-gray-400">Belum ada manhwa yang diunggah.</p>
            @endforelse
        </div>
    </section>

    {{-- Manhua Section --}}
    <section>
        <h2 class="text-3xl font-bold mb-6 text-white">Manhua</h2>
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-6">
            @forelse($manhua as $item)
                <div class="bg-[#161b22] rounded-xl p-3 shadow hover:shadow-lg transition">
                    <img src="{{ asset('storage/'.$item->cover_image) }}" 
                         alt="{{ $item->title }}" 
                         class="rounded-lg w-full h-52 object-cover mb-3">
                    <h3 class="text-lg font-semibold truncate">{{ $item->title }}</h3>
                    <p class="text-sm text-gray-400">{{ $item->author ?? 'Unknown' }}</p>
                </div>
            @empty
                <p class="text-gray-400">Belum ada manhua yang diunggah.</p>
            @endforelse
        </div>
    </section>

</div>
@endsection
