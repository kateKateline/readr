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