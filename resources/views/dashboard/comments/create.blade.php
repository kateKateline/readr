@extends('layouts.dashboard')

@section('page-title', 'Create Comment')

@section('content')
<div class="max-w-2xl">
    <div class="mb-6">
        <a href="{{ route('dashboard.comments.index') }}" class="text-blue-500 hover:text-blue-400 flex items-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
            Back to Comments
        </a>
    </div>

    <div class="bg-[#161b22] border border-[#21262d] rounded-lg p-6">
        <h2 class="text-xl font-semibold text-white mb-6">Create New Comment</h2>
        
        <form action="{{ route('dashboard.comments.store') }}" method="POST">
            @csrf
            
            <div class="space-y-4">
                <div>
                    <label class="block text-gray-300 text-sm font-medium mb-2">User</label>
                    <select name="user_id" required
                            class="w-full px-4 py-2 bg-[#0d1117] border border-[#30363d] text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">Select User</option>
                        @foreach($users as $user)
                            <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                        @endforeach
                    </select>
                    @error('user_id')
                        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

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
                    <label class="block text-gray-300 text-sm font-medium mb-2">Parent Comment (Optional - for replies)</label>
                    <select name="parent_id"
                            class="w-full px-4 py-2 bg-[#0d1117] border border-[#30363d] text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">None (Top-level comment)</option>
                        @foreach($parentComments as $parent)
                            <option value="{{ $parent->id }}" {{ old('parent_id') == $parent->id ? 'selected' : '' }}>{{ Str::limit($parent->comment, 50) }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-gray-300 text-sm font-medium mb-2">Comment</label>
                    <textarea name="comment" rows="5" required
                              class="w-full px-4 py-2 bg-[#0d1117] border border-[#30363d] text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('comment') }}</textarea>
                    @error('comment')
                        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="flex items-center gap-2">
                        <input type="checkbox" name="is_edited" value="1" {{ old('is_edited') ? 'checked' : '' }}
                               class="w-4 h-4 bg-[#0d1117] border-[#30363d] text-blue-600 rounded focus:ring-blue-500">
                        <span class="text-gray-300 text-sm">Is Edited</span>
                    </label>
                </div>
            </div>

            <div class="mt-6 flex gap-4">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg transition-colors">
                    Create Comment
                </button>
                <a href="{{ route('dashboard.comments.index') }}" class="bg-[#21262d] hover:bg-[#30363d] text-white px-6 py-2 rounded-lg transition-colors">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>
@endsection

