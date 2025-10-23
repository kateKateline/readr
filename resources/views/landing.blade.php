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
<!-- Top Rankings -->
<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 sm:py-16">
    <h3 class="text-2xl sm:text-3xl font-bold text-[#3E5F44] mb-6 sm:mb-8 text-center">📊 Peringkat Teratas</h3>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6">
        <!-- Rank 1 -->
        <div class="bg-white rounded-lg shadow-lg p-4 sm:p-6 card-hover border-t-4 border-[#3E5F44]">
            <div class="flex items-center mb-4">
                <span class="text-3xl sm:text-4xl font-bold text-[#3E5F44] mr-2 sm:mr-3">1</span>
                <div class="w-12 h-16 sm:w-16 sm:h-20 bg-gradient-to-br from-[#93DA97] to-[#5E936C] rounded"></div>
                <div class="ml-2 sm:ml-3">
                    <h4 class="font-semibold text-gray-800 text-sm sm:text-base">One Piece</h4>
                    <p class="text-xs sm:text-sm text-gray-500">Chapter 1095</p>
                </div>
            </div>
            <div class="flex items-center justify-between text-xs sm:text-sm">
                <span class="text-gray-600">⭐ 9.8/10</span>
                <span class="text-[#5E936C] font-semibold">125M views</span>
            </div>
        </div>
        <!-- Rank 2 -->
        <div class="bg-white rounded-lg shadow-lg p-4 sm:p-6 card-hover border-t-4 border-[#5E936C]">
            <div class="flex items-center mb-4">
                <span class="text-3xl sm:text-4xl font-bold text-[#5E936C] mr-2 sm:mr-3">2</span>
                <div class="w-12 h-16 sm:w-16 sm:h-20 bg-gradient-to-br from-[#93DA97] to-[#5E936C] rounded"></div>
                <div class="ml-2 sm:ml-3">
                    <h4 class="font-semibold text-gray-800 text-sm sm:text-base">Solo Leveling</h4>
                    <p class="text-xs sm:text-sm text-gray-500">Chapter 200</p>
                </div>
            </div>
            <div class="flex items-center justify-between text-xs sm:text-sm">
                <span class="text-gray-600">⭐ 9.7/10</span>
                <span class="text-[#5E936C] font-semibold">98M views</span>
            </div>
        </div>
        <!-- Rank 3 -->
        <div class="bg-white rounded-lg shadow-lg p-4 sm:p-6 card-hover border-t-4 border-[#93DA97]">
            <div class="flex items-center mb-4">
                <span class="text-3xl sm:text-4xl font-bold text-[#5E936C] mr-2 sm:mr-3">3</span>
                <div class="w-12 h-16 sm:w-16 sm:h-20 bg-gradient-to-br from-[#93DA97] to-[#5E936C] rounded"></div>
                <div class="ml-2 sm:ml-3">
                    <h4 class="font-semibold text-gray-800 text-sm sm:text-base">Jujutsu Kaisen</h4>
                    <p class="text-xs sm:text-sm text-gray-500">Chapter 245</p>
                </div>
            </div>
            <div class="flex items-center justify-between text-xs sm:text-sm">
                <span class="text-gray-600">⭐ 9.6/10</span>
                <span class="text-[#5E936C] font-semibold">87M views</span>
            </div>
        </div>
        <!-- Rank 4 -->
        <div class="bg-white rounded-lg shadow-lg p-4 sm:p-6 card-hover">
            <div class="flex items-center mb-4">
                <span class="text-3xl sm:text-4xl font-bold text-gray-400 mr-2 sm:mr-3">4</span>
                <div class="w-12 h-16 sm:w-16 sm:h-20 bg-gradient-to-br from-[#93DA97] to-[#5E936C] rounded"></div>
                <div class="ml-2 sm:ml-3">
                    <h4 class="font-semibold text-gray-800 text-sm sm:text-base">Tower of God</h4>
                    <p class="text-xs sm:text-sm text-gray-500">Chapter 580</p>
                </div>
            </div>
            <div class="flex items-center justify-between text-xs sm:text-sm">
                <span class="text-gray-600">⭐ 9.5/10</span>
                <span class="text-[#5E936C] font-semibold">76M views</span>
            </div>
        </div>
    </div>
