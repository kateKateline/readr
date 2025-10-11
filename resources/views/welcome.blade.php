<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Readr - Your Ultimate Manga Platform</title>
    <link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}">
    @vite('resources/css/app.css')
    <style>

        body {
            font-family: 'Inter', sans-serif;
        }
        
        .font-manga {
            font-family: 'Bebas Neue', sans-serif;
        }
        
        .manga-pattern {
            background-image: 
                linear-gradient(to right, #e5e5e5 1px, transparent 1px),
                linear-gradient(to bottom, #e5e5e5 1px, transparent 1px);
            background-size: 30px 30px;
        }
        
        .card-hover {
            transition: all 0.3s ease;
        }
        
        .card-hover:hover {
            transform: translateY(-10px) rotate(2deg);
        }
        
        .floating {
            animation: floating 3s ease-in-out infinite;
        }
        
        @keyframes floating {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
        }
        
        .fade-in {
            animation: fadeIn 1s ease-in;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .nav-sticky {
            backdrop-filter: blur(10px);
            background-color: rgba(0, 0, 0, 0.9);
        }
        
        .comic-border {
            border: 4px solid #000;
            box-shadow: 8px 8px 0px rgba(0,0,0,0.3);
        }
        
        .speech-bubble {
            position: relative;
            background: #fff;
            border: 3px solid #000;
            border-radius: 10px;
            padding: 20px;
        }
        
        .speech-bubble:after {
            content: '';
            position: absolute;
            bottom: -20px;
            left: 50%;
            width: 0;
            height: 0;
            border: 20px solid transparent;
            border-top-color: #000;
            border-bottom: 0;
            margin-left: -20px;
        }
        
        .pulse {
            animation: pulse 2s infinite;
        }
        
        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.05); }
        }
    </style>
</head>
<body class="bg-gray-50">
    <!-- Enhanced Navbar -->
<nav id="navbar" class="fixed w-full z-50 transition-all duration-300 bg-black text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <div class="flex items-center">
                <span class="text-3xl font-manga font-bold tracking-wider">READR</span>
            </div>

            <div class="hidden md:flex items-center space-x-8">
                <a href="#home" class="hover:text-purple-400 transition-colors duration-200 font-medium">Home</a>
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

<script>
document.addEventListener('DOMContentLoaded', () => {
    const profileBtn = document.getElementById('profile-btn');
    const profileMenu = document.getElementById('profile-menu');

    if (profileBtn) {
        profileBtn.addEventListener('click', (e) => {
            e.stopPropagation();
            profileMenu.classList.toggle('hidden');
            profileMenu.classList.toggle('scale-100');
        });
    }

    document.addEventListener('click', (e) => {
        if (profileMenu && !profileMenu.contains(e.target) && !profileBtn.contains(e.target)) {
            profileMenu.classList.add('hidden');
            profileMenu.classList.remove('scale-100');
        }
    });
});
</script>


    
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

    <!-- Footer -->
    <footer class="bg-black text-white py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-4 gap-8 mb-8">
                <div>
                    <div class="flex items-center space-x-2 mb-4">
                        <span class="text-xl font-bold">READR</span>
                    </div>
                    <p class="text-gray-400 text-sm">Your ultimate manga reading platform. Read anywhere, anytime.</p>
                </div>
                <div>
                    <h4 class="font-bold mb-4">Quick Links</h4>
                    <ul class="space-y-2 text-gray-400 text-sm">
                        <li><a href="#" class="hover:text-white transition-colors">Home</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Library</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Genres</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Popular</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-bold mb-4">Support</h4>
                    <ul class="space-y-2 text-gray-400 text-sm">
                        <li><a href="#" class="hover:text-white transition-colors">Help Center</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Contact Us</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Terms of Service</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Privacy Policy</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-bold mb-4">Follow Us</h4>
                    <div class="flex space-x-4">
                        <a href="#" class="w-10 h-10 bg-gray-800 rounded-full flex items-center justify-center hover:bg-purple-600 transition-colors">
                            <span>📱</span>
                        </a>
                        <a href="#" class="w-10 h-10 bg-gray-800 rounded-full flex items-center justify-center hover:bg-purple-600 transition-colors">
                            <span>🐦</span>
                        </a>
                        <a href="#" class="w-10 h-10 bg-gray-800 rounded-full flex items-center justify-center hover:bg-purple-600 transition-colors">
                            <span>📷</span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="border-t border-gray-800 pt-8 text-center text-gray-400 text-sm">
                <p>&copy; 2025 READR. All rights reserved. Made with ❤️ for manga lovers.</p>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script>
        // Mobile Menu Toggle
        const menuBtn = document.getElementById('mobile-menu-btn');
        const mobileMenu = document.getElementById('mobile-menu');
        const menuIcon = document.getElementById('menu-icon');
        
        menuBtn.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
            if (mobileMenu.classList.contains('hidden')) {
                menuIcon.setAttribute('d', 'M4 6h16M4 12h16M4 18h16');
            } else {
                menuIcon.setAttribute('d', 'M6 18L18 6M6 6l12 12');
            }
        });

        // Smooth Scrolling
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                    // Close mobile menu if open
                    mobileMenu.classList.add('hidden');
                    menuIcon.setAttribute('d', 'M4 6h16M4 12h16M4 18h16');
                }
            });
        });

        // Navbar scroll effect
        const navbar = document.getElementById('navbar');
        window.addEventListener('scroll', () => {
            if (window.scrollY > 50) {
                navbar.classList.add('shadow-lg');
            } else {
                navbar.classList.remove('shadow-lg');
            }
        });

        // Intersection Observer for fade-in animations
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -100px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, observerOptions);

        // Observe all feature cards and sections
        document.querySelectorAll('.speech-bubble, .card-hover').forEach(el => {
            el.style.opacity = '0';
            el.style.transform = 'translateY(30px)';
            el.style.transition = 'all 0.6s ease-out';
            observer.observe(el);
        });
    </script>
</body>
</html>