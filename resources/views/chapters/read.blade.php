@extends('layouts.app')

@section('content')
<div class="container mx-auto py-6">
    <h1 class="text-2xl font-bold mb-4">
        Chapter {{ $chapter->chapter_number }} — {{ $chapter->title }}
    </h1>

    <div class="space-y-4">
        @foreach ($images as $img)
            <img src="{{ $img }}" class="w-full rounded shadow" loading="lazy">
        @endforeach
    </div>
</div>
@endsection
