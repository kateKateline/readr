@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-6 py-12 text-[#c9d1d9]">

    {{-- Header Section --}}
    <div class="mb-8 flex justify-between items-center">
        <div>
            <h1 class="text-3xl font-bold text-white mb-2">Reading History</h1>
            <p class="text-gray-400">
                {{ $histories->total() }} {{ Str::plural('comic', $histories->total()) }}
            </p>
        </div>
        @if($histories->count() > 0)
            <form action="{{ route('history.clearAll') }}" method="POST" 
                  onsubmit="return confirm('Hapus semua history? Tindakan ini tidak dapat dibatalkan.');">
                @csrf
                <button type="submit" 
                        class="px-4 py-2 bg-red-500/20 hover:bg-red-500/30 border border-red-500/50 text-red-400 rounded-md transition text-sm">
                    Hapus Semua
                </button>
            </form>
        @endif
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

    {{-- History Grid --}}
    @if($histories->count() > 0)
        <div class="grid grid-cols-3 sm:grid-cols-4 md:grid-cols-5 lg:grid-cols-6 gap-4">
            @foreach($histories as $history)
                @php
                    $comic = $history->comic;
                    $chapter = $history->chapter;
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

                        {{-- Continue Reading Badge --}}
                        @if($chapter)
                            <div class="absolute bottom-2 left-2 right-2 z-10">
                                <a href="{{ route('chapter.read', $chapter->id) }}" 
                                   class="block w-full px-3 py-1.5 bg-blue-500/90 hover:bg-blue-500 text-white text-xs font-medium rounded-md transition text-center">
                                    Lanjutkan
                                </a>
                            </div>
                        @endif

                        {{-- Remove History Button --}}
                        <form action="{{ route('history.destroy', $history->id) }}" 
                              method="POST" 
                              class="absolute top-2 right-2 z-10"
                              onsubmit="return confirm('Hapus history ini?');">
                            @csrf
                            @method('DELETE')
                            <button 
                                type="submit"
                                class="w-8 h-8 rounded-full bg-black/60 backdrop-blur-sm flex items-center justify-center hover:bg-red-500/80 transition group/btn"
                                title="Hapus history">
                                <svg xmlns="http://www.w3.org/2000/svg" 
                                     fill="none" 
                                     viewBox="0 0 24 24" 
                                     stroke-width="2" 
                                     stroke="currentColor" 
                                     class="w-4 h-4 text-white group-hover/btn:text-white">
                                    <path stroke-linecap="round" stroke-linejoin="round" 
                                          d="M6 18L18 6M6 6l12 12" />
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

                        {{-- Last Read Chapter --}}
                        @if($chapter)
                            <div class="text-xs text-gray-400 pt-1">
                                <span class="font-medium text-blue-400">Ch. {{ $chapter->chapter_number }}</span>
                                @if($chapter->title)
                                    <div class="text-gray-500 truncate mt-0.5" title="{{ $chapter->title }}">
                                        {{ Str::limit($chapter->title, 25, '...') }}
                                    </div>
                                @endif
                                @if($history->last_viewed_page)
                                    <div class="text-gray-500 mt-0.5">
                                        Page {{ $history->last_viewed_page }}
                                    </div>
                                @endif
                            </div>
                        @endif

                        {{-- Last Read Date --}}
                        <div class="text-xs text-gray-500 pt-1 border-t border-[#21262d]">
                            {{ $history->updated_at->diffForHumans() }}
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- Pagination --}}
        <div class="mt-8">
            {{ $histories->links('vendor.pagination.custom') }}
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
                      d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <p class="text-gray-500 text-lg mb-2">Belum ada history</p>
            <p class="text-gray-400 text-sm mb-6">Mulai membaca komik untuk melihat history di sini.</p>
            <a href="{{ route('home') }}" 
               class="inline-block px-6 py-2 bg-blue-500 hover:bg-blue-600 text-white rounded-md transition">
                Jelajahi Komik
            </a>
        </div>
    @endif

</div>
@endsection

