@extends('layouts.dashboard')

@section('page-title', 'Edit User')

@section('content')
<div class="max-w-2xl">
    <div class="mb-6">
        <a href="{{ route('dashboard.users.index') }}" class="text-blue-500 hover:text-blue-400 flex items-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
            Back to Users
        </a>
    </div>

    <div class="bg-[#161b22] border border-[#21262d] rounded-lg p-6">
        <h2 class="text-xl font-semibold text-white mb-6">Edit User</h2>
        
        <form action="{{ route('dashboard.users.update', $user) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="space-y-4">
                <div>
                    <label class="block text-gray-300 text-sm font-medium mb-2">Name</label>
                    <input type="text" name="name" value="{{ old('name', $user->name) }}" required
                           class="w-full px-4 py-2 bg-[#0d1117] border border-[#30363d] text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    @error('name')
                        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-gray-300 text-sm font-medium mb-2">Email</label>
                    <input type="email" name="email" value="{{ old('email', $user->email) }}" required
                           class="w-full px-4 py-2 bg-[#0d1117] border border-[#30363d] text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    @error('email')
                        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-gray-300 text-sm font-medium mb-2">Password (leave blank to keep current)</label>
                    <input type="password" name="password"
                           class="w-full px-4 py-2 bg-[#0d1117] border border-[#30363d] text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    @error('password')
                        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-gray-300 text-sm font-medium mb-2">Level</label>
                    <select name="level" required
                            class="w-full px-4 py-2 bg-[#0d1117] border border-[#30363d] text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="user" {{ old('level', $user->level) === 'user' ? 'selected' : '' }}>User</option>
                        <option value="admin" {{ old('level', $user->level) === 'admin' ? 'selected' : '' }}>Admin</option>
                    </select>
                    @error('level')
                        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="flex items-center gap-2">
                        <input type="checkbox" name="censorship_enabled" value="1" {{ old('censorship_enabled', $user->censorship_enabled) ? 'checked' : '' }}
                               class="w-4 h-4 bg-[#0d1117] border-[#30363d] text-blue-600 rounded focus:ring-blue-500">
                        <span class="text-gray-300 text-sm">Censorship Enabled</span>
                    </label>
                </div>
            </div>

            <div class="mt-6 flex gap-4">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg transition-colors">
                    Update User
                </button>
                <a href="{{ route('dashboard.users.index') }}" class="bg-[#21262d] hover:bg-[#30363d] text-white px-6 py-2 rounded-lg transition-colors">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>
@endsection

