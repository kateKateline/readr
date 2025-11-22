@php
    /**
     * Simple reader view that displays pages returned by ComicService::getChapterPages
     * Variables: $comic (object or model), $pages (array of urls), $chapterId
     */
@endphp

<x-app-layout>
    <div class="max-w-5xl mx-auto py-6 px-4">
        <div class="flex items-center gap-4 mb-6">
            @if(!empty($comic->image))
                <img src="{{ $comic->image }}" alt="cover" class="w-20 h-28 object-cover rounded" />
            @endif
            <div>
                <h1 class="text-2xl font-bold">{{ $comic->title ?? 'Unknown' }}</h1>
                <p class="text-sm text-slate-300">Chapter: {{ $chapterId }}</p>
                <p class="text-sm text-slate-400">{{ $comic->author ?? '' }}</p>
            </div>
            <div class="ml-auto">
                <a href="{{ route('comic.show', ['mangadex_id' => $comic->mangadex_id]) }}" class="text-sm px-3 py-1 bg-slate-700 rounded">Back</a>
            </div>
        </div>

        @if(empty($pages))
            <div class="p-6 bg-yellow-900 rounded text-yellow-200">Halaman tidak tersedia untuk chapter ini atau gagal mengambil dari CDN. Coba lagi nanti.</div>
        @else
            <div class="space-y-6">
                @foreach($pages as $idx => $p)
                    <div class="w-full flex justify-center">
                        <img src="{{ $p }}" alt="Page {{ $idx+1 }}" class="max-w-full shadow-md rounded" loading="lazy" />
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</x-app-layout>
