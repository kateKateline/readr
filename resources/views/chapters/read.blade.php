@extends('layouts.app')

@section('content')
<div class="chapter-read-page">
    <!-- Chapter Header -->
    <div class="container mx-auto px-4 py-4">
        <div class="max-w-4xl mx-auto">
            <h1 class="text-2xl font-bold text-white mb-2">
                Chapter {{ $chapter->chapter_number }} — {{ $chapter->title }}
            </h1>
            <p class="text-gray-400 text-sm">
                <a href="{{ route('comic.show', $comic->mangadex_id) }}" class="hover:text-blue-400 transition">
                    {{ $comic->title }}
                </a>
            </p>
        </div>
    </div>

    <!-- Images Container -->
    <div class="container mx-auto px-4">
        <div class="max-w-4xl mx-auto space-y-4">
            @foreach ($images as $img)
                <img src="{{ $img }}" class="w-full rounded shadow-lg" loading="lazy" alt="Page {{ $loop->iteration }}">
            @endforeach
        </div>
    </div>

    <!-- Next/Previous Chapter Navigation -->
    <div class="container mx-auto px-4 py-8">
        <div class="max-w-4xl mx-auto">
            <div class="flex justify-between items-center gap-4">
                <!-- Previous Chapter -->
                @if($previousChapter)
                    <a href="{{ route('chapter.read', $previousChapter->id) }}" 
                       class="flex items-center gap-3 bg-[#161b22] hover:bg-[#1c2128] border border-[#30363d] hover:border-blue-500/50 text-gray-300 hover:text-white px-6 py-3 rounded-lg transition-all duration-200 shadow-md hover:shadow-lg group">
                        <svg class="w-5 h-5 transform group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                        </svg>
                        <div class="text-left">
                            <div class="text-xs text-gray-500 group-hover:text-gray-400">Previous</div>
                            <div class="font-semibold">Chapter {{ $previousChapter->chapter_number }}</div>
                        </div>
                    </a>
                @else
                    <div class="flex-1"></div>
                @endif

                <!-- Back to Comic -->
                <a href="{{ route('comic.show', $comic->mangadex_id) }}" 
                   class="flex items-center gap-2 bg-[#161b22] hover:bg-[#1c2128] border border-[#30363d] hover:border-blue-500/50 text-gray-300 hover:text-white px-4 py-3 rounded-lg transition-all duration-200 shadow-md hover:shadow-lg">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                    <span class="font-semibold">Back to Comic</span>
                </a>

                <!-- Next Chapter -->
                @if($nextChapter)
                    <a href="{{ route('chapter.read', $nextChapter->id) }}" 
                       class="flex items-center gap-3 bg-[#161b22] hover:bg-[#1c2128] border border-[#30363d] hover:border-blue-500/50 text-gray-300 hover:text-white px-6 py-3 rounded-lg transition-all duration-200 shadow-md hover:shadow-lg group">
                        <div class="text-right">
                            <div class="text-xs text-gray-500 group-hover:text-gray-400">Next</div>
                            <div class="font-semibold">Chapter {{ $nextChapter->chapter_number }}</div>
                        </div>
                        <svg class="w-5 h-5 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </a>
                @else
                    <div class="flex-1"></div>
                @endif
            </div>
        </div>
    </div>

    <!-- Comments Section -->
    <div class="container mx-auto px-4 py-8 border-t border-[#21262d]">
        <div class="max-w-4xl mx-auto">
            @include('partials.chat.comment', ['comic' => $comic, 'comments' => $comments])
        </div>
    </div>
</div>
@endsection
