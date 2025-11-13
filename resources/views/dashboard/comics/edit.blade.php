@extends('layouts.app')

@section('content')
<section class="py-12 bg-[#0d1117] min-h-screen text-[#c9d1d9]">
    <div class="max-w-3xl mx-auto px-6">
        <h1 class="text-2xl font-bold mb-4">Edit Comic</h1>

        @if ($errors->any())
            <div class="mb-4 p-3 bg-red-600 text-white rounded">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('dashboard.comics.update', $comic->id) }}" method="POST" class="space-y-4 bg-[#161b22] p-6 rounded">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-sm text-gray-300">Title</label>
                <input name="title" value="{{ old('title', $comic->title) }}" class="w-full mt-1 p-2 rounded bg-[#0b1116] border border-[#222834]" required>
            </div>

            <div>
                <label class="block text-sm text-gray-300">Author</label>
                <input name="author" value="{{ old('author', $comic->author) }}" class="w-full mt-1 p-2 rounded bg-[#0b1116] border border-[#222834]">
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                        <label class="block text-sm text-gray-300">Type</label>
                        <select name="type" class="w-full mt-1 p-2 rounded bg-[#0b1116] border border-[#222834]">
                            <option value="" {{ old('type', $comic->type) == '' ? 'selected' : '' }}>-- Pilih Type --</option>
                            <option value="manga" {{ old('type', $comic->type) == 'manga' ? 'selected' : '' }}>Manga</option>
                            <option value="manhwa" {{ old('type', $comic->type) == 'manhwa' ? 'selected' : '' }}>Manhwa</option>
                            <option value="manhua" {{ old('type', $comic->type) == 'manhua' ? 'selected' : '' }}>Manhua</option>
                        </select>
                </div>
                <div>
                    <label class="block text-sm text-gray-300">Status</label>
                    <input name="status" value="{{ old('status', $comic->status) }}" class="w-full mt-1 p-2 rounded bg-[#0b1116] border border-[#222834]">
                </div>
            </div>

            <div>
                <label class="block text-sm text-gray-300">Slug (optional)</label>
                <input name="slug" value="{{ old('slug', $comic->slug) }}" class="w-full mt-1 p-2 rounded bg-[#0b1116] border border-[#222834]">
            </div>

            <div>
                <label class="block text-sm text-gray-300">Description</label>
                <textarea name="desc" class="w-full mt-1 p-2 rounded bg-[#0b1116] border border-[#222834]">{{ old('desc', $comic->desc) }}</textarea>
            </div>

            <div class="flex gap-2 justify-end">
                <a href="{{ route('dashboard') }}" class="text-sm text-gray-300 px-4 py-2 rounded border border-[#30363d]">Batal</a>
                <button type="submit" class="text-sm text-white bg-blue-600 px-4 py-2 rounded">Simpan</button>
            </div>
        </form>
    </div>
</section>
@endsection
