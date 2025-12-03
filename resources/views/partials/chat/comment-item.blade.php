{{-- resources/views/partials/chat/comment-item.blade.php (Enhanced Dark Style) --}}
@php
$isReply = $comment->parent_id !== null;
$itemClass = $isReply
? 'bg-transparent'
: 'bg-[#161b22] border border-[#21262d] rounded-xl p-4 transition-all duration-200 shadow-md';
@endphp

<li class="{{ $itemClass }} relative group">

    <div class="flex items-start">

        {{-- Enhanced Reply Line --}}
        @if ($isReply)
        <div class="absolute top-0 left-[-24px] w-6 h-full flex items-start pt-2">
            <div class="relative w-full h-full">
                {{-- Vertical line --}}
                <div class="absolute left-3 top-0 w-0.5 h-full bg-gradient-to-b from-[#30363d] to-transparent"></div>
                {{-- Horizontal connector --}}
                <div class="absolute left-3 top-5 w-5 h-0.5 bg-gradient-to-r from-[#30363d] to-[#21262d]"></div>
                {{-- Decorative dot --}}
                <div class="absolute left-[10px] top-[18px] w-1.5 h-1.5 bg-blue-500/50 rounded-full shadow-lg shadow-blue-500/50"></div>
            </div>
        </div>
        @endif

        {{-- Profile Image/Avatar with blue border --}}
        <div class="flex-shrink-0 w-10 h-10 rounded-full bg-blue-500 text-white flex items-center justify-center font-bold text-sm overflow-hidden border-2 border-[#30363d] shadow-lg">
            @if($comment->user->profile_image)
            <img src="{{ asset('storage/' . $comment->user->profile_image) }}" alt="{{ $comment->user->name }}" class="w-full h-full object-cover">
            @else
            {{ strtoupper(substr($comment->user->name, 0, 1)) }}
            @endif
        </div>

        <div class="ml-3 flex-1 min-w-0">
            {{-- Header Section --}}
            <div class="flex items-center justify-between flex-wrap gap-2 mb-2">
                <div class="flex items-center flex-wrap gap-2">
                    <span class="font-semibold text-white text-sm hover:text-blue-400 transition-colors cursor-pointer">
                        {{ $comment->user->name }}
                    </span>
                    <span class="text-gray-500 text-xs flex items-center">
                        <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd" />
                        </svg>
                        {{ $comment->created_at->diffForHumans() }}
                    </span>
                    @if($comment->is_edited)
                    <span class="text-gray-500 text-xs italic flex items-center bg-[#0d1117] px-2 py-0.5 rounded">
                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                        edited
                    </span>
                    @endif
                </div>

                {{-- Like/Dislike Section --}}
                <div class="flex items-center bg-[#0d1117] rounded-full px-3 py-1.5 space-x-3 border border-[#21262d]">
                    <button type="button" class="like-btn flex items-center space-x-1 hover:text-blue-400 text-gray-500 transition-all duration-200 group/like" data-comment-id="{{ $comment->id }}">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4 group-hover/like:scale-110 transition-transform">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6.633 10.5c.806 0 1.533-.446 2.031-1.08a9.041 9.041 0 012.861-2.4c.723-.384 1.35-.956 1.653-1.715a4.498 4.498 0 00.322-1.672V3a.75.75 0 01.75-.75A2.25 2.25 0 0116.5 4.5c0 1.152-.26 2.243-.723 3.218-.266.558.107 1.282.725 1.282h3.126c1.026 0 1.945.694 2.054 1.715.045.422.068.85.068 1.285a11.95 11.95 0 01-2.649 7.521c-.388.482-.987.729-1.605.729H13.48c-.483 0-.964-.078-1.423-.23l-3.114-.952a4.5 4.5 0 00-1.423-.23H5.904M14.25 9h2.25M5.904 18.75c.083.205.173.405.27.602.197.4-.078.898-.523.898h-.908c-.889 0-1.713-.518-1.972-1.368a12 12 0 01-.521-3.507c0-1.553.295-3.036.831-4.398C3.387 10.203 4.167 9.75 5 9.75h1.053c.472 0 .745.556.5.96a8.958 8.958 0 00-1.302 4.665c0 1.194.232 2.333.654 3.375z" />
                            </svg>
                            <span class="font-semibold text-xs" data-likes="{{ $comment->id }}">{{ $comment->likes_count ?? 0 }}</span>
                        </button>
                    <div class="w-px h-4 bg-[#21262d]"></div>
                        <button type="button" class="dislike-btn flex items-center space-x-1 hover:text-red-400 text-gray-500 transition-all duration-200 group/dislike" data-comment-id="{{ $comment->id }}">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4 transform rotate-180 group-hover/dislike:scale-110 transition-transform">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6.633 10.5c.806 0 1.533-.446 2.031-1.08a9.041 9.041 0 012.861-2.4c.723-.384 1.35-.956 1.653-1.715a4.498 4.498 0 00.322-1.672V3a.75.75 0 01.75-.75A2.25 2.25 0 0116.5 4.5c0 1.152-.26 2.243-.723 3.218-.266.558.107 1.282.725 1.282h3.126c1.026 0 1.945.694 2.054 1.715.045.422.068.85.068 1.285a11.95 11.95 0 01-2.649 7.521c-.388.482-.987.729-1.605.729H13.48c-.483 0-.964-.078-1.423-.23l-3.114-.952a4.5 4.5 0 00-1.423-.23H5.904M14.25 9h2.25M5.904 18.75c.083.205.173.405.27.602.197.4-.078.898-.523.898h-.908c-.889 0-1.713-.518-1.972-1.368a12 12 0 01-.521-3.507c0-1.553.295-3.036.831-4.398C3.387 10.203 4.167 9.75 5 9.75h1.053c.472 0 .745.556.5.96a8.958 8.958 0 00-1.302 4.665c0 1.194.232 2.333.654 3.375z" />
                            </svg>
                            <span class="font-semibold text-xs" data-dislikes="{{ $comment->id }}">{{ $comment->dislikes_count ?? 0 }}</span>
                        </button>
                </div>
            </div>

            {{-- Comment Content --}}
            <div class="text-gray-300 leading-relaxed text-[15px] mb-3" id="comment-content-{{ $comment->id }}">
                {{ $comment->comment }}
            </div>

            {{-- Comment Actions --}}
            <div class="flex items-center gap-4">
                @auth
                <button type="button" onclick="toggleReply('{{ $comment->id }}')" class="text-gray-500 hover:text-blue-400 text-xs font-semibold transition-colors flex items-center group/reply">
                    <svg class="w-4 h-4 mr-1.5 group-hover/reply:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6" />
                    </svg>
                    Reply
                </button>

                @if(auth()->id() === $comment->user_id)
                <button type="button" onclick="toggleEdit('{{ $comment->id }}')" class="text-gray-500 hover:text-yellow-400 text-xs font-semibold transition-colors flex items-center group/edit">
                    <svg class="w-4 h-4 mr-1.5 group-hover/edit:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                    </svg>
                    Edit
                </button>
                @endif

                @if(auth()->id() === $comment->user_id || auth()->user()->level === 'admin')
                <form id="delete-form-{{ $comment->id }}" action="{{ route('comments.destroy', $comment->id) }}" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="button" onclick="confirmDelete('{{ $comment->id }}')" class="text-gray-500 hover:text-red-400 text-xs font-semibold transition-colors flex items-center group/delete">
                        <svg class="w-4 h-4 mr-1.5 group-hover/delete:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                        Delete
                    </button>
                </form>
                @endif
                @endauth
            </div>

            {{-- Reply Form --}}
            @auth
            <div class="hidden mt-4" id="reply-form-{{ $comment->id }}">
                <form action="{{ route('comments.store') }}" method="POST" class="bg-[#0d1117] p-4 rounded-lg border border-[#30363d] shadow-inner">
                    @csrf
                    <input type="hidden" name="comic_id" value="{{ $comment->comic_id }}">
                    <input type="hidden" name="parent_id" value="{{ $comment->id }}">
                    <textarea
                        name="comment"
                        placeholder="Write a reply..."
                        required
                        class="w-full px-3 py-2.5 bg-[#0d1117] border border-[#30363d] text-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent resize-vertical min-h-[80px] transition-all"></textarea>
                    <div class="flex justify-end gap-2 mt-3">
                        <button type="button" onclick="toggleReply('{{ $comment->id }}')" class="bg-[#21262d] hover:bg-[#30363d] text-gray-300 px-4 py-2 rounded-lg text-sm font-medium transition-all duration-200">
                            Cancel
                        </button>
                        <button type="submit" class="bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white px-5 py-2 rounded-lg text-sm font-semibold transition-all duration-200 shadow-md hover:shadow-lg transform hover:-translate-y-0.5">
                            Post Reply
                        </button>
                    </div>
                </form>
            </div>

            {{-- Form Edit --}}
            @if(auth()->id() === $comment->user_id)
            <div class="hidden mt-4" id="edit-form-{{ $comment->id }}">
                <form action="{{ route('comments.update', $comment->id) }}" method="POST" class="bg-[#0d1117] p-4 rounded-lg border border-[#30363d] shadow-inner">
                    @csrf
                    @method('PUT')
                    <textarea
                        name="comment"
                        required
                        class="w-full px-3 py-2.5 bg-[#0d1117] border border-[#30363d] text-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent resize-vertical min-h-[80px] transition-all">{{ $comment->comment }}</textarea>
                    <div class="flex justify-end gap-2 mt-3">
                        <button type="button" onclick="cancelEdit('{{ $comment->id }}')" class="bg-[#21262d] hover:bg-[#30363d] text-gray-300 px-4 py-2 rounded-lg text-sm font-medium transition-all duration-200">
                            Cancel
                        </button>
                        <button type="submit" class="bg-gradient-to-r from-green-600 to-green-700 hover:from-green-700 hover:to-green-800 text-white px-5 py-2 rounded-lg text-sm font-semibold transition-all duration-200 shadow-md hover:shadow-lg transform hover:-translate-y-0.5">
                            Save Changes
                        </button>
                    </div>
                </form>
            </div>
            @endif
            @endauth
        </div>
    </div>

    {{-- Nested Replies --}}
    @if($comment->replies->count() > 0)
    <div class="ml-12 mt-4">
        <button
            onclick="toggleReplies('{{ $comment->id }}')"
            class="text-blue-500 hover:text-blue-400 text-sm font-semibold flex items-center gap-2 mb-3 transition-colors"
            id="replies-toggle-{{ $comment->id }}">
            <svg class="w-4 h-4 transition-transform duration-200" id="replies-icon-{{ $comment->id }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
            </svg>
            <span id="replies-text-{{ $comment->id }}">Show {{ $comment->replies->count() }} {{ $comment->replies->count() > 1 ? 'replies' : 'reply' }}</span>
        </button>
        <ul class="space-y-4 hidden" id="replies-list-{{ $comment->id }}">
            @foreach($comment->replies as $reply)
            @include('partials.chat.comment-item', ['comment' => $reply])
            @endforeach
        </ul>
    </div>
    @endif
</li>