</section>
<!-- Popular Manga -->
<section class="bg-white py-12 sm:py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h3 class="text-2xl sm:text-3xl font-bold text-[#3E5F44] mb-6 sm:mb-8">🇯🇵 Manga Populer</h3>
        <div class="grid grid-cols-3 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-3 sm:gap-6">
            <div class="card-hover cursor-pointer">
                <div class="bg-gradient-to-br from-[#93DA97] to-[#5E936C] rounded-lg mb-2 sm:mb-3 shadow-md" style="aspect-ratio: 2/3;"></div>
                <h4 class="font-semibold text-gray-800 text-xs sm:text-base leading-tight">Demon Slayer</h4>
                <p class="text-xs sm:text-sm text-gray-500">Ch 205</p>
            </div>
            <div class="card-hover cursor-pointer">
                <div class="bg-gradient-to-br from-[#93DA97] to-[#5E936C] rounded-lg mb-2 sm:mb-3 shadow-md" style="aspect-ratio: 2/3;"></div>
                <h4 class="font-semibold text-gray-800 text-xs sm:text-base leading-tight">My Hero Academia</h4>
                <p class="text-xs sm:text-sm text-gray-500">Ch 410</p>
            </div>
            <div class="card-hover cursor-pointer">
                <div class="bg-gradient-to-br from-[#93DA97] to-[#5E936C] rounded-lg mb-2 sm:mb-3 shadow-md" style="aspect-ratio: 2/3;"></div>
                <h4 class="font-semibold text-gray-800 text-xs sm:text-base leading-tight">Naruto</h4>
                <p class="text-xs sm:text-sm text-gray-500">Ch 700</p>
            </div>
            <div class="card-hover cursor-pointer">
                <div class="bg-gradient-to-br from-[#93DA97] to-[#5E936C] rounded-lg mb-2 sm:mb-3 shadow-md" style="aspect-ratio: 2/3;"></div>
                <h4 class="font-semibold text-gray-800 text-xs sm:text-base leading-tight">Attack on Titan</h4>
                <p class="text-xs sm:text-sm text-gray-500">Ch 139</p>
            </div>
            <div class="card-hover cursor-pointer">
                <div class="bg-gradient-to-br from-[#93DA97] to-[#5E936C] rounded-lg mb-2 sm:mb-3 shadow-md" style="aspect-ratio: 2/3;"></div>
                <h4 class="font-semibold text-gray-800 text-xs sm:text-base leading-tight">Bleach</h4>
                <p class="text-xs sm:text-sm text-gray-500">Ch 686</p>
            </div>
            <div class="card-hover cursor-pointer">
                <div class="bg-gradient-to-br from-[#93DA97] to-[#5E936C] rounded-lg mb-2 sm:mb-3 shadow-md" style="aspect-ratio: 2/3;"></div>
                <h4 class="font-semibold text-gray-800 text-xs sm:text-base leading-tight">Tokyo Ghoul</h4>
                <p class="text-xs sm:text-sm text-gray-500">Ch 179</p>
            </div>
        </div>
    </div>
</section>
<!-- Popular Manhwa -->
<section class="py-12 sm:py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h3 class="text-2xl sm:text-3xl font-bold text-[#3E5F44] mb-6 sm:mb-8">🇰🇷 Manhwa Populer</h3>
        <div class="grid grid-cols-3 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-3 sm:gap-6">
            <div class="card-hover cursor-pointer">
                <div class="bg-gradient-to-br from-[#5E936C] to-[#3E5F44] rounded-lg mb-2 sm:mb-3 shadow-md" style="aspect-ratio: 2/3;"></div>
                <h4 class="font-semibold text-gray-800 text-xs sm:text-base leading-tight">The Beginning After The End</h4>
                <p class="text-xs sm:text-sm text-gray-500">Ch 180</p>
            </div>
            <div class="card-hover cursor-pointer">
                <div class="bg-gradient-to-br from-[#5E936C] to-[#3E5F44] rounded-lg mb-2 sm:mb-3 shadow-md" style="aspect-ratio: 2/3;"></div>
                <h4 class="font-semibold text-gray-800 text-xs sm:text-base leading-tight">Omniscient Reader</h4>
                <p class="text-xs sm:text-sm text-gray-500">Ch 165</p>
            </div>
            <div class="card-hover cursor-pointer">
                <div class="bg-gradient-to-br from-[#5E936C] to-[#3E5F44] rounded-lg mb-2 sm:mb-3 shadow-md" style="aspect-ratio: 2/3;"></div>
                <h4 class="font-semibold text-gray-800 text-xs sm:text-base leading-tight">True Beauty</h4>
                <p class="text-xs sm:text-sm text-gray-500">Ch 220</p>
            </div>
            <div class="card-hover cursor-pointer">
                <div class="bg-gradient-to-br from-[#5E936C] to-[#3E5F44] rounded-lg mb-2 sm:mb-3 shadow-md" style="aspect-ratio: 2/3;"></div>
                <h4 class="font-semibold text-gray-800 text-xs sm:text-base leading-tight">Lookism</h4>
                <p class="text-xs sm:text-sm text-gray-500">Ch 480</p>
            </div>
            <div class="card-hover cursor-pointer">
                <div class="bg-gradient-to-br from-[#5E936C] to-[#3E5F44] rounded-lg mb-2 sm:mb-3 shadow-md" style="aspect-ratio: 2/3;"></div>
                <h4 class="font-semibold text-gray-800 text-xs sm:text-base leading-tight">The God of High School</h4>
                <p class="text-xs sm:text-sm text-gray-500">Ch 540</p>
            </div>
            <div class="card-hover cursor-pointer">
                <div class="bg-gradient-to-br from-[#5E936C] to-[#3E5F44] rounded-lg mb-2 sm:mb-3 shadow-md" style="aspect-ratio: 2/3;"></div>
                <h4 class="font-semibold text-gray-800 text-xs sm:text-base leading-tight">Noblesse</h4>
                <p class="text-xs sm:text-sm text-gray-500">Ch 544</p>
            </div>
        </div>
    </div>
</section>
<!-- Popular Manhua -->
<section class="bg-white py-12 sm:py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h3 class="text-2xl sm:text-3xl font-bold text-[#3E5F44] mb-6 sm:mb-8">🇨🇳 Manhua Populer</h3>
        <div class="grid grid-cols-3 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-3 sm:gap-6">
            <div class="card-hover cursor-pointer">
                <div class="bg-gradient-to-br from-[#3E5F44] to-[#5E936C] rounded-lg mb-2 sm:mb-3 shadow-md" style="aspect-ratio: 2/3;"></div>
                <h4 class="font-semibold text-gray-800 text-xs sm:text-base leading-tight">Tales of Demons and Gods</h4>
                <p class="text-xs sm:text-sm text-gray-500">Ch 450</p>
            </div>
            <div class="card-hover cursor-pointer">
                <div class="bg-gradient-to-br from-[#3E5F44] to-[#5E936C] rounded-lg mb-2 sm:mb-3 shadow-md" style="aspect-ratio: 2/3;"></div>
                <h4 class="font-semibold text-gray-800 text-xs sm:text-base leading-tight">The King's Avatar</h4>
                <p class="text-xs sm:text-sm text-gray-500">Ch 390</p>
            </div>
            <div class="card-hover cursor-pointer">
                <div class="bg-gradient-to-br from-[#3E5F44] to-[#5E936C] rounded-lg mb-2 sm:mb-3 shadow-md" style="aspect-ratio: 2/3;"></div>
                <h4 class="font-semibold text-gray-800 text-xs sm:text-base leading-tight">Martial Peak</h4>
                <p class="text-xs sm:text-sm text-gray-500">Ch 3500</p>
            </div>
            <div class="card-hover cursor-pointer">
                <div class="bg-gradient-to-br from-[#3E5F44] to-[#5E936C] rounded-lg mb-2 sm:mb-3 shadow-md" style="aspect-ratio: 2/3;"></div>
                <h4 class="font-semibold text-gray-800 text-xs sm:text-base leading-tight">Soul Land</h4>
                <p class="text-xs sm:text-sm text-gray-500">Ch 360</p>
            </div>
            <div class="card-hover cursor-pointer">
                <div class="bg-gradient-to-br from-[#3E5F44] to-[#5E936C] rounded-lg mb-2 sm:mb-3 shadow-md" style="aspect-ratio: 2/3;"></div>
                <h4 class="font-semibold text-gray-800 text-xs sm:text-base leading-tight">Apotheosis</h4>
                <p class="text-xs sm:text-sm text-gray-500">Ch 900</p>
            </div>
            <div class="card-hover cursor-pointer">
                <div class="bg-gradient-to-br from-[#3E5F44] to-[#5E936C] rounded-lg mb-2 sm:mb-3 shadow-md" style="aspect-ratio: 2/3;"></div>
                <h4 class="font-semibold text-gray-800 text-xs sm:text-base leading-tight">Battle Through The Heavens</h4>
                <p class="text-xs sm:text-sm text-gray-500">Ch 1650</p>
            </div>
        </div>
    </div>
</section>
<!-- Latest Updates Section -->
<section class="py-12 sm:py-16 bg-gradient-to-b from-[#E8FFD7] to-[#93DA97]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h3 class="text-2xl sm:text-3xl font-bold text-[#3E5F44] mb-6 sm:mb-8 text-center">📚 Update Terbaru</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6">
            <div class="bg-white rounded-lg shadow-lg p-4 sm:p-6 card-hover">
                <div class="flex items-start space-x-3 sm:space-x-4">
                    <div class="w-16 h-24 sm:w-20 sm:h-28 bg-gradient-to-br from-[#5E936C] to-[#3E5F44] rounded flex-shrink-0"></div>
                    <div class="flex-1">
                        <h4 class="font-semibold text-gray-800 mb-1 sm:mb-2 text-sm sm:text-base">Return of the Mount Hua Sect</h4>
                        <p class="text-xs sm:text-sm text-gray-600 mb-2">Chapter 125 - Fresh update!</p>
                        <div class="flex items-center justify-between">
                            <span class="text-xs text-gray-500">4 jam lalu</span>
                            <span class="bg-[#3E5F44] text-white text-xs px-2 sm:px-3 py-1 rounded-full">NEW</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-lg shadow-lg p-4 sm:p-6 card-hover">
                <div class="flex items-start space-x-3 sm:space-x-4">
                    <div class="w-16 h-24 sm:w-20 sm:h-28 bg-gradient-to-br from-[#3E5F44] to-[#5E936C] rounded flex-shrink-0"></div>
                    <div class="flex-1">
                        <h4 class="font-semibold text-gray-800 mb-1 sm:mb-2 text-sm sm:text-base">I Shall Seal the Heavens</h4>
                        <p class="text-xs sm:text-sm text-gray-600 mb-2">Chapter 580 - Hot release!</p>
                        <div class="flex items-center justify-between">
                            <span class="text-xs text-gray-500">6 jam lalu</span>
                            <span class="bg-[#3E5F44] text-white text-xs px-2 sm:px-3 py-1 rounded-full">NEW</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="text-center mt-6 sm:mt-8">
            <button class="bg-[#3E5F44] text-white px-6 sm:px-8 py-2 sm:py-3 rounded-full font-semibold hover:bg-[#5E936C] transition text-sm sm:text-base">
                Lihat Semua Update
            </button>
        </div>
    </div>
</section>
@endsection