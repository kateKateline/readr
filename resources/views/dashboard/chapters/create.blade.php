@extends('layouts.dashboard')

@section('page-title', 'Create Chapter')

@section('content')
<div class="max-w-2xl">
    <div class="mb-6">
        <a href="{{ route('dashboard.chapters.index') }}" class="text-blue-500 hover:text-blue-400 flex items-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
            Back to Chapters
        </a>
    </div>

    <div class="bg-[#161b22] border border-[#21262d] rounded-lg p-6">
        <h2 class="text-xl font-semibold text-white mb-6">Create New Chapter</h2>
        
        <form action="{{ route('dashboard.chapters.store') }}" method="POST">
            @csrf
            
            <div class="space-y-4">
                <div>
                    <label class="block text-gray-300 text-sm font-medium mb-2">Comic</label>
                    <select name="comic_id" required
                            class="w-full px-4 py-2 bg-[#0d1117] border border-[#30363d] text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">Select Comic</option>
                        @foreach($comics as $comic)
                            <option value="{{ $comic->id }}" {{ old('comic_id') == $comic->id ? 'selected' : '' }}>{{ $comic->title }}</option>
                        @endforeach
                    </select>
                    @error('comic_id')
                        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-gray-300 text-sm font-medium mb-2">MangaDex ID</label>
                    <input type="text" name="mangadex_id" value="{{ old('mangadex_id') }}" required
                           class="w-full px-4 py-2 bg-[#0d1117] border border-[#30363d] text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    @error('mangadex_id')
                        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-gray-300 text-sm font-medium mb-2">Chapter Number</label>
                    <input type="text" name="chapter_number" value="{{ old('chapter_number') }}" required
                           class="w-full px-4 py-2 bg-[#0d1117] border border-[#30363d] text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    @error('chapter_number')
                        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-gray-300 text-sm font-medium mb-2">Title</label>
                    <input type="text" name="title" value="{{ old('title') }}"
                           class="w-full px-4 py-2 bg-[#0d1117] border border-[#30363d] text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div>
                    <label class="block text-gray-300 text-sm font-medium mb-2">Translated Language</label>
                    <input type="text" name="translated_language" value="{{ old('translated_language') }}"
                           class="w-full px-4 py-2 bg-[#0d1117] border border-[#30363d] text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div>
                    <label class="block text-gray-300 text-sm font-medium mb-2">Pages</label>
                    <input type="number" name="pages" value="{{ old('pages') }}"
                           class="w-full px-4 py-2 bg-[#0d1117] border border-[#30363d] text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div>
                    <label class="flex items-center gap-2">
                        <input type="checkbox" name="is_unavailable" value="1" {{ old('is_unavailable') ? 'checked' : '' }}
                               class="w-4 h-4 bg-[#0d1117] border-[#30363d] text-blue-600 rounded focus:ring-blue-500">
                        <span class="text-gray-300 text-sm">Is Unavailable</span>
                    </label>
                </div>
            </div>

            <div class="mt-6 flex gap-4">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg transition-colors">
                    Create Chapter
                </button>
                <a href="{{ route('dashboard.chapters.index') }}" class="bg-[#21262d] hover:bg-[#30363d] text-white px-6 py-2 rounded-lg transition-colors">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>
@endsection

