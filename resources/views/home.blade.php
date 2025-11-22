@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-6 py-12 text-[#c9d1d9]">

    <div class="flex gap-6">
        
        <!-- LEFT: Comic Cards -->
        <div class="flex-1">
            <div class="grid grid-cols-3 sm:grid-cols-4 md:grid-cols-5 lg:grid-cols-5 gap-3">
                @include('partials.cards.comic')
            </div>
            @if($comics->isEmpty())
                <div class="text-center py-20">
                    <p class="text-gray-500 text-lg">No comics found.</p>
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