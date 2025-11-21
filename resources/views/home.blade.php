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
            @endif
        </div>

        <!-- RIGHT: Chat Box -->
        <div class="w-[320px] hidden lg:block">
            @include('partials.chat.global')
        </div>

    </div>

</div>
@endsection