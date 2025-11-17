@extends('layouts.app')

@section('content')
<section class="py-12 bg-[#0d1117] text-[#c9d1d9] min-h-screen">
    <div class="max-w-6xl mx-auto px-6">

        <h1 class="text-3xl font-bold text-white mb-8">Admin Dashboard (Simple)</h1>

        {{-- USERS TABLE --}}
        <div class="mb-12 bg-[#161b22] border border-[#30363d] rounded-xl p-6">
            <h2 class="text-xl font-semibold mb-4">Users</h2>

            <table class="min-w-full text-sm">
                <thead>
                    <tr class="text-left text-gray-400 border-b border-[#222834]">
                        <th class="px-3 py-2">#</th>
                        <th class="px-3 py-2">Name</th>
                        <th class="px-3 py-2">Email</th>
                        <th class="px-3 py-2">Level</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $u)
                        <tr class="border-b border-[#222834]">
                            <td class="px-3 py-2">{{ $loop->iteration }}</td>
                            <td class="px-3 py-2">{{ $u->name }}</td>
                            <td class="px-3 py-2">{{ $u->email }}</td>
                            <td class="px-3 py-2">{{ $u->level }}</td>
                        </tr>
                    @empty
                        <tr><td colspan="4" class="px-3 py-3 text-gray-500">No Users Found</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>


        {{-- MANGA TABLE --}}
        <div class="bg-[#161b22] border border-[#30363d] rounded-xl p-6">
            <h2 class="text-xl font-semibold mb-4">Mangas</h2>

            <table class="min-w-full text-sm">
                <thead>
                    <tr class="text-left text-gray-400 border-b border-[#222834]">
                        <th class="px-3 py-2">#</th>
                        <th class="px-3 py-2">Title</th>
                        <th class="px-3 py-2">Type</th>
                        <th class="px-3 py-2">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($mangas as $m)
                        <tr class="border-b border-[#222834]">
                            <td class="px-3 py-2">{{ $loop->iteration }}</td>
                            <td class="px-3 py-2">{{ $m->title }}</td>
                            <td class="px-3 py-2">{{ $m->type }}</td>
                            <td class="px-3 py-2">{{ $m->status }}</td>
                        </tr>
                    @empty
                        <tr><td colspan="4" class="px-3 py-3 text-gray-500">No Manga Found</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>
</section>
@endsection
