@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto py-10 text-[#c9d1d9]">

    {{-- Header: title, author, cover --}}
    <div class="mb-6 flex gap-6 items-start">
        <div class="w-36 h-52 bg-[#0d1117] rounded overflow-hidden border border-[#21262d]">
            @if(!empty($comic->image))
                <img src="{{ $comic->image }}" alt="{{ $comic->title }}" class="w-full h-full object-cover">
            @else
                <div class="w-full h-full flex items-center justify-center text-gray-600">No image</div>
            @endif
        </div>

        <div class="flex-1">
            <h1 class="text-2xl font-bold">{{ $comic->title }}</h1>
            @if(!empty($comic->author))
                <p class="text-sm text-gray-400">By {{ $comic->author }}</p>
            @endif
            <div class="mt-3 text-xs text-gray-400">Type: {{ strtoupper($comic->type ?? 'unknown') }}</div>

            {{-- Selected chapter display (updated by JS) --}}
            <div id="selected-chapter" class="mt-4 p-3 bg-[#0d1117] border border-[#21262d] rounded">
                <strong>Selected chapter:</strong>
                <span id="selected-chapter-value">None</span>
            </div>
        </div>
    </div>

    {{-- Chapters table --}}
    <div class="bg-[#161b22] border border-[#21262d] rounded-lg overflow-hidden">
        <div class="p-4 border-b border-[#21262d]">
            <h2 class="font-semibold">Chapters ({{ count($chapters) }})</h2>
            <p class="text-xs text-gray-400">Choose a chapter from the list below.</p>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm">
                <thead class="bg-[#0d1117] text-xs text-gray-400">
                    <tr>
                        <th class="px-4 py-2">#</th>
                        <th class="px-4 py-2">Chapter</th>
                        <th class="px-4 py-2">Language</th>
                        <th class="px-4 py-2">Published</th>
                        <th class="px-4 py-2">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($chapters as $idx => $c)
                        <tr class="border-t border-[#21262d] hover:bg-[#0f1620]" data-chapter-id="{{ $c['id'] }}" data-chapter="{{ $c['chapter'] }}">
                            <td class="px-4 py-3 align-middle">{{ $idx + 1 }}</td>
                            <td class="px-4 py-3 align-middle">{{ $c['chapter'] }}</td>
                            <td class="px-4 py-3 align-middle">{{ strtoupper($c['translatedLanguage'] ?? 'N/A') }}</td>
                            <td class="px-4 py-3 align-middle">{{ $c['readableAt'] ? \Illuminate\Support\Carbon::parse($c['readableAt'])->format('d M Y') : 'Unknown' }}</td>
                            <td class="px-4 py-3 align-middle">
                                <a href="{{ route('comic.chapter', ['mangadex_id' => $comic->mangadex_id, 'chapterId' => $c['id']]) }}" class="select-chapter inline-block px-3 py-1 bg-blue-600 hover:bg-blue-700 text-white rounded text-xs" data-id="{{ $c['id'] }}" data-chapter="{{ $c['chapter'] }}">Open</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-4 py-6 text-center text-gray-400">No chapters available.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>

@push('scripts')
<script>
    // Simple client-side chapter selection: sets the Selected chapter area.
    document.addEventListener('DOMContentLoaded', function () {
        const buttons = document.querySelectorAll('.select-chapter');
        const display = document.getElementById('selected-chapter-value');

        buttons.forEach(btn => {
            btn.addEventListener('click', function () {
                const chap = this.dataset.chapter || 'N/A';
                const id = this.dataset.id || '';
                display.textContent = chap + (id ? ' (id: ' + id + ')' : '');
                // Scroll to selection area
                display.scrollIntoView({ behavior: 'smooth', block: 'center' });
            });
        });
    });
</script>
@endpush

@endsection
