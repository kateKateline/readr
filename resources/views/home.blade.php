@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-6 py-12 text-[#c9d1d9]">

    <div class="flex gap-6">

        <!-- LEFT: Comic Cards -->
        <div class="flex-1">
            @if(isset($query) && !empty($query))
                <div class="mb-6">
                    <h2 class="text-xl font-semibold text-gray-200 mb-2">
                        Search Results for "{{ $query }}"
                    </h2>
                    <p class="text-sm text-gray-400">
                        Found {{ $comics->total() }} {{ Str::plural('comic', $comics->total()) }}
                    </p>
                </div>
            @endif

            <div class="grid grid-cols-3 sm:grid-cols-4 md:grid-cols-5 lg:grid-cols-5 gap-3">
                @include('partials.cards.comic')
            </div>
            @if($comics->isEmpty())
            <div class="text-center py-20">
                @if(isset($query) && !empty($query))
                    <p class="text-gray-500 text-lg mb-2">No comics found for "{{ $query }}".</p>
                    <p class="text-gray-400 text-sm">Try searching with different keywords.</p>
                @else
                    <p class="text-gray-500 text-lg">No comics found.</p>
                @endif
            </div>
            @else
            <div class="mt-4">
                {{ $comics->links('vendor.pagination.custom') }}
            </div>
            @endif
        </div>

        <!-- RIGHT: Chat Box & Top Ranks -->
        <div class="w-[320px] hidden lg:block space-y-4">
            {{-- Global Chat --}}
            @include('partials.chat.global')

            {{-- Top Ranks --}}
            @include('partials.cards.top-ranks')
        </div>

    </div>

</div>
@endsection