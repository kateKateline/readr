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

<!-- Top Rankings Section -->
@if($topRank->count() > 0)
<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 sm:py-16">
    <h3 class="text-2xl sm:text-3xl font-bold text-[#3E5F44] mb-6 sm:mb-8 text-center">📊 Peringkat Teratas</h3>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6">
        @foreach($topRank->take(4) as $index => $comic)
        <div class="bg-white rounded-lg shadow-lg p-4 sm:p-6 card-hover @if($index === 0) border-t-4 border-[#3E5F44] @elseif($index === 1) border-t-4 border-[#5E936C] @elseif($index === 2) border-t-4 border-[#93DA97] @endif">
            <div class="flex items-center mb-4">
                <span class="text-3xl sm:text-4xl font-bold @if($index === 0) text-[#3E5F44] @elseif($index === 1) text-[#5E936C] @else text-gray-400 @endif mr-2 sm:mr-3">{{ $comic->rank }}</span>
                <img src="{{ asset('storage/covers/'.$comic->cover_image) }}" alt="{{ $comic->title }}" class="w-12 h-16 sm:w-16 sm:h-20 object-cover rounded">
                <div class="ml-2 sm:ml-3 flex-1">
                    <h4 class="font-semibold text-gray-800 text-sm sm:text-base">{{ Str::limit($comic->title, 20) }}</h4>
                    <p class="text-xs sm:text-sm text-gray-500">Chapter {{ $comic->chapters }}</p>
                </div>
            </div>
            <div class="flex items-center justify-between text-xs sm:text-sm">
                <span class="text-gray-600">⭐ {{ $comic->rating }}/10</span>
                <span class="text-[#5E936C] font-semibold">{{ $comic->type }}</span>
            </div>
        </div>
        @endforeach
    </div>
</section>
@endif

