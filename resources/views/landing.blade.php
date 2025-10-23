@extends('layouts.main')

@section('title', 'Landing Page')

@section('content')
<!-- Hero Section with Slider -->
<section class="hero-slider gradient-bg text-white relative" style="min-height: 400px;">
    <button class="slider-arrow left" onclick="changeSlide(-1)">‹</button>
    <button class="slider-arrow right" onclick="changeSlide(1)">›</button>
    
    <div class="hero-slides-container" style="min-height: 400px;">
        <!-- Slide 1 - Welcome -->
        <div class="hero-slide active">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center py-12 sm:py-20">
                <h2 class="text-3xl sm:text-5xl font-bold mb-4 sm:mb-6">Selamat Datang di Readr</h2>
                <p class="text-base sm:text-xl mb-3 sm:mb-4 max-w-3xl mx-auto leading-relaxed px-4">
                    Platform terbaik untuk membaca komik digital dari seluruh dunia. Nikmati ribuan judul manga dari Jepang, 
                    manhwa dari Korea, dan manhua dari China dalam satu tempat.
                </p>
                <p class="text-sm sm:text-lg mb-6 sm:mb-8 max-w-2xl mx-auto opacity-90 px-4">
                    Baca gratis, update setiap hari, dan temukan cerita favoritmu!
                </p>
                <button class="bg-white text-[#3E5F44] px-6 sm:px-8 py-2 sm:py-3 rounded-full font-semibold text-base sm:text-lg hover:bg-[#93DA97] hover:text-white transition">
                    Mulai Membaca
                </button>
            </div>
        </div>
        <!-- Slide 2 - Events -->
        <div class="hero-slide">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 sm:py-20">
                <h2 class="text-3xl sm:text-5xl font-bold mb-4 sm:mb-8 text-center">🎉 Event Spesial</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 sm:gap-6">
                    <div class="event-card bg-white/10 backdrop-blur-sm rounded-2xl p-4 sm:p-6 border border-white/20">
                        <div class="text-3xl sm:text-4xl mb-3 sm:mb-4">🎁</div>
                        <h3 class="text-xl sm:text-2xl font-bold mb-2 sm:mb-3">Daily Login Bonus</h3>
                        <p class="text-white/90 mb-3 sm:mb-4 text-sm sm:text-base">Login setiap hari dan dapatkan koin gratis untuk unlock chapter premium!</p>
                        <button class="bg-white text-[#3E5F44] px-4 sm:px-6 py-2 rounded-full font-semibold hover:bg-[#93DA97] transition w-full text-sm sm:text-base">
                            Klaim Sekarang
                        </button>
                    </div>
                    
                    <div class="event-card bg-white/10 backdrop-blur-sm rounded-2xl p-4 sm:p-6 border border-white/20" style="animation-delay: 0.2s">
                        <div class="text-3xl sm:text-4xl mb-3 sm:mb-4">📚</div>
                        <h3 class="text-xl sm:text-2xl font-bold mb-2 sm:mb-3">Marathon Reading</h3>
                        <p class="text-white/90 mb-3 sm:mb-4 text-sm sm:text-base">Baca 50 chapter minggu ini dan menangkan merchandise eksklusif!</p>
                        <button class="bg-white text-[#3E5F44] px-4 sm:px-6 py-2 rounded-full font-semibold hover:bg-[#93DA97] transition w-full text-sm sm:text-base">
                            Ikut Event
                        </button>
                    </div>
                    
                    <div class="event-card bg-white/10 backdrop-blur-sm rounded-2xl p-4 sm:p-6 border border-white/20" style="animation-delay: 0.4s">
                        <div class="text-3xl sm:text-4xl mb-3 sm:mb-4">⭐</div>
                        <h3 class="text-xl sm:text-2xl font-bold mb-2 sm:mb-3">New Series Launch</h3>
                        <p class="text-white/90 mb-3 sm:mb-4 text-sm sm:text-base">10 series baru dirilis bulan ini! Jadi yang pertama membaca!</p>
                        <button class="bg-white text-[#3E5F44] px-4 sm:px-6 py-2 rounded-full font-semibold hover:bg-[#93DA97] transition w-full text-sm sm:text-base">
                            Lihat Series
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Slide 3 - Community -->
        <div class="hero-slide">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center py-12 sm:py-20">
                <h2 class="text-3xl sm:text-5xl font-bold mb-4 sm:mb-6">👥 Join Our Community</h2>
                <p class="text-base sm:text-xl mb-6 sm:mb-8 max-w-3xl mx-auto leading-relaxed px-4">
                    Bergabunglah dengan 1 juta+ pembaca aktif! Diskusikan teori, bagikan rekomendasi, 
                    dan temukan teman sesama pecinta komik.
                </p>
                <div class="grid grid-cols-3 gap-3 sm:gap-6 max-w-4xl mx-auto mb-6">
                    <div class="bg-white/10 backdrop-blur-sm rounded-xl p-4 sm:p-6 border border-white/20">
                        <div class="text-2xl sm:text-3xl font-bold mb-1 sm:mb-2">1M+</div>
                        <p class="text-white/90 text-xs sm:text-base">Active Readers</p>
                    </div>
                    <div class="bg-white/10 backdrop-blur-sm rounded-xl p-4 sm:p-6 border border-white/20">
                        <div class="text-2xl sm:text-3xl font-bold mb-1 sm:mb-2">50K+</div>
                        <p class="text-white/90 text-xs sm:text-base">Comic Series</p>
                    </div>
                    <div class="bg-white/10 backdrop-blur-sm rounded-xl p-4 sm:p-6 border border-white/20">
                        <div class="text-2xl sm:text-3xl font-bold mb-1 sm:mb-2">24/7</div>
                        <p class="text-white/90 text-xs sm:text-base">Daily Updates</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Slider Dots -->
    <div class="slider-dots" style="position: absolute; bottom: 20px; left: 0; right: 0;">
        <div class="slider-dot active" onclick="goToSlide(0)"></div>
        <div class="slider-dot" onclick="goToSlide(1)"></div>
        <div class="slider-dot" onclick="goToSlide(2)"></div>
    </div>
