@extends('layouts.dashboard')

@section('page-title', 'Comments Management')

@section('content')
<div class="space-y-6">
    <div class="flex items-center justify-between">
        <h2 class="text-2xl font-bold text-white">Comments</h2>
        <div class="flex items-center gap-3">
            @include('partials.print-button')
            <a href="{{ route('dashboard.comments.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition-colors flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
            Add Comment
            </a>
        </div>
    </div>

    <div class="bg-[#161b22] border border-[#21262d] rounded-lg overflow-hidden print-table-container">
        <div class="overflow-x-auto">
            <table class="w-full print-table" id="commentsTable">
                <thead class="bg-[#0d1117]">
                    <tr>
                        <th class="text-left py-3 px-6 text-gray-400 text-sm font-medium">User</th>
                        <th class="text-left py-3 px-6 text-gray-400 text-sm font-medium">Comment</th>
                        <th class="text-left py-3 px-6 text-gray-400 text-sm font-medium">Comic</th>
                        <th class="text-left py-3 px-6 text-gray-400 text-sm font-medium">Type</th>
                        <th class="text-right py-3 px-6 text-gray-400 text-sm font-medium no-print">Actions</th>
                    </tr>
                    @include('partials.table-search', [
                        'searchColumns' => ['User', 'Comment', 'Comic', 'Type'],
                        'hasActions' => true
                    ])
                </thead>
                <tbody>
                    @forelse($comments as $comment)
                        <tr class="border-t border-[#21262d] hover:bg-[#0d1117]">
                            <td class="py-4 px-6 text-white">{{ $comment->user->name ?? 'Unknown' }}</td>
                            <td class="py-4 px-6 text-gray-400">{{ Str::limit($comment->comment, 50) }}</td>
                            <td class="py-4 px-6 text-gray-400">{{ $comment->comic->title ?? 'Unknown' }}</td>
                            <td class="py-4 px-6">
                                @if($comment->parent_id)
                                    <span class="px-2 py-1 text-xs rounded bg-blue-500/20 text-blue-400">Reply</span>
                                @else
                                    <span class="px-2 py-1 text-xs rounded bg-green-500/20 text-green-400">Comment</span>
                                @endif
                            </td>
                            <td class="py-4 px-6 no-print">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('dashboard.comments.edit', $comment) }}" class="text-blue-500 hover:text-blue-400">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                    </a>
                                    <form action="{{ route('dashboard.comments.destroy', $comment) }}" method="POST" onsubmit="return confirm('Are you sure?')" class="inline">
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
                            <td colspan="5" class="py-8 text-center text-gray-400">No comments found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="p-4 border-t border-[#21262d] no-print">
            {{ $comments->links() }}
        </div>
    </div>
</div>
@endsection

