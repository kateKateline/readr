<div class="space-y-3 mt-4">
    @forelse ($chats as $chat)
        <div class="p-3 bg-[#0d1117] rounded-lg border border-[#21262d]">
            <p class="text-sm text-gray-400">
                <strong>{{ $chat->user?->name ?? 'Guest' }}</strong> 
                <span class="text-gray-500 text-xs">({{ $chat->created_at->diffForHumans() }})</span>
            </p>
            <p class="text-gray-200">{{ $chat->message }}</p>
        </div>
    @empty
        <div class="p-3 bg-[#0d1117] rounded-lg border border-[#21262d]">
            <p class="text-sm text-gray-300">Belum ada pesan. Mulai chat sekarang!</p>
        </div>
    @endforelse
</div>
