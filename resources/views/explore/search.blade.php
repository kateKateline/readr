{{-- resources/views/comics/browse.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-6 py-8">
    <!-- Header -->
    <div class="mb-6">
        <h1 class="text-3xl font-bold text-[#58a6ff] mb-2">Browse Comics</h1>
        <p class="text-[#8b949e]">Discover your next favorite story</p>
    </div>

    <!-- Comic Count -->
    <div class="bg-[#161b22] border border-[#30363d] rounded-lg p-4 mb-6">
        <div class="flex items-center gap-2">
            <div class="w-1 h-4 bg-[#58a6ff]"></div>
            <span class="font-semibold text-[#c9d1d9]">{{ $total }} Comics</span>
        </div>
    </div>

    <!-- Search Form -->
    <form method="GET" action="{{ route('comics.search') }}" class="bg-[#161b22] border border-[#30363d] rounded-lg p-6">
        <!-- Main Filters -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
            <!-- Search -->
            <div>
                <label class="block text-sm font-medium text-[#c9d1d9] mb-2">SEARCH</label>
                <div class="relative">
                    <input
                        type="text"
                        name="search"
                        placeholder="Search by title, author, artist..."
                        value="{{ request('search') }}"
                        class="w-full px-3 py-2 bg-[#0d1117] border border-[#30363d] rounded-md text-[#c9d1d9] placeholder-[#6e7681] focus:outline-none focus:ring-2 focus:ring-[#58a6ff] focus:border-transparent"
                    />
                    <button type="submit" class="absolute right-2 top-1/2 -translate-y-1/2 bg-[#238636] hover:bg-[#2ea043] text-white p-1.5 rounded transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Status -->
            <div>
                <label class="block text-sm font-medium text-[#c9d1d9] mb-2">STATUS</label>
                <select
                    name="status"
                    class="w-full px-3 py-2 bg-[#0d1117] border border-[#30363d] rounded-md text-[#c9d1d9] focus:outline-none focus:ring-2 focus:ring-[#58a6ff] focus:border-transparent"
                >
                    <option value="">Any</option>
                    <option value="ongoing" {{ request('status') == 'ongoing' ? 'selected' : '' }}>Ongoing</option>
                    <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                    <option value="hiatus" {{ request('status') == 'hiatus' ? 'selected' : '' }}>Hiatus</option>
                    <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                </select>
            </div>

            <!-- Type -->
            <div>
                <label class="block text-sm font-medium text-[#c9d1d9] mb-2">TYPE</label>
                <select
                    name="type"
                    class="w-full px-3 py-2 bg-[#0d1117] border border-[#30363d] rounded-md text-[#c9d1d9] focus:outline-none focus:ring-2 focus:ring-[#58a6ff] focus:border-transparent"
                >
                    <option value="">Any</option>
                    <option value="manga" {{ request('type') == 'manga' ? 'selected' : '' }}>Manga</option>
                    <option value="manhwa" {{ request('type') == 'manhwa' ? 'selected' : '' }}>Manhwa</option>
                    <option value="manhua" {{ request('type') == 'manhua' ? 'selected' : '' }}>Manhua</option>
                </select>
            </div>

            <!-- Sort By -->
            <div>
                <label class="block text-sm font-medium text-[#c9d1d9] mb-2">SORT BY</label>
                <select
                    name="sort"
                    class="w-full px-3 py-2 bg-[#0d1117] border border-[#30363d] rounded-md text-[#c9d1d9] focus:outline-none focus:ring-2 focus:ring-[#58a6ff] focus:border-transparent"
                >
                    <option value="latest_update" {{ request('sort') == 'latest_update' ? 'selected' : '' }}>Latest update</option>
                    <option value="most_popular" {{ request('sort') == 'most_popular' ? 'selected' : '' }}>Most popular</option>
                    <option value="highest_rated" {{ request('sort') == 'highest_rated' ? 'selected' : '' }}>Highest rated</option>
                    <option value="title_asc" {{ request('sort') == 'title_asc' ? 'selected' : '' }}>Title A-Z</option>
                    <option value="title_desc" {{ request('sort') == 'title_desc' ? 'selected' : '' }}>Title Z-A</option>
                </select>
            </div>
        </div>

        <!-- Advanced Filters Toggle -->
        <div class="flex justify-between items-center pt-4 border-t border-[#30363d]" x-data="{ open: {{ request()->hasAny(['include_genres', 'exclude_genres']) ? 'true' : 'false' }} }">
            <button
                type="button"
                @click="open = !open"
                class="text-[#8b949e] hover:text-[#58a6ff] font-medium flex items-center gap-2 transition"
            >
                Advanced filters
                <svg class="w-4 h-4 transition-transform" :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                </svg>
            </button>
            <a href="{{ route('comics.search') }}" class="text-[#58a6ff] hover:text-[#79c0ff] font-medium transition">Reset filters</a>
        </div>

        <!-- Advanced Filters Content -->
        <div x-show="open" x-collapse class="mt-6 grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Include Genres -->
            <div class="border border-[#30363d] rounded-lg p-4 bg-[#0d1117]">
                <h3 class="font-semibold text-[#c9d1d9] mb-2">INCLUDE GENRES</h3>
                <p class="text-sm text-[#8b949e] mb-3">Only show series that match at least one selected genre.</p>
                <div class="flex flex-wrap gap-2 max-h-64 overflow-y-auto thin-scrollbar-dark">
                    @php
                        $selectedInclude = request('include_genres', []);
                    @endphp
                    @foreach($allGenres as $genre)
                        <label class="cursor-pointer">
                            <input
                                type="checkbox"
                                name="include_genres[]"
                                value="{{ $genre }}"
                                {{ in_array($genre, (array)$selectedInclude) ? 'checked' : '' }}
                                class="hidden peer"
                            />
                            <span class="inline-block px-3 py-1.5 rounded-md text-sm bg-[#21262d] text-[#c9d1d9] border border-[#30363d] peer-checked:bg-[#58a6ff] peer-checked:text-white peer-checked:border-[#58a6ff] hover:border-[#58a6ff] transition">
                                {{ $genre }}
                            </span>
                        </label>
                    @endforeach
                </div>
            </div>

            <!-- Exclude Genres -->
            <div class="border border-[#30363d] rounded-lg p-4 bg-[#0d1117]">
                <h3 class="font-semibold text-[#c9d1d9] mb-2">EXCLUDE GENRES</h3>
                <p class="text-sm text-[#8b949e] mb-3">Hide series that contain any of these genres.</p>
                <div class="flex flex-wrap gap-2 max-h-64 overflow-y-auto thin-scrollbar-dark">
                    @php
                        $selectedExclude = request('exclude_genres', []);
                    @endphp
                    @foreach($allGenres as $genre)
                        <label class="cursor-pointer">
                            <input
                                type="checkbox"
                                name="exclude_genres[]"
                                value="{{ $genre }}"
                                {{ in_array($genre, (array)$selectedExclude) ? 'checked' : '' }}
                                class="hidden peer"
                            />
                            <span class="inline-block px-3 py-1.5 rounded-md text-sm bg-[#21262d] text-[#c9d1d9] border border-[#30363d] peer-checked:bg-[#da3633] peer-checked:text-white peer-checked:border-[#da3633] hover:border-[#da3633] transition">
                                {{ $genre }}
                            </span>
                        </label>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Apply Filters Button -->
        <div class="mt-6 flex justify-end">
            <button type="submit" class="px-6 py-2 bg-[#238636] hover:bg-[#2ea043] text-white font-medium rounded-md transition">
                Apply Filters
            </button>
        </div>
    </form>

    <!-- Results -->
    <div class="mt-8">
        @if($comics->count() > 0)
            <div class="grid grid-cols-3 sm:grid-cols-4 md:grid-cols-5 lg:grid-cols-5 gap-3">
                @foreach($comics as $comic)
                    <a href="{{ route('comic.show', $comic->mangadex_id) }}" 
                       class="group relative block rounded-lg overflow-hidden bg-[#161b22] border border-[#21262d] hover:border-[#30363d] transition-all duration-300">
                        
                        <!-- Cover Image -->
                        <div class="aspect-[2/3] overflow-hidden bg-[#0d1117] relative">

                            <!-- Flag Badge -->
                            <div class="absolute top-2 left-2 z-10">
                                @php
                                    $flags = [
                                        'ja' => '🇯🇵', 'jp' => '🇯🇵',
                                        'zh' => '🇨🇳', 'zh-hk' => '🇨🇳',
                                        'ko' => '🇰🇷',
                                        'en' => '🇬🇧',
                                    ];
                                    $lang = strtolower($comic->type ?? 'unknown');
                                    $flag = $flags[$lang] ?? '?';
                                @endphp

                                <span class="inline-block px-2 py-1 bg-black/60 backdrop-blur-sm rounded-md text-xl">
                                    {{ $flag }}
                                </span>
                            </div>

                            <!-- Cover -->
                            <img 
                                src="{{ $comic->image }}"
                                alt="{{ $comic->title }}"
                                class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
                                loading="lazy"
                            >

                            <!-- Hover Gradient -->
                            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent 
                                        opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        </div>
                        
                        <!-- Info -->
                        <div class="p-3 space-y-2">

                            <!-- Title dengan Truncate -->
                            <h3 class="font-medium text-sm text-gray-200 group-hover:text-white transition truncate" 
                                title="{{ $comic->title }}">
                                {{ Str::limit($comic->title, 40, '...') }}
                            </h3>

                            <!-- Last Update -->
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
                        </div>
                    </a>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-8">
                {{ $comics->links('vendor.pagination.custom') }}
            </div>
        @else
            <div class="text-center py-12">
                <p class="text-[#8b949e] text-lg">No comics found matching your filters.</p>
            </div>
        @endif
    </div>
</div>
@endsection