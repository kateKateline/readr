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

            {{-- Flash messages --}}
            @if(session('success'))
                <div class="mt-4 p-3 bg-green-600 text-white rounded">{{ session('success') }}</div>
            @endif

            {{-- Tabs --}}
            <div class="mt-6">
                <div class="flex gap-2">
                    <button id="tab-users" class="tab-btn px-4 py-2 rounded-lg bg-[#0b1220] border border-[#263142] text-sm">Users</button>
                    <button id="tab-comics" class="tab-btn px-4 py-2 rounded-lg bg-[#0b1220] border border-[#263142] text-sm">Comics</button>
                </div>

                <div id="panel-users" class="mt-4">
                    <h2 class="text-xl font-semibold mb-3">Users</h2>
                    <div class="overflow-x-auto bg-[#0b1116] p-4 rounded">
                        <table class="min-w-full text-sm">
                            <thead>
                                <tr class="text-left text-gray-400">
                                    <th class="px-3 py-2">#</th>
                                    <th class="px-3 py-2">Name</th>
                                    <th class="px-3 py-2">Email</th>
                                    <th class="px-3 py-2">Level</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $u)
                                    <tr class="border-t border-[#222834]">
                                        <td class="px-3 py-2">{{ $loop->iteration }}</td>
                                        <td class="px-3 py-2">{{ $u->name }}</td>
                                        <td class="px-3 py-2">{{ $u->email }}</td>
                                        <td class="px-3 py-2">{{ $u->level }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div id="panel-comics" class="mt-4 hidden">
                    <div class="flex items-center justify-between">
                        <h2 class="text-xl font-semibold mb-3">Comics</h2>
                        <div class="flex gap-2">
                            <a href="{{ route('dashboard.comics.create') }}" class="text-sm text-white bg-blue-600 px-4 py-2 rounded-lg">Tambah Comic</a>
                        </div>
                    </div>

                    <div class="overflow-x-auto bg-[#0b1116] p-4 rounded">
                        <table class="min-w-full text-sm">
                            <thead>
                                <tr class="text-left text-gray-400">
                                    <th class="px-3 py-2">#</th>
                                    <th class="px-3 py-2">Title</th>
                                    <th class="px-3 py-2">Author</th>
                                    <th class="px-3 py-2">Type</th>
                                    <th class="px-3 py-2">Status</th>
                                    <th class="px-3 py-2">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($comics as $c)
                                    <tr class="border-t border-[#222834]">
                                        <td class="px-3 py-2">{{ $loop->iteration }}</td>
                                        <td class="px-3 py-2">{{ $c->title }}</td>
                                        <td class="px-3 py-2">{{ $c->author }}</td>
                                        <td class="px-3 py-2">{{ $c->type }}</td>
                                        <td class="px-3 py-2">{{ $c->status }}</td>
                                        <td class="px-3 py-2">
                                            <a href="{{ route('dashboard.comics.edit', $c->id) }}" class="text-sm text-yellow-400 mr-2">Edit</a>
                                            <form action="{{ route('dashboard.comics.destroy', $c->id) }}" method="POST" style="display:inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-sm text-red-500" onclick="return confirm('Hapus comic ini?')">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const btnUsers = document.getElementById('tab-users');
        const btnComics = document.getElementById('tab-comics');
        const panelUsers = document.getElementById('panel-users');
        const panelComics = document.getElementById('panel-comics');

        function showUsers() {
            panelUsers.classList.remove('hidden');
            panelComics.classList.add('hidden');
        }

        function showComics() {
            panelUsers.classList.add('hidden');
            panelComics.classList.remove('hidden');
        }

        btnUsers.addEventListener('click', showUsers);
        btnComics.addEventListener('click', showComics);
    });
</script>
@endpush
