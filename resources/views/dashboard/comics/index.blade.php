@extends('layouts.dashboard')

@section('page-title', 'Comics Management')

@section('content')
<div class="space-y-6">
    <div class="flex items-center justify-between">
        <h2 class="text-2xl font-bold text-white">Comics</h2>
        <div class="flex items-center gap-3">
            @include('partials.print-button')
            <a href="{{ route('dashboard.comics.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition-colors flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Add Comic
            </a>
        </div>
    </div>

    <div class="bg-[#161b22] border border-[#21262d] rounded-lg overflow-hidden print-table-container">
        <div class="overflow-x-auto thin-scrollbar-dark">
            <table class="w-full print-table" id="comicsTable">
                <thead class="bg-[#0d1117]">
                    <tr>
                        <th class="text-left py-3 px-6 text-gray-400 text-sm font-medium">Cover</th>
                        <th class="text-left py-3 px-6 text-gray-400 text-sm font-medium">Title</th>
                        <th class="text-left py-3 px-6 text-gray-400 text-sm font-medium">Author</th>
                        <th class="text-left py-3 px-6 text-gray-400 text-sm font-medium">Status</th>
                        <th class="text-left py-3 px-6 text-gray-400 text-sm font-medium">Type</th>
                        <th class="text-left py-3 px-6 text-gray-400 text-sm font-medium">Is Sensitive</th>
                        <th class="text-right py-3 px-6 text-gray-400 text-sm font-medium no-print">Actions</th>
                    </tr>
                    @include('partials.table-search', [
                        'searchColumns' => ['Cover', 'Title', 'Author', 'Status', 'Type', 'Is Sensitive'],
                        'hasActions' => true
                    ])
                </thead>
                <tbody>
                    @forelse($comics as $comic)
                        <tr class="border-t border-[#21262d] hover:bg-[#0d1117]">
                            <td class="py-4 px-6">
                                @if($comic->image)
                                    <img src="{{ $comic->image }}" 
                                         alt="{{ $comic->title }}" 
                                         class="w-16 h-24 object-cover rounded border border-[#30363d]"
                                         onerror="this.src='https://via.placeholder.com/64x96?text=No+Image'">
                                @else
                                    <div class="w-16 h-24 bg-[#21262d] rounded border border-[#30363d] flex items-center justify-center">
                                        <span class="text-xs text-gray-500">No Image</span>
                                    </div>
                                @endif
                            </td>
                            <td class="py-4 px-6 text-white">{{ Str::limit($comic->title, 40) }}</td>
                            <td class="py-4 px-6 text-gray-400">{{ $comic->author ?? 'Unknown' }}</td>
                            <td class="py-4 px-6">
                                @if($comic->status)
                                    <span class="px-2 py-1 text-xs rounded bg-gray-700 text-gray-300">{{ ucfirst($comic->status) }}</span>
                                @else
                                    <span class="text-gray-500">-</span>
                                @endif
                            </td>
                            <td class="py-4 px-6 text-gray-400">
                                @if($comic->type)
                                    <span class="px-2 py-1 text-xs rounded bg-blue-500/20 text-blue-400">{{ ucfirst($comic->type) }}</span>
                                @else
                                    <span class="text-gray-500">-</span>
                                @endif
                            </td>
                            <td class="py-4 px-6">
                                <label class="relative inline-flex items-center cursor-pointer no-print">
                                    <input type="checkbox" 
                                           class="sr-only peer" 
                                           {{ $comic->is_sensitive ? 'checked' : '' }}
                                           onchange="toggleSensitive({{ $comic->id }}, this.checked)">
                                    <div class="w-11 h-6 bg-gray-600 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-800 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
                                    <span class="ml-3 text-sm text-gray-300">{{ $comic->is_sensitive ? 'Yes' : 'No' }}</span>
                                </label>
                                <span class="print-only">{{ $comic->is_sensitive ? 'Yes' : 'No' }}</span>
                            </td>
                            <td class="py-4 px-6 no-print">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('dashboard.comics.edit', $comic) }}" class="text-blue-500 hover:text-blue-400">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                    </a>
                                    <form action="{{ route('dashboard.comics.destroy', $comic) }}" method="POST" onsubmit="return confirm('Are you sure?')" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:text-red-400">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="py-8 text-center text-gray-400">No comics found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="p-4 border-t border-[#21262d] no-print">
            {{ $comics->links('vendor.pagination.custom') }}
        </div>
    </div>
</div>

<script>
function toggleSensitive(comicId, isSensitive) {
    const checkbox = event.target;
    const originalChecked = checkbox.checked;
    
    fetch(`/dashboard/comics/${comicId}/toggle-sensitive`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({
            is_sensitive: isSensitive
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Update text label
            const label = checkbox.closest('label');
            const span = label.querySelector('span');
            span.textContent = isSensitive ? 'Yes' : 'No';
        } else {
            // Revert checkbox if failed
            checkbox.checked = !isSensitive;
            alert('Gagal mengupdate status sensitive');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        checkbox.checked = !isSensitive;
        alert('Terjadi kesalahan saat mengupdate');
    });
}
</script>

<style>
.print-only {
    display: none;
}

@media print {
    .print-only {
        display: inline;
    }
    
    .no-print {
        display: none !important;
    }
    
    img {
        max-width: 60px;
        max-height: 80px;
        object-fit: cover;
    }
}
</style>
@endsection

