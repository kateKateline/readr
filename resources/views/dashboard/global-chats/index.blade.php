@extends('layouts.dashboard')

@section('page-title', 'Global Chats Management')

@section('content')
<div class="space-y-6">
    <div class="flex items-center justify-between">
        <h2 class="text-2xl font-bold text-white">Global Chats</h2>
        <a href="{{ route('dashboard.global-chats.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition-colors flex items-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
            Add Chat
        </a>
    </div>

    <div class="bg-[#161b22] border border-[#21262d] rounded-lg overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-[#0d1117]">
                    <tr>
                        <th class="text-left py-3 px-6 text-gray-400 text-sm font-medium">User</th>
                        <th class="text-left py-3 px-6 text-gray-400 text-sm font-medium">Message</th>
                        <th class="text-left py-3 px-6 text-gray-400 text-sm font-medium">Created</th>
                        <th class="text-right py-3 px-6 text-gray-400 text-sm font-medium">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($chats as $chat)
                        <tr class="border-t border-[#21262d] hover:bg-[#0d1117]">
                            <td class="py-4 px-6 text-white">{{ $chat->user->name ?? 'Unknown' }}</td>
                            <td class="py-4 px-6 text-gray-400">{{ Str::limit($chat->message, 60) }}</td>
                            <td class="py-4 px-6 text-gray-400 text-sm">{{ $chat->created_at->format('M d, Y H:i') }}</td>
                            <td class="py-4 px-6">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('dashboard.global-chats.edit', $chat) }}" class="text-blue-500 hover:text-blue-400">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                    </a>
                                    <form action="{{ route('dashboard.global-chats.destroy', $chat) }}" method="POST" onsubmit="return confirm('Are you sure?')" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:text-red-400">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="py-8 text-center text-gray-400">No chats found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="p-4 border-t border-[#21262d]">
            {{ $chats->links() }}
        </div>
    </div>
</div>
@endsection

