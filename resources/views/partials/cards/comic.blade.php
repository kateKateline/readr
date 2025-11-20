@foreach($comics as $item)
    <a href="{{ route('comic.show', $item['mangadex_id'])}}" 
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
                    $lang = strtolower($item['type'] ?? 'unknown');
                    $flag = $flags[$lang] ?? '?';
                @endphp

                <span class="inline-block px-2 py-1 bg-black/60 backdrop-blur-sm rounded-md text-xl">
                    {{ $flag }}
                </span>
            </div>

            <!-- Favorite Icon -->
            <button 
                type="button"
                class="absolute top-2 right-2 z-10 w-8 h-8 rounded-full bg-black/40 backdrop-blur-sm flex items-center justify-center hover:bg-black/60 transition">
                <svg xmlns="http://www.w3.org/2000/svg" 
                     fill="none" viewBox="0 0 24 24" stroke-width="2" 
                     stroke="currentColor" class="w-5 h-5 text-white">
                    <path stroke-linecap="round" stroke-linejoin="round" 
                          d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />
                </svg>
            </button>

            <!-- Cover -->
            <img 
                src="{{ $item['image'] }}"
                alt="{{ $item['title'] }}"
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
                title="{{ $item['title'] }}">
                {{ Str::limit($item['title'], 40, '...') }}
            </h3>

            <!-- Author -->
            <p class="text-xs text-gray-400 truncate flex items-center gap-1" title="{{ $item['author'] ?? 'Unknown Author' }}">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-3.5 h-3.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                </svg>
                <span>{{ $item['author'] ?? 'Unknown Author' }}</span>
            </p>

            <!-- Last Update -->
            @if(!empty($item['last_update']) && !empty($item['last_chapter']))
                <div class="flex items-center justify-between text-xs text-gray-400 pt-2 border-t border-[#21262d]">
                    <span class="font-medium">
                        Ch. {{ $item['last_chapter'] }}
                    </span>
                    <span>
                        {{ formatShortDate($item['last_update']) }}
                    </span>
                </div>  
            @endif  
        </div>
    </a>
@endforeach