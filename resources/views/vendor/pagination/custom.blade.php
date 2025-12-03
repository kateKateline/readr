{{-- resources/views/vendor/pagination/custom.blade.php (Gaya Tema Gelap) --}}

@if ($paginator->hasPages())
    {{-- PENAMBAHAN KELAS bg-[#161b22] DI SINI --}}
    <nav role="navigation" aria-label="Pagination Navigation" class="flex items-center justify-between px-4 py-3 border-t border-[#30363d] sm:px-6 **bg-[#161b22]**">
        <div class="flex-1 flex justify-between items-center">
            
            {{-- Informasi Halaman --}}
            <div>
                <p class="text-sm text-[#8b949e]">
                    Menampilkan
                    <span class="font-medium text-[#c9d1d9]">{{ $paginator->firstItem() }}</span>
                    sampai
                    <span class="font-medium text-[#c9d1d9]">{{ $paginator->lastItem() }}</span>
                    dari
                    <span class="font-medium text-[#c9d1d9]">{{ $paginator->total() }}</span>
                    hasil
                </p>
            </div>

            {{-- Tombol Navigasi & Nomor Halaman --}}
            <div class="flex space-x-1 items-center">
                
                {{-- Previous Page Link --}}
                @if ($paginator->onFirstPage())
                    <span class="relative inline-flex items-center px-3 py-1 border border-[#30363d] text-sm font-medium rounded-md text-[#6e7681] bg-[#161b22] cursor-default">
                        &laquo; Sebelumnya
                    </span>
                @else
                    <a href="{{ $paginator->previousPageUrl() }}" 
                        class="relative inline-flex items-center px-3 py-1 border border-[#30363d] text-sm font-medium rounded-md text-[#c9d1d9] bg-[#161b22] hover:bg-[#21262d] transition duration-300">
                        &laquo; Sebelumnya
                    </a>
                @endif

                {{-- Pagination Elements (Nomor Halaman) --}}
                <div class="hidden md:inline-flex space-x-1">
                    @foreach ($elements as $element)
                        
                        {{-- "Three Dots" Separator --}}
                        @if (is_string($element))
                            <span class="relative inline-flex items-center px-3 py-1 border border-[#30363d] text-sm font-medium text-[#6e7681] bg-[#161b22] cursor-default">
                                {{ $element }}
                            </span>
                        @endif

                        {{-- Array Of Links --}}
                        @if (is_array($element))
                            @foreach ($element as $page => $url)
                                @if ($page == $paginator->currentPage())
                                    <span aria-current="page" 
                                            class="relative inline-flex items-center px-3 py-1 border border-[#58a6ff] text-sm font-medium rounded-md text-white bg-[#58a6ff] cursor-default">
                                        {{ $page }}
                                    </span>
                                @else
                                    <a href="{{ $url }}" 
                                        class="relative inline-flex items-center px-3 py-1 border border-[#30363d] text-sm font-medium rounded-md text-[#c9d1d9] bg-[#161b22] hover:bg-[#21262d] transition duration-300" 
                                        aria-label="Go to page {{ $page }}">
                                        {{ $page }}
                                    </a>
                                @endif
                            @endforeach
                        @endif
                    @endforeach
                </div>
                

                {{-- Next Page Link --}}
                @if ($paginator->hasMorePages())
                    <a href="{{ $paginator->nextPageUrl() }}" 
                        class="relative inline-flex items-center px-3 py-1 border border-[#30363d] text-sm font-medium rounded-md text-[#c9d1d9] bg-[#161b22] hover:bg-[#21262d] transition duration-300">
                        Berikutnya &raquo;
                    </a>
                @else
                    <span class="relative inline-flex items-center px-3 py-1 border border-[#30363d] text-sm font-medium rounded-md text-[#6e7681] bg-[#161b22] cursor-default">
                        Berikutnya &raquo;
                    </span>
                @endif
            </div>
        </div>
    </nav>
@endif