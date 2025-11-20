<div class="bg-[#0d1117] border border-[#30363d] rounded-xl shadow-lg h-[80vh] flex flex-col">
    {{-- Header --}}
    <div class="border-b border-[#21262d] px-4 py-3">
        <h2 class="font-semibold text-base text-[#c9d1d9] flex items-center gap-2">
            <svg class="w-5 h-5 text-blue-500" fill="currentColor" viewBox="0 0 20 20">
                <path d="M2 5a2 2 0 012-2h7a2 2 0 012 2v4a2 2 0 01-2 2H9l-3 3v-3H4a2 2 0 01-2-2V5z"/>
                <path d="M15 7v2a4 4 0 01-4 4H9.828l-1.766 1.767c.28.149.599.233.938.233h2l3 3v-3h2a2 2 0 002-2V9a2 2 0 00-2-2h-1z"/>
            </svg>
            Global Chat
        </h2>
    </div>

    {{-- Chat messages --}}
    <div class="flex-1 overflow-y-auto px-4 py-3 space-y-3 scrollbar-thin scrollbar-thumb-[#21262d] scrollbar-track-transparent">
        @include('partials.chat.messages')
    </div>

    {{-- Input box --}}
    <div class="border-t border-[#21262d] px-4 py-3">
        @include('partials.chat.input')
    </div>
</div>