@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto">

    <div class="flex gap-4">
        <img src="{{ $info['image'] }}" class="w-40 rounded shadow">

        <div>
            <h1 class="text-2xl font-bold text-white">{{ $info['title'] }}</h1>
            <p class="text-gray-400 mt-2">{{ $info['description'] }}</p>

            <p class="mt-3 text-gray-300">
                <strong>Author:</strong> {{ $info['author'] ?? 'Unknown' }}
            </p>
        </div>
    </div>

    <h2 class="text-xl font-semibold text-white mt-6 mb-3">Chapters</h2>
    <div class="space-y-2">

        @foreach($info['chapters'] as $chapter)
            <a href="{{ route('comic.chapter', [$info['endpoint'], $chapter['endpoint']]) }}"
               class="block bg-[#161b22] p-3 rounded hover:bg-[#1d2635] transition">
                {{ $chapter['title'] }}
            </a>
        @endforeach

    </div>

</div>
@endsection
