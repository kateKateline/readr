@extends('layouts.main')

@section('title', 'Welcome to Readr')

@section('content')
<!-- Features Section -->
    <section id="features" class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl md:text-5xl font-bold mb-4">Why Choose <span class="gradient-text">Readr?</span></h2>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto">Everything you need for the ultimate manga reading experience</p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Feature 1 -->
                <div class="speech-bubble card-hover cursor-pointer">
                    <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold mb-2">Lightning Fast</h3>
                    <p class="text-gray-600">Instant page loading with our optimized CDN. No more waiting!</p>
                </div>

                <!-- Feature 2 -->
                <div class="speech-bubble card-hover cursor-pointer">
                    <div class="w-12 h-12 bg-pink-100 rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-pink-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold mb-2">Mobile Optimized</h3>
                    <p class="text-gray-600">Perfect reading experience on any device, anywhere.</p>
                </div>

                <!-- Feature 3 -->
                <div class="speech-bubble card-hover cursor-pointer">
                    <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold mb-2">HD Quality</h3>
                    <p class="text-gray-600">Crystal clear pages with high-resolution images.</p>
                </div>

                <!-- Feature 4 -->
                <div class="speech-bubble card-hover cursor-pointer">
                    <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold mb-2">Daily Updates</h3>
                    <p class="text-gray-600">New chapters added every day. Never miss an update!</p>
                </div>

                <!-- Feature 5 -->
                <div class="speech-bubble card-hover cursor-pointer">
                    <div class="w-12 h-12 bg-yellow-100 rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold mb-2">Bookmarks</h3>
                    <p class="text-gray-600">Save your progress and continue reading anytime.</p>
                </div>

                <!-- Feature 6 -->
                <div class="speech-bubble card-hover cursor-pointer">
                    <div class="w-12 h-12 bg-red-100 rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold mb-2">Community</h3>
                    <p class="text-gray-600">Join millions of manga fans and share your thoughts.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Popular Manga Section -->
    <section id="library" class="py-20 bg-gray-50 manga-pattern">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl md:text-5xl font-bold mb-4">Trending <span class="gradient-text">Now</span></h2>
                <p class="text-xl text-gray-600">Most popular manga this week</p>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-6">
                <div class="group cursor-pointer">
                    <div class="relative overflow-hidden rounded-xl comic-border bg-gradient-to-br from-purple-500 to-pink-500 aspect-[3/4] mb-3">
                        <div class="absolute inset-0 flex items-center justify-center text-white text-6xl font-bold opacity-50">📖</div>
                        <div class="absolute inset-0 bg-black opacity-0 group-hover:opacity-30 transition-opacity"></div>
                    </div>
                    <h4 class="font-bold text-sm mb-1 group-hover:text-purple-600 transition-colors">Action Series #1</h4>
                    <p class="text-xs text-gray-600">Ch. 245 • ⭐ 4.9</p>
                </div>

                <div class="group cursor-pointer">
                    <div class="relative overflow-hidden rounded-xl comic-border bg-gradient-to-br from-blue-500 to-cyan-500 aspect-[3/4] mb-3">
                        <div class="absolute inset-0 flex items-center justify-center text-white text-6xl font-bold opacity-50">⚔️</div>
                        <div class="absolute inset-0 bg-black opacity-0 group-hover:opacity-30 transition-opacity"></div>
                    </div>
                    <h4 class="font-bold text-sm mb-1 group-hover:text-purple-600 transition-colors">Fantasy Quest</h4>
                    <p class="text-xs text-gray-600">Ch. 180 • ⭐ 4.8</p>
                </div>

                <div class="group cursor-pointer">
                    <div class="relative overflow-hidden rounded-xl comic-border bg-gradient-to-br from-red-500 to-orange-500 aspect-[3/4] mb-3">
                        <div class="absolute inset-0 flex items-center justify-center text-white text-6xl font-bold opacity-50">💕</div>
                        <div class="absolute inset-0 bg-black opacity-0 group-hover:opacity-30 transition-opacity"></div>
                    </div>
                    <h4 class="font-bold text-sm mb-1 group-hover:text-purple-600 transition-colors">Romance Story</h4>
                    <p class="text-xs text-gray-600">Ch. 120 • ⭐ 4.7</p>
                </div>

                <div class="group cursor-pointer">
                    <div class="relative overflow-hidden rounded-xl comic-border bg-gradient-to-br from-green-500 to-teal-500 aspect-[3/4] mb-3">
                        <div class="absolute inset-0 flex items-center justify-center text-white text-6xl font-bold opacity-50">🎭</div>
                        <div class="absolute inset-0 bg-black opacity-0 group-hover:opacity-30 transition-opacity"></div>
                    </div>
                    <h4 class="font-bold text-sm mb-1 group-hover:text-purple-600 transition-colors">Drama Tales</h4>
                    <p class="text-xs text-gray-600">Ch. 95 • ⭐ 4.9</p>
                </div>

                <div class="group cursor-pointer">
                    <div class="relative overflow-hidden rounded-xl comic-border bg-gradient-to-br from-yellow-500 to-red-500 aspect-[3/4] mb-3">
                        <div class="absolute inset-0 flex items-center justify-center text-white text-6xl font-bold opacity-50">😂</div>
                        <div class="absolute inset-0 bg-black opacity-0 group-hover:opacity-30 transition-opacity"></div>
                    </div>
                    <h4 class="font-bold text-sm mb-1 group-hover:text-purple-600 transition-colors">Comedy Gold</h4>
                    <p class="text-xs text-gray-600">Ch. 310 • ⭐ 4.8</p>
                </div>
            </div>

            <div class="text-center mt-12">
                <a href="#" class="inline-block bg-black text-white px-8 py-4 rounded-full font-semibold transition-all duration-300">
                    View All Manga
                </a>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section id="community" class="py-20 bg-white text-black">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-4xl md:text-5xl font-bold mb-6">Ready to Start Your Manga Journey?</h2>
            <p class="text-xl mb-8 opacity-90">Join millions of readers and discover your next favorite story today!</p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="#" class="bg-black text-white px-8 py-4 rounded-full font-bold hover:scale-105 transition-transform pulse">
                    Sign Up Free
                </a>
                <a href="#" class="bg-transparent border-2 border-black text-black px-8 py-4 rounded-full font-bold ">
                    Learn More
                </a>
            </div>
        </div>
    </section>
@endsection