@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto py-10 text-[#c9d1d9]">
    <div class="bg-[#0d1117] rounded-lg overflow-hidden shadow">
        {{-- Banner --}}
        <div class="h-44 bg-gray-800">
            @if(!empty($user->profile_banner))
                <img src="{{ asset('storage/'.$user->profile_banner) }}" alt="banner" class="w-full h-44 object-cover">
            @else
                <div class="w-full h-44 bg-gradient-to-r from-gray-700 to-gray-800"></div>
            @endif
        </div>

        <div class="p-6 md:flex md:items-center gap-6">
            {{-- Avatar --}}
            <div class="-mt-16 md:mt-0 md:ml-0 flex-shrink-0">
                @if(!empty($user->profile_image))
                    <img src="{{ asset('storage/'.$user->profile_image) }}" alt="avatar" class="w-32 h-32 rounded-lg object-cover border-4 border-[#0d1117] shadow">
                @else
                    <div class="w-32 h-32 rounded-lg bg-gray-700 flex items-center justify-center text-2xl font-semibold">{{ strtoupper(substr($user->name,0,1)) }}</div>
                @endif
            </div>

            <div class="mt-4 md:mt-0">
                <h1 class="text-2xl font-bold">{{ $user->name }}</h1>
                <p class="text-sm text-gray-400">{{ $user->email }}</p>

                <div class="mt-3 space-x-2">
                    <span class="inline-block px-3 py-1 text-sm font-medium rounded-full bg-[#21262d] text-white">Level: {{ ucfirst($user->level ?? 'user') }}</span>
                    <a href="{{ route('home') }}" class="inline-block px-3 py-1 text-sm font-medium rounded-full bg-[#161b22] text-white hover:bg-[#21262d]">Back</a>
                </div>

                {{-- Optional: edit/profile actions --}}
                <div class="mt-4">
                    <a href="#" class="text-sm text-blue-500 hover:underline">Edit profile</a>
                </div>
            </div>
        </div>

        <div class="border-t border-[#161b22] p-6">
            <h2 class="text-lg font-semibold mb-2">About</h2>
            <p class="text-gray-300">This is your profile page. You can add more fields and editable sections here later.</p>
        </div>
    </div>
</div>
@endsection
