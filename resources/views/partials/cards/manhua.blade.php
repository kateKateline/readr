@forelse($manhua as $item)
    <div class="bg-[#161b22] rounded-xl p-3 shadow hover:shadow-lg transition">
        <img src="{{ asset('storage/'.$item->cover_image) }}" 
             alt="{{ $item->title }}" 
             class="rounded-lg w-full h-52 object-cover mb-3">
        <h3 class="text-lg font-semibold truncate">{{ $item->title }}</h3>
        <p class="text-sm text-gray-400">{{ $item->author ?? 'Unknown' }}</p>
    </div>
@empty
    <p class="text-gray-400">Belum ada manhua yang diunggah.</p>
@endforelse
