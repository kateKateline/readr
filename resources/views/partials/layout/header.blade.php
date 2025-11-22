<header class="bg-[#0d1117]/95 backdrop-blur-sm border-b border-[#21262d] sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
        <!-- Logo -->
        <a href="/" class="text-xl font-semibold text-white hover:text-gray-300 transition">
            Readr<span class="text-blue-500">.</span>
        </a>

        <!-- Navigation -->
        <nav class="space-x-6 hidden md:block text-base">
            <a href="/" class="text-white">Home</a>
            <a href="#" class="text-white">Explore</a>
            <a href="#" class="text-white">About</a>
            <a href="#" class="text-white">Contact</a>
        </nav>

        <!-- Right Section -->
        <div class="relative flex items-center gap-3">
            @auth
                {{-- Tombol dashboard (jika admin) --}}
                @if (Auth::user()->level === 'admin')
                    <a href="{{ route('dashboard') }}" 
                       class="hidden sm:inline text-sm text-gray-400 hover:text-gray-200 border border-[#21262d] px-4 py-2 rounded-md hover:border-gray-600 transition">
                        Dashboard
                    </a>
                @endif

                {{-- Profile Dropdown --}}
                <div x-data="{ open: false }" class="relative">
                    <button @click="open = !open" 
                            class="flex items-center gap-3 focus:outline-none group">
                        <!-- Foto profil -->
                        <img src="{{ Auth::user()->profile_image 
                            ? asset('storage/' . Auth::user()->profile_image) 
                            : asset('default-profile.png') }}" 
                            alt="Profile" 
                            class="w-9 h-9 rounded-full border border-[#21262d] object-cover opacity-90 group-hover:opacity-100 transition">
                        
                        <!-- Username -->
                        <span class="text-sm text-gray-300 group-hover:text-white transition hidden sm:block">
                            {{ Auth::user()->name }}
                        </span>
                        
                        <!-- Icon panah -->
                        <svg xmlns="http://www.w3.org/2000/svg" 
                             class="h-4 w-4 text-gray-500 transition-transform duration-200" 
                             :class="open ? 'rotate-180' : ''" 
                             fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                  d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>

                    <!-- Dropdown menu -->
                    <div x-show="open" 
                         x-cloak
                         @click.away="open = false" 
                         x-transition:enter="transition ease-out duration-100"
                         x-transition:enter-start="opacity-0 scale-95"
                         x-transition:enter-end="opacity-100 scale-100"
                         x-transition:leave="transition ease-in duration-75"
                         x-transition:leave-start="opacity-100 scale-100"
                         x-transition:leave-end="opacity-0 scale-95"
                         class="absolute right-0 mt-2 w-48 bg-[#161b22] border border-[#21262d] rounded-lg shadow-xl z-50 overflow-hidden">
                        <!-- Menu items -->
                        <div class="py-1">
                            <a href="{{ route('profile', Auth::user()->id) }}" 
                               class="flex items-center gap-3 px-4 py-2.5 text-sm text-gray-300 hover:bg-[#1c2128] transition">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" 
                                     stroke-width="1.5" stroke="currentColor" class="w-4 h-4 text-gray-500">
                                    <path stroke-linecap="round" stroke-linejoin="round" 
                                          d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.5 20.25a8.25 8.25 0 0115 0" />
                                </svg>
                                Profile
                            </a>

                            <a href="#" 
                               class="flex items-center gap-3 px-4 py-2.5 text-sm text-gray-300 hover:bg-[#1c2128] transition">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" 
                                     stroke-width="1.5" stroke="currentColor" class="w-4 h-4 text-gray-500">
                                    <path stroke-linecap="round" stroke-linejoin="round" 
                                          d="M17.593 3.322c1.1.128 1.907 1.077 1.907 2.185V21L12 17.25 4.5 21V5.507c0-1.108.806-2.057 1.907-2.185a48.507 48.507 0 0111.186 0z" />
                                </svg>
                                Bookmarks
                            </a>

                            <div class="border-t border-[#21262d] my-1"></div>

                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" 
                                    class="flex items-center gap-3 w-full px-4 py-2.5 text-sm text-gray-300 hover:bg-[#1c2128] hover:text-gray-200 transition">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" 
                                         stroke-width="1.5" stroke="currentColor" class="w-4 h-4 text-gray-500">
                                        <path stroke-linecap="round" stroke-linejoin="round" 
                                              d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75" />
                                    </svg>
                                    Logout
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @else
                <a href="{{ route('login') }}" 
                   class="text-sm text-gray-400 hover:text-gray-200 border border-[#21262d] px-4 py-2 rounded-md hover:border-gray-600 transition">
                    Login
                </a>
            @endauth
        </div>
    </div>
</header>