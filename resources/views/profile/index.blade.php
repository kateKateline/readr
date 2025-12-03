@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto py-10 text-[#c9d1d9]">
    {{-- Profile Header --}}
    <div class="bg-[#0d1117] rounded-xl overflow-hidden shadow-lg mb-8 border border-[#21262d]">
        {{-- Banner --}}
        <div class="h-52 bg-gray-800 relative group">
            <img src="{{ $user->profile_banner ? asset('storage/' . $user->profile_banner) : asset('default-profile.png') }}" alt="banner" class="w-full h-52 object-cover">
        </div>

        {{-- Profile Info --}}
        <div class="p-6 md:flex md:items-start gap-6 relative">
            {{-- Avatar (Overlapping Banner) --}}
            <div class="-mt-28 md:mt-0 flex-shrink-0">
                <img src="{{ $user->profile_image ? asset('storage/' . $user->profile_image) : asset('default-profile.png') }}" alt="avatar" class="w-40 h-40 rounded-xl object-cover border-4 border-[#0d1117] shadow-lg hover:shadow-xl transition-shadow">
            </div>

            {{-- User Details --}}
            <div class="mt-4 md:mt-6 flex-1">
                <h1 class="text-3xl font-bold text-white">{{ $user->name }}</h1>
                <p class="text-gray-400 text-sm mt-1">{{ $user->email }}</p>

                {{-- Stats --}}
                <div class="mt-4 flex gap-6">
                    <div class="text-center">
                        <p class="text-2xl font-bold text-blue-400">{{ $bookmarks->count() }}</p>
                        <p class="text-xs text-gray-400">Bookmarks</p>
                    </div>
                    <div class="text-center">
                        <p class="text-2xl font-bold text-green-400">{{ $histories->count() }}</p>
                        <p class="text-xs text-gray-400">Reading History</p>
                    </div>
                    <div class="text-center">
                        <p class="text-2xl font-bold text-purple-400">{{ $comments->count() }}</p>
                        <p class="text-xs text-gray-400">Comments</p>
                    </div>
                </div>

                {{-- Badges --}}
                <div class="mt-4 flex flex-wrap gap-2">
                    <span class="inline-block px-4 py-1.5 text-sm font-medium rounded-full bg-gradient-to-r from-blue-600/30 to-blue-700/30 text-blue-300 border border-blue-600/50">Level: {{ ucfirst($user->level ?? 'user') }}</span>
                </div>

            </div>
        </div>
    </div>

    {{-- Content Grid: History + Bookmarks + Sidebar --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <div class="lg:col-span-2">
            {{-- Reading History Section --}}
            <div class="bg-[#0d1117] rounded-xl border border-[#21262d] p-6 mb-8">
                <h2 class="text-xl font-bold text-white mb-4 flex items-center">
                    <svg class="w-6 h-6 mr-2 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    Reading History
                </h2>

                @if($histories->count() > 0)
                    <div class="space-y-3 max-h-96 overflow-y-auto">
                        @foreach($histories->take(10) as $history)
                            @if($history->comic)
                            <a href="{{ route('comic.show', $history->comic->mangadex_id) }}" class="flex items-center gap-4 p-3 rounded-lg bg-[#161b22] hover:bg-[#21262d] transition-colors group">
                                <img src="{{ $history->comic->image ?? 'https://via.placeholder.com/56x80?text=No+Image' }}" alt="{{ $history->comic->title }}" class="w-14 h-20 object-cover rounded group-hover:shadow-md transition-shadow flex-shrink-0">
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-semibold text-white truncate group-hover:text-blue-400 transition-colors">{{ $history->comic->title }}</p>
                                    <p class="text-xs text-gray-400">Chapter {{ $history->last_viewed_chapter ?? 'N/A' }}</p>
                                    <p class="text-xs text-gray-500 mt-1">{{ $history->updated_at->diffForHumans() }}</p>
                                </div>
                                <svg class="w-4 h-4 text-gray-600 group-hover:text-blue-400 transition-colors flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                </svg>
                            </a>
                            @endif
                        @endforeach
                    </div>
                    @if($histories->count() > 10)
                        <div class="mt-4 text-center">
                            <p class="text-sm text-gray-400">+{{ $histories->count() - 10 }} more in history</p>
                        </div>
                    @endif
                @else
                    <div class="text-center py-8">
                        <svg class="w-12 h-12 mx-auto text-gray-600 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <p class="text-gray-400">No reading history yet. Start reading!</p>
                    </div>
                @endif
            </div>

            {{-- Bookmarks Section --}}
            <div class="bg-[#0d1117] rounded-xl border border-[#21262d] p-6">
                <h2 class="text-xl font-bold text-white mb-4 flex items-center">
                    <svg class="w-6 h-6 mr-2 text-blue-400" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M5 4a2 2 0 012-2h6a2 2 0 012 2v14l-5-2.5L5 18V4z" />
                    </svg>
                    Bookmarks
                </h2>
                
                @if($bookmarks->count() > 0)
                    <div class="grid grid-cols-2 sm:grid-cols-3 gap-4">
                        @foreach($bookmarks->take(12) as $bookmark)
                            @if($bookmark->comic)
                            <a href="{{ route('comic.show', $bookmark->comic->mangadex_id) }}" class="group relative rounded-lg overflow-hidden hover:shadow-lg transition-all duration-300">
                                <img src="{{ $bookmark->comic->image ?? 'https://via.placeholder.com/200x300?text=No+Image' }}" alt="{{ $bookmark->comic->title }}" class="w-full h-60 object-cover group-hover:scale-105 transition-transform duration-300">
                                <div class="absolute inset-0 bg-black/50 group-hover:bg-black/60 transition-colors flex items-end">
                                    <p class="p-2 text-xs font-semibold text-white truncate w-full">{{ $bookmark->comic->title }}</p>
                                </div>
                            </a>
                            @endif
                        @endforeach
                    </div>
                    @if($bookmarks->count() > 12)
                        <div class="mt-4 text-center">
                            <p class="text-sm text-gray-400">+{{ $bookmarks->count() - 12 }} more bookmarks</p>
                        </div>
                    @endif
                @else
                    <div class="text-center py-8">
                        <svg class="w-12 h-12 mx-auto text-gray-600 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h6a2 2 0 012 2v14l-5-2.5L5 18V5z" />
                        </svg>
                        <p class="text-gray-400">No bookmarks yet. Start bookmarking comics!</p>
                    </div>
                @endif
            </div>
        </div>

        {{-- Sidebar: Account Actions --}}
        <div class="lg:col-span-1">
            <div class="bg-[#0d1117] rounded-xl border border-[#21262d] p-6">
                <h3 class="text-lg font-bold text-white mb-4">Account</h3>

                <div class="space-y-3">
                    {{-- Edit Profile Button --}}
                    <button 
                        onclick="openEditModal()"
                        class="w-full px-4 py-2.5 text-sm font-semibold rounded-lg bg-blue-600 hover:bg-blue-700 text-white transition-all duration-200">
                        Edit Profile
                    </button>

                    {{-- Delete Account --}}
                    <button 
                        onclick="confirmDeleteAccount()"
                        class="w-full px-4 py-2.5 text-sm font-semibold rounded-lg bg-red-600/20 hover:bg-red-600/30 text-red-400 border border-red-600/50 hover:border-red-600 transition-all duration-200">
                        Delete Account
                    </button>
                </div>

                {{-- Account Info --}}
                <div class="mt-6 pt-6 border-t border-[#21262d] space-y-2 text-xs text-gray-400">
                    <div>
                        <span class="text-gray-500">Member since:</span>
                        <p class="text-gray-300">{{ $user->created_at->format('M d, Y') }}</p>
                    </div>
                    <div>
                        <span class="text-gray-500">Last active:</span>
                        <p class="text-gray-300">{{ $user->updated_at->diffForHumans() }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Edit Profile Modal --}}
<div id="editModal" class="hidden fixed inset-0 bg-black/50 backdrop-blur-sm flex items-center justify-center z-50">
    <div class="bg-[#0d1117] border border-blue-600/50 rounded-xl p-6 max-w-2xl mx-4 shadow-2xl max-h-96 overflow-y-auto">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-lg font-bold text-white">Edit Profile</h3>
            <button onclick="closeEditModal()" class="text-gray-400 hover:text-white">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf
            @method('PUT')

            {{-- Username --}}
            <div>
                <label class="block text-sm font-semibold text-white mb-2">Username</label>
                <input 
                    type="text" 
                    name="name" 
                    value="{{ $user->name }}" 
                    required
                    class="w-full px-4 py-2 bg-[#161b22] border border-[#30363d] text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                @error('name')
                    <span class="text-red-400 text-xs mt-1">{{ $message }}</span>
                @enderror
            </div>

            {{-- Profile Image --}}
            <div>
                <label class="block text-sm font-semibold text-white mb-2">Profile Image</label>
                <div class="flex items-center gap-4">
                    <img id="profileImagePreview" src="{{ $user->profile_image ? asset('storage/' . $user->profile_image) : asset('default-profile.png') }}" alt="preview" class="w-20 h-20 rounded-lg object-cover border border-[#30363d]">
                    <input 
                        type="file" 
                        name="profile_image" 
                        accept="image/*"
                        onchange="previewImage(event, 'profileImagePreview')"
                        class="flex-1 px-4 py-2 bg-[#161b22] border border-[#30363d] text-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                </div>
                <p class="text-xs text-gray-400 mt-1">Max 5MB. Formats: JPEG, PNG, JPG, GIF</p>
                @error('profile_image')
                    <span class="text-red-400 text-xs mt-1">{{ $message }}</span>
                @enderror
            </div>

            {{-- Banner Image --}}
            <div>
                <label class="block text-sm font-semibold text-white mb-2">Banner Image</label>
                <div class="space-y-2">
                    <img id="bannerImagePreview" src="{{ $user->profile_banner ? asset('storage/' . $user->profile_banner) : asset('default-profile.png') }}" alt="preview" class="w-full h-20 rounded-lg object-cover border border-[#30363d]">
                    <input 
                        type="file" 
                        name="profile_banner" 
                        accept="image/*"
                        onchange="previewImage(event, 'bannerImagePreview')"
                        class="w-full px-4 py-2 bg-[#161b22] border border-[#30363d] text-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                </div>
                <p class="text-xs text-gray-400 mt-1">Max 5MB. Formats: JPEG, PNG, JPG, GIF</p>
                @error('profile_banner')
                    <span class="text-red-400 text-xs mt-1">{{ $message }}</span>
                @enderror
            </div>

            {{-- Buttons --}}
            <div class="flex gap-3 pt-4 border-t border-[#21262d]">
                <button 
                    type="button"
                    onclick="closeEditModal()"
                    class="flex-1 px-4 py-2 text-sm font-semibold rounded-lg bg-[#21262d] hover:bg-[#30363d] text-white transition-all">
                    Cancel
                </button>
                <button 
                    type="submit"
                    class="flex-1 px-4 py-2 text-sm font-semibold rounded-lg bg-blue-600 hover:bg-blue-700 text-white transition-all">
                    Save Changes
                </button>
            </div>
        </form>
    </div>
</div>

{{-- Delete Account Modal --}}
<div id="deleteModal" class="hidden fixed inset-0 bg-black/50 backdrop-blur-sm flex items-center justify-center z-50">
    <div class="bg-[#0d1117] border border-red-600/50 rounded-xl p-6 max-w-sm mx-4 shadow-2xl">
        <div class="flex items-center justify-center w-12 h-12 mx-auto bg-red-600/20 rounded-full mb-4">
            <svg class="w-6 h-6 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4v2m0 4v2M6.23 6.23a7.5 7.5 0 1010.54 10.54M9 9h6v6H9V9z" />
            </svg>
        </div>

        <h3 class="text-lg font-bold text-white text-center mb-2">Delete Account?</h3>
        <p class="text-gray-400 text-sm text-center mb-4">
            This action cannot be undone. All your data including bookmarks, comments, and history will be permanently deleted.
        </p>

        <div class="flex gap-3">
            <button 
                onclick="closeDeleteModal()"
                class="flex-1 px-4 py-2 text-sm font-semibold rounded-lg bg-[#21262d] hover:bg-[#30363d] text-white transition-all">
                Cancel
            </button>
            <form action="{{ route('profile.delete') }}" method="POST" class="flex-1">
                @csrf
                @method('DELETE')
                <button 
                    type="submit"
                    class="w-full px-4 py-2 text-sm font-semibold rounded-lg bg-red-600 hover:bg-red-700 text-white transition-all">
                    Delete
                </button>
            </form>
        </div>
    </div>
</div>

<script>
    function openEditModal() {
        document.getElementById('editModal').classList.remove('hidden');
    }

    function closeEditModal() {
        document.getElementById('editModal').classList.add('hidden');
    }

    function confirmDeleteAccount() {
        document.getElementById('deleteModal').classList.remove('hidden');
    }

    function closeDeleteModal() {
        document.getElementById('deleteModal').classList.add('hidden');
    }

    function previewImage(event, previewId) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById(previewId).src = e.target.result;
            };
            reader.readAsDataURL(file);
        }
    }

    // Close modals when clicking outside
    document.getElementById('editModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeEditModal();
        }
    });

    document.getElementById('deleteModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeDeleteModal();
        }
    });
</script>
@endsection
