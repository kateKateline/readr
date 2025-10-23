@extends('layouts.main')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-50">
    <div class="bg-white p-8 rounded-2xl shadow-lg w-full max-w-md">
        <h1 class="text-2xl font-bold text-gray-800 mb-4">Dashboard Admin</h1>
        <p class="text-gray-600 mb-4">Selamat datang, {{ Auth::user()->username }}!</p>
<a href="{{ route('logout.get') }}" class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600">Logout</a>

    </div>
</div>
@endsection