<!-- Popular Manga Section -->
@if($mangaPopular->count() > 0)
<section class="bg-white py-12 sm:py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h3 class="text-2xl sm:text-3xl font-bold text-[#3E5F44] mb-6 sm:mb-8">🇯🇵 Manga Populer</h3>
        <div class="grid grid-cols-3 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-3 sm:gap-6">
            @foreach($mangaPopular as $comic)
            <div class="card-hover cursor-pointer">
                <img src="{{ asset('storage/covers/'.$comic->cover_image) }}" alt="{{ $comic->title }}" class="bg-gradient-to-br from-[#93DA97] to-[#5E936C] rounded-lg mb-2 sm:mb-3 shadow-md w-full object-cover" style="aspect-ratio: 2/3;">
                <h4 class="font-semibold text-gray-800 text-xs sm:text-base leading-tight">{{ Str::limit($comic->title, 25) }}</h4>
                <p class="text-xs sm:text-sm text-gray-500">Ch {{ $comic->chapters }}</p>
                <p class="text-xs text-yellow-600 mt-1">⭐ {{ $comic->rating }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- Popular Manhwa Section -->
@if($manhwaPopular->count() > 0)
<section class="py-12 sm:py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h3 class="text-2xl sm:text-3xl font-bold text-[#3E5F44] mb-6 sm:mb-8">🇰🇷 Manhwa Populer</h3>
        <div class="grid grid-cols-3 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-3 sm:gap-6">
            @foreach($manhwaPopular as $comic)
            <div class="card-hover cursor-pointer">
                <img src="{{ asset('storage/covers/'.$comic->cover_image) }}" alt="{{ $comic->title }}" class="bg-gradient-to-br from-[#5E936C] to-[#3E5F44] rounded-lg mb-2 sm:mb-3 shadow-md w-full object-cover" style="aspect-ratio: 2/3;">
                <h4 class="font-semibold text-gray-800 text-xs sm:text-base leading-tight">{{ Str::limit($comic->title, 25) }}</h4>
                <p class="text-xs sm:text-sm text-gray-500">Ch {{ $comic->chapters }}</p>
                <p class="text-xs text-yellow-600 mt-1">⭐ {{ $comic->rating }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- Popular Manhua Section -->
@if($manhuaPopular->count() > 0)
<section class="bg-white py-12 sm:py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h3 class="text-2xl sm:text-3xl font-bold text-[#3E5F44] mb-6 sm:mb-8">🇨🇳 Manhua Populer</h3>
        <div class="grid grid-cols-3 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-3 sm:gap-6">
            @foreach($manhuaPopular as $comic)
            <div class="card-hover cursor-pointer">
                <img src="{{ asset('storage/covers/'.$comic->cover_image) }}" alt="{{ $comic->title }}" class="bg-gradient-to-br from-[#3E5F44] to-[#5E936C] rounded-lg mb-2 sm:mb-3 shadow-md w-full object-cover" style="aspect-ratio: 2/3;">
                <h4 class="font-semibold text-gray-800 text-xs sm:text-base leading-tight">{{ Str::limit($comic->title, 25) }}</h4>
                <p class="text-xs sm:text-sm text-gray-500">Ch {{ $comic->chapters }}</p>
                <p class="text-xs text-yellow-600 mt-1">⭐ {{ $comic->rating }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- Latest Updates Section -->
@if($latest->count() > 0)
<section class="py-12 sm:py-16 bg-gradient-to-b from-[#E8FFD7] to-[#93DA97]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h3 class="text-2xl sm:text-3xl font-bold text-[#3E5F44] mb-6 sm:mb-8 text-center">📚 Update Terbaru</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6">
            @foreach($latest->take(6) as $comic)
            <div class="bg-white rounded-lg shadow-lg p-4 sm:p-6 card-hover">
                <div class="flex items-start space-x-3 sm:space-x-4">
                    <img src="{{ asset('storage/covers/'.$comic->cover_image) }}" alt="{{ $comic->title }}" class="w-16 h-24 sm:w-20 sm:h-28 object-cover rounded flex-shrink-0">
                    <div class="flex-1">
                        <h4 class="font-semibold text-gray-800 mb-1 sm:mb-2 text-sm sm:text-base">{{ Str::limit($comic->title, 30) }}</h4>
                        <p class="text-xs sm:text-sm text-gray-600 mb-2">Chapter {{ $comic->chapters }} - {{ $comic->type }}</p>
                        <div class="flex items-center justify-between">
                            <span class="text-xs text-gray-500">{{ $comic->created_at->diffForHumans() }}</span>
                            <span class="bg-[#3E5F44] text-white text-xs px-2 sm:px-3 py-1 rounded-full">NEW</span>
                        </div>
                        <p class="text-xs text-yellow-600 mt-2">⭐ {{ $comic->rating }}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="text-center mt-6 sm:mt-8">
            <button class="bg-[#3E5F44] text-white px-6 sm:px-8 py-2 sm:py-3 rounded-full font-semibold hover:bg-[#5E936C] transition text-sm sm:text-base">
                Lihat Semua Update
            </button>
        </div>
    </div>
</section>
@endif

<!-- All Comics Section (with Search) -->
<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <h3 class="text-2xl sm:text-3xl font-bold text-[#3E5F44] mb-6">📖 Semua Komik</h3>
    
    <!-- Search & Filter -->
    <div class="mb-8 bg-white rounded-lg shadow-md p-4">
        <form action="{{ route('landing') }}" method="GET" class="flex flex-col sm:flex-row gap-3">
            <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari judul / author..." class="flex-1 border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-[#3E5F44] focus:border-transparent">
            <select name="type" class="border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-[#3E5F44]">
                <option value="">Semua Type</option>
                <option value="Manga" {{ request('type')=='Manga' ? 'selected' : '' }}>Manga</option>
                <option value="Manhwa" {{ request('type')=='Manhwa' ? 'selected' : '' }}>Manhwa</option>
                <option value="Manhua" {{ request('type')=='Manhua' ? 'selected' : '' }}>Manhua</option>
            </select>
            <select name="sort" class="border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-[#3E5F44]">
                <option value="">Sort: Latest</option>
                <option value="rank" {{ request('sort')=='rank' ? 'selected' : '' }}>Rank</option>
                <option value="rating" {{ request('sort')=='rating' ? 'selected' : '' }}>Rating</option>
            </select>
            <button class="bg-[#3E5F44] text-white px-6 py-2 rounded-lg hover:bg-[#5E936C] transition font-semibold">Cari</button>
        </form>
    </div>

    @if($comics->count() > 0)
    <!-- Comics Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($comics as $comic)
        <div class="bg-white rounded-lg shadow-lg hover:shadow-xl transition p-4 card-hover">
            <div class="flex gap-4">
                <img src="{{ asset('storage/covers/'.$comic->cover_image) }}" alt="{{ $comic->title }}" class="w-24 h-32 object-cover rounded flex-shrink-0">
                <div class="flex-1">
                    <h3 class="font-semibold text-gray-800 mb-1">{{ $comic->title }}</h3>
                    <p class="text-sm text-gray-600 mb-2">{{ $comic->author }}</p>
                    <div class="space-y-1">
                        <p class="text-xs text-gray-500">
                            <span class="inline-block bg-blue-100 text-blue-800 px-2 py-1 rounded">{{ $comic->type }}</span>
                            <span class="inline-block bg-green-100 text-green-800 px-2 py-1 rounded ml-1">{{ $comic->status }}</span>
                        </p>
                        <p class="text-xs text-gray-500">📖 {{ $comic->chapters }} Chapters</p>
                        <p class="text-xs text-yellow-600">⭐ {{ $comic->rating }}/10</p>
                        @if($comic->rank)
                        <p class="text-xs text-purple-600 font-semibold">🏆 Rank #{{ $comic->rank }}</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Pagination -->
    <div class="mt-8">
        {{ $comics->links() }}
    </div>
    @else
    <!-- Empty State -->
    <div class="text-center py-12">
        <div class="text-6xl mb-4">😔</div>
        <h3 class="text-xl font-semibold text-gray-700 mb-2">Tidak ada hasil ditemukan</h3>
        <p class="text-gray-500">Coba kata kunci yang berbeda atau <a href="{{ route('landing') }}" class="text-[#3E5F44] hover:underline font-semibold">lihat semua komik</a></p>
    </div>
    @endif
</section>
@endsection