</section>
    <div class="mb-8">
        <form action="{{ route('landing') }}" method="GET" class="flex gap-2">
            <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari judul / author..." class="flex-1 border rounded px-3 py-2">
            <select name="sort" class="border rounded px-2 py-2">
                <option value="">Sort: Latest</option>
                <option value="rank" {{ request('sort')=='rank' ? 'selected' : '' }}>Rank</option>
                <option value="rating" {{ request('sort')=='rating' ? 'selected' : '' }}>Rating</option>
            </select>
            <button class="bg-blue-600 text-white px-4 py-2 rounded">Cari</button>
        </form>
    </div>

    {{-- Top Rank --}}
    <section class="mb-10">
        <h2 class="text-xl font-bold mb-4">Top Rank</h2>
        <div class="grid grid-cols-2 md:grid-cols-5 gap-4">
            @foreach($topRank as $comic)
                <div class="bg-white rounded shadow p-2 text-center">
                    <img src="{{ asset('storage/covers/'.$comic->cover_image) }}" alt="{{ $comic->title }}" class="w-full h-40 object-cover rounded">
                    <h3 class="text-sm font-semibold mt-2">{{ Str::limit($comic->title, 30) }}</h3>
                    <p class="text-xs text-gray-500">Rank #{{ $comic->rank }}</p>
                </div>
            @endforeach
        </div>
    </section>

    {{-- Top Rated --}}
    <section class="mb-10">
        <h2 class="text-xl font-bold mb-4">Top Rated</h2>
        <div class="grid grid-cols-2 md:grid-cols-5 gap-4">
            @foreach($topRated as $comic)
                <div class="bg-white rounded shadow p-2 text-center">
                    <img src="{{ asset('storage/covers/'.$comic->cover_image) }}" alt="{{ $comic->title }}" class="w-full h-40 object-cover rounded">
                    <h3 class="text-sm font-semibold mt-2">{{ Str::limit($comic->title, 30) }}</h3>
                    <p class="text-xs text-gray-500">Rating: {{ $comic->rating }}</p>
                </div>
            @endforeach
        </div>
    </section>

    {{-- Latest --}}
    <section class="mb-10">
        <h2 class="text-xl font-bold mb-4">Latest</h2>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            @foreach($latest as $comic)
                <x-comic-card :comic="$comic" />
            @endforeach
        </div>
    </section>

    {{-- Main listing (paginated) --}}
    <section class="mb-10">
        <h2 class="text-xl font-bold mb-4">All Comics</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            @foreach($comics as $comic)
                <div class="bg-white rounded shadow p-4">
                    <div class="flex gap-4">
                        <img src="{{ asset('storage/covers/'.$comic->cover_image) }}" alt="{{ $comic->title }}" class="w-24 h-32 object-cover rounded">
                        <div>
                            <h3 class="font-semibold">{{ $comic->title }}</h3>
                            <p class="text-sm text-gray-600">{{ $comic->author }}</p>
                            <p class="text-xs text-gray-500 mt-2">Type: {{ $comic->type }} • Status: {{ $comic->status }}</p>
                            <p class="text-xs text-gray-500">Ch: {{ $comic->chapters }} • Rating: {{ $comic->rating }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-6">
            {{ $comics->links() }}
        </div>
    </section>
@endsection