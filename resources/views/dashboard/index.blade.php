@extends('layouts.app')

@section('content')
<section class="py-16 bg-[#0d1117] text-[#c9d1d9] min-h-screen">
    <div class="max-w-6xl mx-auto px-6">
        <h1 class="text-3xl font-bold text-white mb-6">Admin Dashboard</h1>
        <div class="bg-[#161b22] border border-[#30363d] rounded-2xl p-6">
            <p class="text-lg">Selamat datang, <span class="font-semibold text-blue-500">{{ $user->name }}</span> 👋</p>
            <p class="mt-2 text-sm text-gray-400">Kamu login sebagai <strong>{{ $user->level }}</strong>.</p>

            <div class="mt-6 flex gap-4">
                <a href="/" class="text-sm text-white border border-[#30363d] px-4 py-2 rounded-lg hover:bg-blue-600 hover:border-blue-600 transition">Kembali ke Home</a>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="text-sm text-white border border-[#30363d] px-4 py-2 rounded-lg hover:bg-red-600 hover:border-red-600 transition">Logout</button>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
