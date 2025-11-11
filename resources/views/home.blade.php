@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-6 py-12 text-[#c9d1d9]">

    {{-- Manga Section --}}
    <section class="mb-16">
        <h2 class="text-3xl font-bold mb-6 text-white">Manga</h2>
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-6">
            @include('partials.cards.manga')
        </div>
    </section>

    {{-- Manhwa Section --}}
    <section class="mb-16">
        <h2 class="text-3xl font-bold mb-6 text-white">Manhwa</h2>
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-6">
            @include('partials.cards.manhwa')
        </div>
    </section>

    {{-- Manhua Section --}}
    <section>
        <h2 class="text-3xl font-bold mb-6 text-white">Manhua</h2>
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-6">
            @include('partials.cards.manhua')
        </div>
    </section>

</div>
@endsection
