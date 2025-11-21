<div class="bg-[#161b22] border border-[#30363d] rounded-lg shadow-xl overflow-hidden flex flex-col" style="height: 400px;">
    
    {{-- Header --}}
    <div class="border-b border-[#21262d] px-4 py-3 bg-[#0d1117] flex-shrink-0">
        <div class="flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 text-yellow-500">
                <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 18.75h-9m9 0a3 3 0 013 3h-15a3 3 0 013-3m9 0v-3.375c0-.621-.503-1.125-1.125-1.125h-.871M7.5 18.75v-3.375c0-.621.504-1.125 1.125-1.125h.872m5.007 0H9.497m5.007 0a7.454 7.454 0 01-.982-3.172M9.497 14.25a7.454 7.454 0 00.981-3.172M5.25 4.236c-.982.143-1.954.317-2.916.52A6.003 6.003 0 007.73 9.728M5.25 4.236V4.5c0 2.108.966 3.99 2.48 5.228M5.25 4.236V2.721C7.456 2.41 9.71 2.25 12 2.25c2.291 0 4.545.16 6.75.47v1.516M7.73 9.728a6.726 6.726 0 002.748 1.35m8.272-6.842V4.5c0 2.108-.966 3.99-2.48 5.228m2.48-5.492a46.32 46.32 0 012.916.52 6.003 6.003 0 01-5.395 4.972m0 0a6.726 6.726 0 01-2.749 1.35m0 0a6.772 6.772 0 01-3.044 0" />
            </svg>
            <h2 class="font-semibold text-sm text-[#c9d1d9]">Top Ranks</h2>
            <span class="ml-auto text-xs text-gray-500">By Rating</span>
        </div>
    </div>

    {{-- Top Ranks List --}}
    <div class="flex-1 overflow-y-auto px-3 py-2 space-y-0 top-ranks-scrollbar">
        @forelse ($topRanks as $index => $comic)
            <a href="{{ route('comic.show', $comic->mangadex_id) }}" 
               class="flex gap-3 py-2.5 px-2 hover:bg-[#1c2128] rounded-lg transition group border-b border-[#21262d] last:border-b-0">
                
                {{-- Rank Number --}}
                <div class="flex-shrink-0 flex items-center justify-center w-8">
                    @if($index < 3)
                        {{-- Trophy untuk top 3 --}}
                        <div class="text-xl font-bold">
                            @if($index === 0)
                                🥇
                            @elseif($index === 1)
                                🥈
                            @elseif($index === 2)
                                🥉
                            @endif
                        </div>
                    @else
                        {{-- Number untuk sisanya --}}
                        <div class="text-sm font-bold text-gray-500 group-hover:text-gray-400 transition">
                            #{{ $index + 1 }}
                        </div>
                    @endif
                </div>

                {{-- Cover Image --}}
                <div class="flex-shrink-0">
                    <div class="w-12 h-16 rounded overflow-hidden bg-[#0d1117] border border-[#30363d] group-hover:border-blue-500 transition relative">
                        @if($comic->image)
                            <img 
                                src="{{ $comic->image }}" 
                                alt="{{ $comic->title }}"
                                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300"
                                loading="lazy"
                            >
                        @else
                            <div class="w-full h-full flex items-center justify-center text-gray-600">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" />
                                </svg>
                            </div>
                        @endif
                    </div>
                </div>

                {{-- Info --}}
                <div class="flex-1 min-w-0">
                    {{-- Title --}}
                    <h3 class="text-xs font-semibold text-gray-200 group-hover:text-white transition truncate mb-1" 
                        title="{{ $comic->title }}">
                        {{ Str::limit($comic->title, 35, '...') }}
                    </h3>
                    
                    {{-- Rating & Reviews --}}
                    <div class="flex items-center gap-2 mb-1">
                        <div class="flex items-center gap-1">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-3.5 h-3.5 text-yellow-500">
                                <path fill-rule="evenodd" d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.007 5.404.433c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.433 2.082-5.006z" clip-rule="evenodd" />
                            </svg>
                            <span class="text-xs font-bold text-yellow-500">
                                {{ number_format($comic->rating ?? 0, 2) }}
                            </span>
                        </div>
                        @if($comic->rating_count)
                            <span class="text-[10px] text-gray-500">
                                ({{ number_format($comic->rating_count) }} reviews)
                            </span>
                        @endif
                    </div>

                    {{-- Author --}}
                    @if($comic->author)
                        <p class="text-[10px] text-gray-500 truncate" title="{{ $comic->author }}">
                            {{ Str::limit($comic->author, 30, '...') }}
                        </p>
                    @endif
                </div>

                {{-- Flag Badge --}}
                <div class="flex-shrink-0 self-start">
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
                    <span class="text-lg" title="{{ strtoupper($comic->type ?? 'unknown') }}">
                        {{ $flag }}
                    </span>
                </div>
            </a>
        @empty
            <div class="flex flex-col items-center justify-center h-full text-center px-4">
                <svg class="w-12 h-12 text-gray-600 mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" 
                          d="M16.5 18.75h-9m9 0a3 3 0 013 3h-15a3 3 0 013-3m9 0v-3.375c0-.621-.503-1.125-1.125-1.125h-.871M7.5 18.75v-3.375c0-.621.504-1.125 1.125-1.125h.872m5.007 0H9.497m5.007 0a7.454 7.454 0 01-.982-3.172M9.497 14.25a7.454 7.454 0 00.981-3.172M5.25 4.236c-.982.143-1.954.317-2.916.52A6.003 6.003 0 007.73 9.728M5.25 4.236V4.5c0 2.108.966 3.99 2.48 5.228M5.25 4.236V2.721C7.456 2.41 9.71 2.25 12 2.25c2.291 0 4.545.16 6.75.47v1.516M7.73 9.728a6.726 6.726 0 002.748 1.35m8.272-6.842V4.5c0 2.108-.966 3.99-2.48 5.228m2.48-5.492a46.32 46.32 0 012.916.52 6.003 6.003 0 01-5.395 4.972m0 0a6.726 6.726 0 01-2.749 1.35m0 0a6.772 6.772 0 01-3.044 0" />
                </svg>
                <p class="text-sm text-gray-400 mb-1">No rankings yet</p>
                <p class="text-xs text-gray-500">Sync data to see top rated manga! 🏆</p>
            </div>
        @endforelse
    </div>

    {{-- Footer --}}
    <div class="border-t border-[#21262d] px-4 py-2.5 bg-[#0d1117] flex-shrink-0">
        <div class="text-[10px] text-gray-500 text-center">
            Updated with Bayesian rating system
        </div>
    </div>
</div>

<style>
/* Custom scrollbar untuk top ranks */
.top-ranks-scrollbar {
    scrollbar-width: thin;
    scrollbar-color: #30363d transparent;
}

.top-ranks-scrollbar::-webkit-scrollbar {
    width: 6px;
}

.top-ranks-scrollbar::-webkit-scrollbar-track {
    background: transparent;
}

.top-ranks-scrollbar::-webkit-scrollbar-thumb {
    background: #30363d;
    border-radius: 3px;
}

.top-ranks-scrollbar::-webkit-scrollbar-thumb:hover {
    background: #484f58;
}

.top-ranks-scrollbar {
    scroll-behavior: smooth;
}
</style>