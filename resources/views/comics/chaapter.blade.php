@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto space-y-4">

    @foreach($chapterData['images'] as $img)
        <img src="{{ $img }}" class="w-full rounded shadow">
    @endforeach

</div>
@endsection
