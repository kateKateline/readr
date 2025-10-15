@extends('layouts.main')

@section('content')
<div class="max-w-7xl mx-auto py-10 px-6">
    <!-- Wrapper dengan border -->
    <div class="border border-gray-300 rounded-2xl bg-white shadow-sm overflow-hidden">

        <!-- Banner -->
        <div class="relative">
            <img src="{{ asset('images/banner.jpg') }}"
                 alt="Banner"
                 class="w-full h-56 object-cover">
        </div>

        <!-- Profile Section - Left Aligned -->
        <div class="relative px-8 pb-8">
            <div class="flex items-start gap-8 -mt-16">
                <!-- Foto profil di kiri -->
                <div class="flex-shrink-0">
                    <div class="relative">
                        <img src="{{ asset('images/' . $user->profile) }}"
                             alt="Profile Picture"
                             class="w-40 h-40 rounded-full border-4 border-white object-cover shadow-xl">
                    </div>
                </div>

                <!-- User Info di kanan, aligned dengan profile -->
                <div class="flex-1 pt-20">
                    <h1 class="text-5xl font-bold text-gray-900 mb-3">{{ $user->username }}</h1>
                    <p class="text-gray-600 text-xl mb-4">{{ $user->email }}</p>
                    
                    <div class="flex items-center gap-4 mb-6">
                        <span class="inline-flex items-center px-5 py-2 bg-black text-white rounded-full text-base font-semibold shadow-md">
                            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"/>
                            </svg>
                            {{ ucfirst($user->role) }}
                        </span>
                        <span class="text-base text-gray-500 flex items-center gap-2">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"/>
                            </svg>
                            Joined {{ date('M Y', strtotime($user->created_at ?? now())) }}
                        </span>
                    </div>

                    <!-- Stats -->
                    <div class="flex gap-12 mb-6">
                        <div>
                            <p class="text-4xl font-bold text-gray-900">{{ $user->favorites->count() }}</p>
                            <p class="text-sm text-gray-600 mt-1">Favorites</p>
                        </div>
                        <div>
                            <p class="text-4xl font-bold text-gray-900">{{ $user->bookmarks->count() }}</p>
                            <p class="text-sm text-gray-600 mt-1">Bookmarks</p>
                        </div>
                        <div>
                            <p class="text-4xl font-bold text-gray-900">0</p>
                            <p class="text-sm text-gray-600 mt-1">Following</p>
                        </div>
                    </div>

                    <!-- Edit Profile Button -->
                    <button class="px-8 py-3 bg-black text-white rounded-full hover:bg-gray-800 transition-all duration-200 shadow-md hover:shadow-lg inline-flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                        </svg>
                        Edit Profile
                    </button>
                </div>
            </div>

            <!-- Divider -->
            <div class="mt-8 border-b border-gray-200"></div>
        </div>

        <!-- Bagian konten bawah -->
        <div class="px-8 pb-8 space-y-10">

            <!-- Favorites -->
            <div>
                <div class="flex items-center justify-between mb-6 pb-3 border-b-2 border-gray-200">
                    <h2 class="text-2xl font-bold text-gray-900 flex items-center gap-2">
                        <svg class="w-7 h-7 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd"/>
                        </svg>
                        Favorites
                    </h2>
                    <a href="#" class="text-sm text-purple-600 hover:text-purple-700 font-semibold flex items-center gap-1 transition">
                        View All 
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </a>    
                </div>
                <div class="grid grid-cols-2 sm:grid-cols-4 md:grid-cols-6 gap-4">
                    @forelse($user->favorites as $fav)
                    <div class="group cursor-pointer">
                        <div class="relative overflow-hidden rounded-lg shadow-md hover:shadow-xl transition-all duration-300">
                            <img src="{{ $fav->comic->cover_image ? asset('images/' . $fav->comic->cover_image) : 'https://via.placeholder.com/200x280' }}" 
                                 alt="{{ $fav->comic->title }}" 
                                 class="w-full h-64 object-cover group-hover:scale-105 transition-transform duration-300">
                            <div class="absolute inset-0 bg-black/0 group-hover:bg-black/10 transition-colors duration-300"></div>
                        </div>
                        <p class="mt-2 text-sm font-medium text-gray-800 text-center line-clamp-2">{{ $fav->comic->title ?? 'Untitled' }}</p>
                    </div>
                    @empty
                    <div class="col-span-2 sm:col-span-4 md:col-span-6 text-center py-12 text-gray-400">
                        <svg class="w-20 h-20 mx-auto mb-4 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                        </svg>
                        <p class="text-lg font-medium">No favorites yet</p>
                        <p class="text-sm mt-1">Start adding items you love!</p>
                    </div>
                    @endforelse 
                </div>
            </div>

            <!-- Bookmarks -->
            <div>
                <div class="flex items-center justify-between mb-6 pb-3 border-b-2 border-gray-200">
                    <h2 class="text-2xl font-bold text-gray-900 flex items-center gap-2">
                        <svg class="w-7 h-7 text-purple-600" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M5 4a2 2 0 012-2h6a2 2 0 012 2v14l-5-2.5L5 18V4z"/>
                        </svg>
                        Bookmarks
                    </h2>
                    <a href="#" class="text-sm text-purple-600 hover:text-purple-700 font-semibold flex items-center gap-1 transition">
                        View All 
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </a>
                </div>
                <div class="grid grid-cols-2 sm:grid-cols-4 md:grid-cols-6 gap-4">
                    @forelse($user->bookmarks as $bm)
                    <div class="group cursor-pointer">
                        <div class="relative overflow-hidden rounded-lg shadow-md hover:shadow-xl transition-all duration-300">
                            <img src="{{ $bm->comic->cover_image ? asset('images/' . $bm->comic->cover_image) : 'https://via.placeholder.com/200x280' }}" 
                                 alt="{{ $bm->comic->title }}" 
                                 class="w-full h-64 object-cover group-hover:scale-105 transition-transform duration-300">
                            <div class="absolute inset-0 bg-black/0 group-hover:bg-black/10 transition-colors duration-300"></div>
                        </div>
                        <p class="mt-2 text-sm font-medium text-gray-800 text-center line-clamp-2">{{ $bm->comic->title ?? 'Untitled' }}</p>
                    </div>
                    @empty
                    <div class="col-span-2 sm:col-span-4 md:col-span-6 text-center py-12 text-gray-400">
                        <svg class="w-20 h-20 mx-auto mb-4 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"/>
                        </svg>
                        <p class="text-lg font-medium">No bookmarks yet</p>
                        <p class="text-sm mt-1">Save items to read later!</p>
                    </div>
                    @endforelse
                </div>
            </div>

            <!-- Settings -->
            <div>
                <div class="flex items-center mb-6 pb-3 border-b-2 border-gray-200">
                    <h2 class="text-2xl font-bold text-gray-900 flex items-center gap-2">
                        <svg class="w-7 h-7 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        Settings
                    </h2>
                </div>
                <div class="space-y-3">
                    <div class="flex items-center justify-between p-5 bg-gradient-to-r from-purple-50 to-purple-100/50 rounded-xl hover:shadow-md transition-all cursor-pointer group">
                        <div class="flex items-center gap-4">
                            <div class="p-3 bg-white rounded-xl shadow-sm group-hover:scale-110 transition-transform">
                                <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="font-semibold text-gray-900 text-lg">Account Settings</p>
                                <p class="text-sm text-gray-600">Update your account information</p>
                            </div>
                        </div>
                        <svg class="w-6 h-6 text-gray-400 group-hover:text-purple-600 group-hover:translate-x-1 transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </div>

                    <div class="flex items-center justify-between p-5 bg-gradient-to-r from-blue-50 to-blue-100/50 rounded-xl hover:shadow-md transition-all cursor-pointer group">
                        <div class="flex items-center gap-4">
                            <div class="p-3 bg-white rounded-xl shadow-sm group-hover:scale-110 transition-transform">
                                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                                </svg>
                            </div>
                            <div>
                                <p class="font-semibold text-gray-900 text-lg">Notifications</p>
                                <p class="text-sm text-gray-600">Manage your notification preferences</p>
                            </div>
                        </div>
                        <svg class="w-6 h-6 text-gray-400 group-hover:text-blue-600 group-hover:translate-x-1 transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </div>

                    <div class="flex items-center justify-between p-5 bg-gradient-to-r from-green-50 to-green-100/50 rounded-xl hover:shadow-md transition-all cursor-pointer group">
                        <div class="flex items-center gap-4">
                            <div class="p-3 bg-white rounded-xl shadow-sm group-hover:scale-110 transition-transform">
                                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="font-semibold text-gray-900 text-lg">Privacy & Security</p>
                                <p class="text-sm text-gray-600">Control your privacy settings</p>
                            </div>
                        </div>
                        <svg class="w-6 h-6 text-gray-400 group-hover:text-green-600 group-hover:translate-x-1 transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </div>
                </div>

                <div class="mt-8 pt-6 border-t-2 border-gray-200 text-center">
                    <a href="{{ route('logout') }}" class="inline-flex items-center gap-3 px-8 py-3 text-red-600 bg-red-50 border-2 border-red-200 rounded-full hover:bg-red-100 hover:border-red-300 transition-all duration-200 font-semibold shadow-sm hover:shadow-md">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                        </svg>
                        Logout from Account
                    </a>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection