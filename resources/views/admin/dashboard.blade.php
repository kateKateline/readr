@extends('layouts.main')

@section('content')
<div class="max-w-7xl mx-auto py-50 px-6">

    <div class="flex items-center justify-between mb-8">
        <h1 class="text-4xl font-bold text-gray-900">📊 Admin Dashboard</h1>
        <button id="openModal"
            class="px-6 py-2.5 bg-purple-600 text-white font-semibold rounded-lg shadow hover:bg-purple-700 hover:shadow-lg transition-all duration-200">
            + Tambah Komik
        </button>
    </div>

    <!-- Table -->
<div class="bg-white shadow-lg rounded-2xl overflow-hidden">
    <table class="min-w-full border border-gray-200 text-gray-800">
        <thead class="bg-gray-100">
            <tr class="text-left uppercase text-sm font-semibold text-gray-600">
                <th class="px-6 py-3 border-b">#</th>
                <th class="px-6 py-3 border-b">Title</th>
                <th class="px-6 py-3 border-b">Author</th>
                <th class="px-6 py-3 border-b">Type</th>
                <th class="px-6 py-3 border-b">Status</th>
                <th class="px-6 py-3 border-b text-center">Age</th>
                <th class="px-6 py-3 border-b text-center">Chapters</th>
                <th class="px-6 py-3 border-b text-center">Rating</th>
                <th class="px-6 py-3 border-b text-center">Rank</th>
                <th class="px-6 py-3 border-b">Cover</th>
                <th class="px-6 py-3 border-b">Banner</th>
                <th class="px-6 py-3 border-b">Synopsis</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($comics as $comic)
            <tr class="hover:bg-gray-50 transition text-gray-700 align-top">
                <td class="px-6 py-3 border-b">{{ $comic->id }}</td>

                <td class="px-6 py-3 border-b font-semibold text-gray-900">
                    {{ $comic->title }}
                </td>

                <td class="px-6 py-3 border-b">{{ $comic->author }}</td>

                <td class="px-6 py-3 border-b">{{ $comic->type }}</td>

                <td class="px-6 py-3 border-b">
                    <span class="px-3 py-1 rounded-full text-xs font-semibold
                        @if($comic->status == 'completed') bg-green-100 text-green-700
                        @elseif($comic->status == 'ongoing') bg-blue-100 text-blue-700
                        @elseif($comic->status == 'hiatus') bg-yellow-100 text-yellow-700
                        @else bg-red-100 text-red-700 @endif">
                        {{ ucfirst($comic->status) }}
                    </span>
                </td>

                <td class="px-6 py-3 border-b text-center">{{ $comic->age_rating ?? '-' }}</td>

                <td class="px-6 py-3 border-b text-center">{{ $comic->chapters ?? 0 }}</td>

                <td class="px-6 py-3 border-b text-center font-semibold text-purple-700">
                    {{ $comic->rating ?? 0.0 }}
                </td>

                <td class="px-6 py-3 border-b text-center">{{ $comic->rank ?? 0 }}</td>

                <td class="px-6 py-3 border-b">
                    @if($comic->cover_image)
                        <img src="{{ asset('images/' . $comic->cover_image) }}"
                             alt="Cover" class="w-16 h-24 object-cover rounded-md shadow-md">
                    @else
                        <span class="text-gray-400 text-sm">No Image</span>
                    @endif
                </td>

                <td class="px-6 py-3 border-b">
                    @if($comic->cover_banner)
                        <img src="{{ asset('images/' . $comic->cover_banner) }}"
                             alt="Banner" class="w-32 h-20 object-cover rounded-md shadow">
                    @else
                        <span class="text-gray-400 text-sm">No Banner</span>
                    @endif
                </td>

                <td class="px-6 py-3 border-b max-w-xs text-sm text-gray-600 leading-snug">
                    {{ \Illuminate\Support\Str::limit($comic->synopsis ?? '-', 80) }}
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="12" class="text-center py-8 text-gray-400 text-lg">
                    Belum ada data komik 😔
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

</div>

<!-- Modal -->
<div id="modal"
    class="fixed inset-0 bg-black/50 backdrop-blur-sm hidden items-center justify-center z-50 transition-all duration-300">
    <div
        class="bg-white rounded-2xl shadow-2xl w-full max-w-2xl p-8 relative transform scale-95 opacity-0 transition-all duration-300"
        id="modalContent">

        <button id="closeModal"
            class="absolute top-3 right-4 text-gray-400 hover:text-gray-700 text-2xl font-bold">&times;</button>

        <h2 class="text-2xl font-bold mb-6 text-gray-900">➕ Tambah Komik Baru</h2>

       <form action="{{ route('admin.comics.store') }}" method="POST" enctype="multipart/form-data">
            @csrf 

            <div class="grid grid-cols-2 gap-5">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Judul</label>
                    <input type="text" name="title" required
                        class="w-full border-gray-300 rounded-lg focus:ring-purple-500 focus:border-purple-500">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Author</label>
                    <input type="text" name="author" required
                        class="w-full border-gray-300 rounded-lg focus:ring-purple-500 focus:border-purple-500">
                </div>
            </div>

            <div class="grid grid-cols-3 gap-5">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Type</label>
                    <select name="type" required
                        class="w-full border-gray-300 rounded-lg focus:ring-purple-500 focus:border-purple-500">
                        <option value="Manga">Manga</option>
                        <option value="Manhwa">Manhwa</option>
                        <option value="Manhua">Manhua</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Status</label>
                    <select name="status" required
                        class="w-full border-gray-300 rounded-lg focus:ring-purple-500 focus:border-purple-500">
                        <option value="ongoing">Ongoing</option>
                        <option value="completed">Completed</option>
                        <option value="hiatus">Hiatus</option>
                        <option value="cancelled">Cancelled</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Age Rating</label>
                    <input type="text" name="age_rating" value="13+" required
                        class="w-full border-gray-300 rounded-lg focus:ring-purple-500 focus:border-purple-500">
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Synopsis</label>
                <textarea name="synopsis" rows="3"
                    class="w-full border-gray-300 rounded-lg focus:ring-purple-500 focus:border-purple-500"></textarea>
            </div>

            <div class="grid grid-cols-2 gap-5">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Chapters</label>
                    <input type="number" name="chapters" value="0"
                        class="w-full border-gray-300 rounded-lg focus:ring-purple-500 focus:border-purple-500">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Rank</label>
                    <input type="number" name="rank" value="0"
                        class="w-full border-gray-300 rounded-lg focus:ring-purple-500 focus:border-purple-500">
                </div>
            </div>

            <div class="grid grid-cols-2 gap-5">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Rating</label>
                    <input type="number" step="0.1" name="rating" value="0.0"
                        class="w-full border-gray-300 rounded-lg focus:ring-purple-500 focus:border-purple-500">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Cover Image</label>
                    <input type="file" name="cover_image" accept="image/*"
                        class="w-full border-gray-300 rounded-lg focus:ring-purple-500 focus:border-purple-500">
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Cover Banner</label>
                <input type="file" name="cover_banner" accept="image/*"
                    class="w-full border-gray-300 rounded-lg focus:ring-purple-500 focus:border-purple-500">
            </div>

            <div class="pt-4 flex justify-end gap-3">
                <button type="button" id="cancelBtn"
                    class="px-5 py-2 border rounded-lg text-gray-600 hover:bg-gray-100">Batal</button>
                <button type="submit"
                    class="px-6 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700 shadow transition-all">Simpan</button>
            </div>
        </form>
    </div>
</div>

<script>
    const modal = document.getElementById('modal');
    const modalContent = document.getElementById('modalContent');
    const open = document.getElementById('openModal');
    const close = document.getElementById('closeModal');
    const cancel = document.getElementById('cancelBtn');

    function openModal() {
        modal.classList.remove('hidden');
        setTimeout(() => {
            modalContent.classList.remove('scale-95', 'opacity-0');
            modalContent.classList.add('scale-100', 'opacity-100');
        }, 50);
    }

    function closeModal() {
        modalContent.classList.add('scale-95', 'opacity-0');
        setTimeout(() => modal.classList.add('hidden'), 200);
    }

    open.addEventListener('click', openModal);
    close.addEventListener('click', closeModal);
    cancel.addEventListener('click', closeModal);
    window.addEventListener('click', e => { if (e.target === modal) closeModal(); });
</script>
@endsection
