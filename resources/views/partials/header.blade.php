    <!-- Navbar -->
    <nav class="bg-white shadow-md sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center">
                    <h1 class="text-xl sm:text-2xl font-bold text-[#3E5F44]">Readr</h1>
                </div>
                <div class="flex items-center space-x-2 sm:space-x-4">
                    <a href="#" class="hidden md:block text-gray-700 hover:text-[#5E936C] font-medium transition">Home</a>
                    <a href="#" class="hidden md:block text-gray-700 hover:text-[#5E936C] font-medium transition">Manga</a>
                    <a href="#" class="hidden md:block text-gray-700 hover:text-[#5E936C] font-medium transition">Manhwa</a>
                    <a href="#" class="hidden md:block text-gray-700 hover:text-[#5E936C] font-medium transition">Manhua</a>
                    <button class="bg-[#3E5F44] text-white px-4 sm:px-6 py-2 rounded-full hover:bg-[#5E936C] transition text-sm sm:text-base">
                        Login
                    </button>
                    <a href="{{ route('logout.get') }}" class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600">test</a>
                </div>
            </div>
        </div>
    </nav>