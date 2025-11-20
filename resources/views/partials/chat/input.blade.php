<form action="{{ route('global-chat.store') }}" method="POST" class="mt-4">
    @csrf
    <input 
        type="text" 
        name="message"
        placeholder="Ketik pesan..." 
        class="w-full bg-[#0d1117] border border-[#21262d] text-gray-200 
               rounded-lg px-4 py-2 focus:outline-none focus:border-blue-500"
        required
    >
</form>
