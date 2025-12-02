@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-6 py-12 text-[#c9d1d9]">

    {{-- Header Section (Cover, Title, Tags, Synopsis, Rating, Details) --}}
    <div class="flex flex-col md:flex-row gap-6 mb-8 p-6 bg-[#161b22] border border-[#30363d] rounded-md">

        {{-- Cover Image --}}
        <div class="w-full md:w-48 flex-shrink-0">
            <img
                src="{{ $comic->image ?? 'https://via.placeholder.com/192x288?text=Cover+Not+Found' }}"
                alt="Cover of {{ $comic->title }}"
                class="w-full h-auto object-cover rounded-md border border-[#30363d] aspect-[2/3]">
        </div>

        {{-- Title, Tags, Synopsis, Details --}}
        <div class="flex-1 min-w-0">
            <div class="flex justify-between items-start mb-4">
                {{-- Title, Author, & TAGS --}}
                <div class="flex-1 pr-4">
                    <h1 class="text-3xl font-semibold text-white break-words">{{ $comic->title }}</h1>
                    <p class="text-sm text-[#8b949e] mb-2">
                        <span class="font-medium">Author:</span> {{ $comic->author ?? 'Unknown' }}
                    </p>

                    {{-- Genres Section (from database) --}}
                    @php
                    $genres = !empty($comic->genre) 
                        ? array_map('trim', explode(',', $comic->genre))
                        : [];
                    $visibleGenresCount = 3;
                    @endphp
                    @if(!empty($genres))
                    <div id="tag-container" class="flex flex-wrap gap-1 mb-4">
                        @foreach ($genres as $index => $genre)
                        <span class="tag-item inline-block px-2 py-0.5 text-xs font-medium bg-[#21262d] text-[#58a6ff] rounded-full border border-[#30363d] {{ $index >= $visibleGenresCount ? 'hidden' : '' }}" data-tag-index="{{ $index }}">
                            {{ $genre }}
                        </span>
                        @endforeach
                        @if (count($genres) > $visibleGenresCount)
                        <button id="show-more-tags" class="px-2 py-0.5 text-xs font-medium bg-[#21262d] text-[#8b949e] rounded-full border border-[#30363d] hover:text-white transition-colors">
                            >
                        </button>
                        @endif
                    </div>
                    @endif
                </div>

                {{-- Rating --}}
                <div class="flex-shrink-0 text-center ml-4">
                    <div class="w-14 h-14 rounded-full bg-green-600 flex items-center justify-center border-2 border-green-400">
                        <span class="text-xl font-bold text-white">
                            {{ number_format($comic->rating ?? 0.0, 1) }}
                        </span>
                    </div>
                    <p class="text-xs text-[#8b949e] mt-1">{{ $comic->rating_count ?? 0 }} Votes</p>
                </div>
            </div>

            {{-- Sinopsis --}}
            <div class="mb-6">
                <h2 class="text-lg font-medium mb-1 text-white">Synopsis</h2>
                <p class="text-[#c9d1d9] text-sm leading-relaxed text-ellipsis">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                </p>
            </div>

            {{-- Details Section (Status, Type, Released, Timestamps) --}}
            <div class="grid grid-cols-2 gap-y-1 gap-x-4 text-sm">
                <p class="text-[#8b949e]"><span class="font-medium text-white">Status:</span> {{ $comic->status ?? 'N/A' }}</p>
                <p class="text-[#8b949e]"><span class="font-medium text-white">Type:</span> {{ $comic->type ?? 'N/A' }}</p>
                <p class="text-[#8b949e]"><span class="font-medium text-white">Released:</span> {{ \Carbon\Carbon::parse($comic->created_at)->year ?? 'N/A' }}</p>
                <p class="text-[#8b949e]"><span class="font-medium text-white">Updated At:</span> {{ $comic->last_update ? \Carbon\Carbon::parse($comic->last_update)->diffForHumans() : 'N/A' }}</p>
                <p class="text-[#8b949e]"><span class="font-medium text-white">Added At:</span> {{ $comic->created_at ? \Carbon\Carbon::parse($comic->created_at)->diffForHumans() : 'N/A' }}</p>
            </div>
        </div>
    </div>

    {{-- Chapter List Section --}}
    <div class="bg-[#161b22] border border-[#30363d] rounded-md">

        {{-- Language Tabs (Sort By Dihapus) --}}
        <div class="flex justify-start border-b border-b-[#30363d] px-6 pt-4 pb-0 overflow-x-auto whitespace-nowrap">
            <nav class="flex space-x-2 flex-shrink-0" role="tablist">
                @foreach ($availableLanguages as $lang)
                <button
                    id="tab-{{ $lang }}"
                    data-lang="{{ $lang }}"
                    class="tab-btn py-2 px-4 text-sm font-medium border-b-2
                    {{ $lang === $defaultLanguage ? 'border-blue-500 text-white' : 'border-transparent text-[#8b949e] hover:text-white hover:border-[#8b949e]' }}
                    focus:outline-none transition-colors duration-150"
                    role="tab"
                    aria-controls="panel-{{ $lang }}"
                    aria-selected="{{ $lang === $defaultLanguage ? 'true' : 'false' }}">
                    {{ $languageLabels[$lang] }} ({{ $chaptersByLanguage[$lang]->count() }})
                </button>
                @endforeach
            </nav>

            {{-- Bagian Sort By Dihapus --}}
        </div>

        {{-- Chapter Content --}}
        <div class="p-4">
            @foreach ($availableLanguages as $lang)
            <div
                id="panel-{{ $lang }}"
                role="tabpanel"
                aria-labelledby="tab-{{ $lang }}"
                class="chapter-panel 
                        {{ $lang === $defaultLanguage ? 'block' : 'hidden' }} 
                        space-y-1">
                @php
                // Kelompokkan chapter berdasarkan volume, lalu chapter_number
                $chaptersGrouped = $chaptersByLanguage[$lang]
                ->groupBy('volume')
                ->sortKeys();
                @endphp

                <div class="chapter-list-container space-y-3" data-lang="{{ $lang }}">
                    @forelse ($chaptersGrouped as $volume => $volumeChapters)

                    {{-- Volume Header --}}
                    <div class="volume-section" data-volume="{{ $volume ?? 'none' }}">
                        <div class="text-sm font-semibold text-blue-500 mb-2 px-2">
                            Volume {{ $volume ?? 'N/A' }}
                        </div>

                        {{-- Chapters dalam Volume ini --}}
                        <div class="space-y-1">
                            @php
                            $chaptersByNumber = $volumeChapters->groupBy('chapter_number');
                            @endphp

                            @foreach ($chaptersByNumber as $chapterNumber => $chapters)
                            @php
                            $hasAltLink = $chapters->contains(function($ch) {
                            return !empty($ch->external_url);
                            });
                            @endphp

                            @if ($chapters->count() > 1)
                            {{-- Jika ada lebih dari 1 versi (Dropdown) --}}
                            <div class="relative chapter-dropdown" data-chapter-number="{{ $chapterNumber }}" data-volume="{{ $volume ?? 'none' }}" data-has-alt="{{ $hasAltLink ? 'true' : 'false' }}">
                                <button class="w-full flex justify-between items-center p-2.5 text-sm bg-[#21262d] hover:bg-[#30363d] rounded-md border border-[#30363d] text-white transition-colors">
                                    <span class="font-medium pr-2">
                                        Chapter {{ $chapterNumber }}: {{ $chapters->first()->title ?? 'Multiple Versions' }} ({{ $chapters->count() }} versions)
                                    </span>
                                    <span class="text-xs text-[#8b949e] ml-auto flex items-center">
                                        <svg class="w-3.5 h-3.5 transition-transform transform rotate-0 dropdown-arrow" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                        </svg>
                                    </span>
                                </button>

                                {{-- Dropdown Content - Garis Vertikal Ditambahkan di sini --}}
                                <div class="dropdown-content hidden mt-1 bg-[#161b22] border border-[#30363d] rounded-md shadow-xl max-h-64 overflow-y-auto **border-l-2 border-l-[#30363d]**" style="margin-left: 1rem; width: calc(100% - 1rem);">
                                    @foreach ($chapters as $chapter)
                                    <a
                                        href="{{ $chapter->external_url ?: route('chapter.read', ['chapter' => $chapter->id]) }}"
                                        class="block p-2.5 text-xs hover:bg-[#21262d] border-b-[#21262d] last:border-b-0 transition-colors"
                                        target="{{ $chapter->external_url ? '_blank' : '_self' }}"
                                        data-sort-chapter="{{ $chapter->chapter_number }}"
                                        data-sort-volume="{{ $chapter->volume ?? 'none' }}"
                                        data-sort-alternate-link="{{ !empty($chapter->external_url) ? 'true' : 'false' }}">
                                        <div class="flex items-start justify-between">
                                            <div class="flex-1">
                                                <span class="text-white font-medium block mb-1">
                                                    {{ $chapter->title ?: 'No Title' }}
                                                </span>
                                                <span class="text-[#8b949e] text-[10px]">
                                                    @if ($chapter->external_url)
                                                    <span class="text-yellow-400">⚠ Alternate Link</span>
                                                    @else
                                                    <span class="text-green-400">✓ Available</span>
                                                    @endif
                                                </span>
                                            </div>
                                            <span class="text-[10px] text-[#6e7681] ml-2 whitespace-nowrap">
                                                {{ \Carbon\Carbon::parse($chapter->publish_at)->format('M d, Y') }}
                                            </span>
                                        </div>
                                    </a>
                                    @endforeach
                                </div>
                            </div>
                            @else
                            {{-- Jika hanya 1 versi (Single Link) --}}
                            @php $chapter = $chapters->first(); @endphp
                            <a
                                href="{{ $chapter->external_url ?: route('chapter.read', ['chapter' => $chapter->id]) }}"
                                class="chapter-single flex justify-between items-center p-2.5 text-sm hover:bg-[#21262d] rounded-md border-b-[#21262d] last:border-b-0 transition-colors"
                                target="{{ $chapter->external_url ? '_blank' : '_self' }}"
                                data-chapter-number="{{ $chapterNumber }}"
                                data-volume="{{ $volume ?? 'none' }}"
                                data-has-alt="{{ $chapter->external_url ? 'true' : 'false' }}">
                                <span class="font-medium text-white break-all pr-2">
                                    Chapter {{ $chapter->chapter_number }}: {{ $chapter->title ?? 'No Title' }}
                                </span>

                                <div class="flex items-center text-xs text-[#8b949e] flex-shrink-0 ml-auto">
                                    {{-- Tampilkan Alternate Link jika ada --}}
                                    @if ($chapter->external_url)
                                    <span class="text-yellow-400 mr-2">⚠ Alternate Link</span>
                                    @endif

                                    <span class="ml-auto">
                                        {{ \Carbon\Carbon::parse($chapter->publish_at)->diffForHumans() }}
                                    </span>
                                </div>
                            </a>
                            @endif
                            @endforeach
                        </div>
                    </div>

                    @empty
                    <p class="text-center py-4 text-[#8b949e]">No chapters available in this language.</p>
                    @endforelse
                </div>

            </div>
            @endforeach
        </div>
    </div>
</div>

@include('partials.chat.comment', ['comic' => $comic, 'comments' => $comments])
@endsection