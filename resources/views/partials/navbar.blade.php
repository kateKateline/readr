<nav id="navbar" class="fixed w-full z-50 transition-all duration-300 bg-black text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <div class="flex items-center">
                <span class="text-3xl font-manga font-bold tracking-wider">READR</span>
            </div>

            <div class="hidden md:flex items-center space-x-8">
                <a href="{{ route('home') }}" class="hover:text-purple-400 transition-colors duration-200 font-medium">Home</a>
                <a href="#features" class="hover:text-purple-400 transition-colors duration-200 font-medium">Features</a>
                <a href="#library" class="hover:text-purple-400 transition-colors duration-200 font-medium">Library</a>
                <a href="#community" class="hover:text-purple-400 transition-colors duration-200 font-medium">Community</a>

                @if($user)
                    <div class="relative">
                        <button id="profile-btn" class="flex items-center space-x-2 hover:text-purple-400 transition-colors focus:outline-none">
                            <img src="{{ asset('images/' . $user->profile) }}" 
                                 alt="Profile" 
                                 class="w-8 h-8 rounded-full border border-gray-500">
                            <span class="font-medium">{{ $user->username }}</span>
                            <svg class="w-4 h-4 mt-0.5" fill="none" stroke="currentColor" stroke-width="2"
                                 viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round"
                                 d="M19 9l-7 7-7-7" /></svg>
                        </button>

                        <div id="profile-menu"
                             class="hidden absolute right-0 mt-2 w-40 bg-black border border-gray-800 rounded-sm shadow-lg py-2 transition-all duration-300 origin-top transform scale-95">
                            <a href="{{ route('profile') }}" class="block px-4 py-2 text-sm hover:bg-gray-800 rounded-md">Profile</a>
                            <a href="#" class="block px-4 py-2 text-sm hover:bg-gray-800 rounded-md">Settings</a>
                            <a href="{{ route('logout') }}" class="block px-4 py-2 text-sm text-red-400 hover:bg-gray-800 rounded-md">Sign Out</a>
                        </div>
                    </div>
                @else
                    <a href="{{ route('signup.form') }}" class="hover:text-purple-400 duration-200 font-medium">Sign Up</a>
                @endif
            </div>

            <button id="mobile-menu-btn" class="md:hidden p-2 rounded-lg hover:bg-gray-800 transition-colors">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path id="menu-icon" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
        </div>
    </div>

    <div id="mobile-menu" class="hidden md:hidden bg-black border-t border-gray-800">
        <div class="px-4 py-4 space-y-3">
            <a href="#home" class="block py-2 hover:text-purple-400 transition-colors">Home</a>
            <a href="#features" class="block py-2 hover:text-purple-400 transition-colors">Features</a>
            <a href="#library" class="block py-2 hover:text-purple-400 transition-colors">Library</a>
            <a href="#community" class="block py-2 hover:text-purple-400 transition-colors">Community</a>

            @if($user)
                <a href="{{ route('profile') }}" class="block py-2 hover:text-purple-400 transition-colors">Profile</a>
                <a href="{{ route('logout') }}" class="block py-2 text-red-400 hover:text-red-500">Sign Out</a>
            @else
                <a href="{{ route('signup.form') }}" class="block py-2 hover:text-purple-400 transition-colors">Sign Up</a>
            @endif
        </div>
    </div>
</nav>