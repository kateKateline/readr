<div class="bg-[#161b22] border border-[#30363d] rounded-lg shadow-xl overflow-hidden flex flex-col" style="height: 390px;">

    {{-- Header --}}
    <div class="border-b border-[#21262d] px-4 py-3 bg-[#0d1117] flex-shrink-0">
        <div class="flex items-center gap-2">
            <div class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></div>
            <h2 class="font-semibold text-sm text-[#c9d1d9]">Global Chat</h2>
            <span class="ml-auto text-xs text-gray-500">{{ $chats->count() }} messages</span>
        </div>
    </div>

    {{-- Chat messages --}}
    <div class="flex-1 overflow-y-auto px-3 py-3 space-y-0 thin-scrollbar-dark chat-scrollbar">
        @forelse ($chats as $chat)
        <div class="flex gap-2.5 py-2.5 px-2 transition animate-fadeIn border-b border-white last:border-b-0">
            <!-- Avatar Profile -->
            <div class="flex-shrink-0">
                <img
                    src="{{ $chat->user?->profile_image 
                            ? asset('storage/' . $chat->user->profile_image) 
                            : asset('default-profile.png') }}"
                    alt="{{ $chat->user?->name ?? 'Guest' }}"
                    class="w-8 h-8 rounded-full border border-[#30363d] object-cover hover:border-blue-500 transition"
                    title="{{ $chat->user?->name ?? 'Guest' }}">
            </div>

            <!-- Message Content -->
            <div class="flex-1 min-w-0">
                <!-- Username & Time -->
                <div class="flex items-baseline gap-2 mb-0.5">
                    <span class="font-semibold text-xs text-gray-200 truncate hover:text-white transition cursor-pointer">
                        {{ $chat->user?->name ?? 'Guest' }}
                    </span>
                    <span class="text-[10px] text-gray-500 flex-shrink-0" title="{{ $chat->created_at->format('d M Y, H:i') }}">
                        {{ $chat->created_at->diffForHumans() }}
                    </span>
                </div>

                <!-- Message Text -->
                <p class="text-xs text-gray-300 leading-relaxed break-words">
                    {{ $chat->message }}
                </p>
            </div>
        </div>
        @empty
        <div class="flex flex-col items-center justify-center h-full text-center px-4">
            <svg class="w-12 h-12 text-gray-600 mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                    d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
            </svg>
            <p class="text-sm text-gray-400 mb-1">No messages yet</p>
            <p class="text-xs text-gray-500">Be the first to say hi! 👋</p>
        </div>
        @endforelse
    </div>

    {{-- Input box --}}
    <div class="border-t border-[#21262d] p-3 bg-[#0d1117] flex-shrink-0">
        <form action="{{ route('global-chat.store') }}" method="POST" class="flex gap-2">
            @csrf
            <input
                type="text"
                name="message"
                placeholder="Type a message..."
                class="flex-1 bg-[#161b22] border border-[#30363d] text-gray-200 text-xs
                       rounded-lg px-3 py-2 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500/50 transition placeholder:text-gray-500"
                maxlength="500"
                required
                autocomplete="off">
            <button
                type="submit"
                class="flex-shrink-0 bg-blue-600 hover:bg-blue-700 text-white px-3 py-2 rounded-lg transition flex items-center justify-center group"
                title="Send message">
                <svg class="w-4 h-4 transform group-hover:translate-x-0.5 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                </svg>
            </button>
        </form>
    </div>
</div>