@extends('layouts.dashboard')

@section('page-title', 'Edit Comic')

@section('content')
<div class="max-w-2xl">
    <div class="mb-6">
        <a href="{{ route('dashboard.comics.index') }}" class="text-blue-500 hover:text-blue-400 flex items-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
            Back to Comics
        </a>
    </div>

    <div class="bg-[#161b22] border border-[#21262d] rounded-lg p-6">
        <h2 class="text-xl font-semibold text-white mb-6">Edit Comic</h2>
        
        <form action="{{ route('dashboard.comics.update', $comic) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="space-y-4">
                <div>
                    <label class="block text-gray-300 text-sm font-medium mb-2">MangaDex ID</label>
                    <input type="text" name="mangadex_id" value="{{ old('mangadex_id', $comic->mangadex_id) }}" required
                           class="w-full px-4 py-2 bg-[#0d1117] border border-[#30363d] text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    @error('mangadex_id')
                        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-gray-300 text-sm font-medium mb-2">Title</label>
                    <input type="text" name="title" value="{{ old('title', $comic->title) }}" required
                           class="w-full px-4 py-2 bg-[#0d1117] border border-[#30363d] text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    @error('title')
                        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-gray-300 text-sm font-medium mb-2">Author</label>
                    <input type="text" name="author" value="{{ old('author', $comic->author) }}"
                           class="w-full px-4 py-2 bg-[#0d1117] border border-[#30363d] text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div>
                    <label class="block text-gray-300 text-sm font-medium mb-2">Type</label>
                    <input type="text" name="type" value="{{ old('type', $comic->type) }}"
                           class="w-full px-4 py-2 bg-[#0d1117] border border-[#30363d] text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div>
                    <label class="block text-gray-300 text-sm font-medium mb-2">Status</label>
                    <input type="text" name="status" value="{{ old('status', $comic->status) }}"
                           class="w-full px-4 py-2 bg-[#0d1117] border border-[#30363d] text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div>
                    <label class="block text-gray-300 text-sm font-medium mb-2">Image URL</label>
                    <input type="text" name="image" value="{{ old('image', $comic->image) }}"
                           class="w-full px-4 py-2 bg-[#0d1117] border border-[#30363d] text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div>
                    <label class="block text-gray-300 text-sm font-medium mb-2">Rating</label>
                    <input type="number" step="0.01" name="rating" value="{{ old('rating', $comic->rating) }}"
                           class="w-full px-4 py-2 bg-[#0d1117] border border-[#30363d] text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div>
                    <label class="flex items-center gap-2">
                        <input type="checkbox" name="is_sensitive" value="1" {{ old('is_sensitive', $comic->is_sensitive) ? 'checked' : '' }}
                               class="w-4 h-4 bg-[#0d1117] border-[#30363d] text-blue-600 rounded focus:ring-blue-500">
                        <span class="text-gray-300 text-sm">Is Sensitive</span>
                    </label>
                </div>
            </div>

            <div class="mt-6 flex gap-4">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg transition-colors">
                    Update Comic
                </button>
                <a href="{{ route('dashboard.comics.index') }}" class="bg-[#21262d] hover:bg-[#30363d] text-white px-6 py-2 rounded-lg transition-colors">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>
@endsection

