<header class="bg-[#161b22] border-b border-[#30363d]">
    <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
        <!-- Logo -->
        <a href="/" class="text-2xl font-bold text-white hover:text-blue-400 transition">
            Readr<span class="text-blue-500">.</span>
        </a>

        @auth
    @if (Auth::user()->level === 'admin')
        <a href="{{ route('dashboard') }}" class="text-sm text-white border border-[#30363d] px-3 py-2 rounded-lg hover:bg-blue-600 hover:border-blue-600 transition">
            Dashboard
        </a>
    @endif
@endauth


        <!-- Navigation -->
        <nav class="space-x-6 hidden md:block">
            <a href="/" class="hover:text-blue-400 transition">Home</a>
            <a href="#" class="hover:text-blue-400 transition">Explore</a>
            <a href="#" class="hover:text-blue-400 transition">About</a>
            <a href="#" class="hover:text-blue-400 transition">Contact</a>
        </nav>

        <!-- Button -->
<div class="flex items-center gap-3">
    @auth
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="text-sm text-white border border-[#30363d] px-3 py-2 rounded-lg hover:bg-blue-600 hover:border-blue-600 transition">
                Logout
            </button>
        </form>
    @else
        <a href="{{ route('login') }}" class="text-sm text-white border border-[#30363d] px-3 py-2 rounded-lg hover:bg-blue-600 hover:border-blue-600 transition">
            Login
        </a>
    @endauth
</div>
    </div>
</header>
