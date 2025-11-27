@extends('layouts.app')

@section('content')
<div class="container mx-auto py-6">
    <h1 class="text-3xl font-bold mb-4">{{ $comic->title }}</h1>

    <div class="mb-6">
        <img src="{{ $comic->image }}" alt="{{ $comic->title }}" class="w-48 rounded shadow">
    </div>

    <h2 class="text-xl font-bold mb-3">Chapters</h2>

    <table class="table-auto w-full border border-gray-700">
        <thead class="bg-gray-800 text-gray-200">
            <tr>
                <th class="px-4 py-2">Chapter</th>
                <th class="px-4 py-2">Title</th>
                <th class="px-4 py-2">Updated</th>
                <th class="px-4 py-2">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($chapters as $chapter)
                <tr class="border-t border-gray-700">
                    <td class="px-4 py-2">{{ $chapter->chapter_number }}</td>
                    <td class="px-4 py-2">{{ $chapter->title ?? '-' }}</td>
                    <td class="px-4 py-2">{{ $chapter->updated_at->diffForHumans() }}</td>
                    <td class="px-4 py-2">
                        <a href="{{ route('chapter.read', $chapter->id) }}" 
                           class="bg-blue-600 text-white px-3 py-1 rounded">
                           Open
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
