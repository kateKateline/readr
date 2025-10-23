<div class="bg-white rounded shadow p-2 text-center">
    <img src="{{ asset('storage/covers/'.$comic->cover_image) }}" alt="{{ $comic->title }}" class="w-full h-40 object-cover rounded">
    <h3 class="text-sm font-semibold mt-2">{{ Str::limit($comic->title, 40) }}</h3>
    <p class="text-xs text-gray-500 mt-1">{{ $comic->author }}</p>
</div>
