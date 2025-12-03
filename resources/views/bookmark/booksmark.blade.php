@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-6 py-12 text-[#c9d1d9]">

    {{-- Header Section --}}
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-white mb-2">My Bookmarks</h1>
        <p class="text-gray-400">
            {{ $bookmarks->total() }} {{ Str::plural('bookmark', $bookmarks->total()) }}
        </p>
    </div>

    {{-- Success/Error Messages --}}
    @if(session('success'))
        <div class="mb-6 p-4 bg-green-500/20 border border-green-500/50 rounded-lg text-green-400">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="mb-6 p-4 bg-red-500/20 border border-red-500/50 rounded-lg text-red-400">
            {{ session('error') }}
        </div>
    @endif

    {{-- Bookmarks Grid --}}
    @if($bookmarks->count() > 0)
        <div class="grid grid-cols-3 sm:grid-cols-4 md:grid-cols-5 lg:grid-cols-6 gap-4">
            @foreach($bookmarks as $bookmark)
                @php
                    $comic = $bookmark->comic;
                @endphp
                <div class="group relative block rounded-lg overflow-hidden bg-[#161b22] border border-[#21262d] hover:border-[#30363d] transition-all duration-300">
                    
                    {{-- Cover Image --}}
                    <div class="aspect-[2/3] overflow-hidden bg-[#0d1117] relative">
                        <a href="{{ route('comic.show', $comic->mangadex_id) }}">
                            <img 
                                src="{{ $comic->image ?? 'https://via.placeholder.com/200x300?text=No+Image' }}"
                                alt="{{ $comic->title }}"
                                class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
                                loading="lazy"
                            >
                        </a>

                        {{-- Hover Gradient --}}
                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent 
                                    opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>

                        {{-- Remove Bookmark Button --}}
                        <form action="{{ route('bookmarks.destroy', $bookmark->id) }}" 
                              method="POST" 
                              class="absolute top-2 right-2 z-10"
                              onsubmit="return confirm('Hapus bookmark ini?');">
                            @csrf
                            @method('DELETE')
                            <button 
                                type="submit"
                                class="w-8 h-8 rounded-full bg-black/60 backdrop-blur-sm flex items-center justify-center hover:bg-red-500/80 transition group/btn"
                                title="Hapus bookmark">
                                <svg xmlns="http://www.w3.org/2000/svg" 
                                     fill="currentColor" 
                                     viewBox="0 0 24 24" 
                                     class="w-5 h-5 text-white group-hover/btn:text-white">
                                    <path d="M17.593 3.322c1.1.128 1.907 1.077 1.907 2.185V21L12 17.25 4.5 21V5.507c0-1.108.806-2.057 1.907-2.185a48.507 48.507 0 0111.186 0z" />
                                </svg>
                            </button>
                        </form>
                    </div>
                    
                    {{-- Info --}}
                    <div class="p-3 space-y-2">
                        {{-- Title --}}
                        <a href="{{ route('comic.show', $comic->mangadex_id) }}">
                            <h3 class="font-medium text-sm text-gray-200 group-hover:text-white transition truncate" 
                                title="{{ $comic->title }}">
                                {{ Str::limit($comic->title, 40, '...') }}
                            </h3>
                        </a>

                        {{-- Last Update --}}
                        @if(!empty($comic->last_update) && !empty($comic->last_chapter))
                            <div class="flex items-center justify-between text-xs text-gray-400 pt-2 border-t border-[#21262d]">
                                <span class="font-medium">
                                    Ch. {{ $comic->last_chapter }}
                                </span>
                                <span>
                                    {{ formatShortDate($comic->last_update) }}
                                </span>
                            </div>  
                        @endif

                        {{-- Bookmarked Date --}}
                        <div class="text-xs text-gray-500 pt-1">
                            Bookmarked {{ $bookmark->created_at->diffForHumans() }}
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- Pagination --}}
        <div class="mt-8">
            {{ $bookmarks->links('vendor.pagination.custom') }}
        </div>
    @else
        {{-- Empty State --}}
        <div class="text-center py-20">
            <svg xmlns="http://www.w3.org/2000/svg" 
                 fill="none" 
                 viewBox="0 0 24 24" 
                 stroke-width="1.5" 
                 stroke="currentColor" 
                 class="w-24 h-24 text-gray-600 mx-auto mb-4">
                <path stroke-linecap="round" stroke-linejoin="round" 
                      d="M17.593 3.322c1.1.128 1.907 1.077 1.907 2.185V21L12 17.25 4.5 21V5.507c0-1.108.806-2.057 1.907-2.185a48.507 48.507 0 0111.186 0z" />
            </svg>
            <p class="text-gray-500 text-lg mb-2">Belum ada bookmark</p>
            <p class="text-gray-400 text-sm mb-6">Mulai bookmark komik favorit Anda untuk akses cepat nanti.</p>
            <a href="{{ route('home') }}" 
               class="inline-block px-6 py-2 bg-blue-500 hover:bg-blue-600 text-white rounded-md transition">
                Jelajahi Komik
            </a>
        </div>
    @endif

</div>
@endsection

