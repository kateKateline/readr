@extends('layouts.dashboard')

@section('page-title', 'Dashboard')

@section('content')
<div class="space-y-6">
    <!-- Statistik Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-4">
        <!-- Total Users -->
        <div class="bg-[#161b22] border border-[#21262d] rounded-lg p-6 hover:border-blue-500/50 transition-colors">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-400 text-sm mb-1">Total Users</p>
                    <p class="text-2xl font-bold text-white">{{ number_format($stats['total_users']) }}</p>
                </div>
                <div class="bg-blue-500/10 p-3 rounded-lg">
                    <svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                </div>
            </div>
        </div>

        <!-- Total Comics -->
        <div class="bg-[#161b22] border border-[#21262d] rounded-lg p-6 hover:border-blue-500/50 transition-colors">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-400 text-sm mb-1">Total Comics</p>
                    <p class="text-2xl font-bold text-white">{{ number_format($stats['total_comics']) }}</p>
                </div>
                <div class="bg-green-500/10 p-3 rounded-lg">
                    <svg class="w-6 h-6 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                    </svg>
                </div>
            </div>
        </div>

        <!-- Total Chapters -->
        <div class="bg-[#161b22] border border-[#21262d] rounded-lg p-6 hover:border-blue-500/50 transition-colors">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-400 text-sm mb-1">Total Chapters</p>
                    <p class="text-2xl font-bold text-white">{{ number_format($stats['total_chapters']) }}</p>
                </div>
                <div class="bg-purple-500/10 p-3 rounded-lg">
                    <svg class="w-6 h-6 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                </div>
            </div>
        </div>

        <!-- Total Comments -->
        <div class="bg-[#161b22] border border-[#21262d] rounded-lg p-6 hover:border-blue-500/50 transition-colors">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-400 text-sm mb-1">Total Comments</p>
                    <p class="text-2xl font-bold text-white">{{ number_format($stats['total_comments']) }}</p>
                </div>
                <div class="bg-yellow-500/10 p-3 rounded-lg">
                    <svg class="w-6 h-6 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                    </svg>
                </div>
            </div>
        </div>

        <!-- Total Global Chats -->
        <div class="bg-[#161b22] border border-[#21262d] rounded-lg p-6 hover:border-blue-500/50 transition-colors">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-400 text-sm mb-1">Global Chats</p>
                    <p class="text-2xl font-bold text-white">{{ number_format($stats['total_global_chats']) }}</p>
                </div>
                <div class="bg-red-500/10 p-3 rounded-lg">
                    <svg class="w-6 h-6 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Reset Global Chat Button -->
    <div class="bg-[#161b22] border border-[#21262d] rounded-lg p-6">
        <div class="flex items-center justify-between">
            <div>
                <h3 class="text-lg font-semibold text-white mb-1">Global Chat Management</h3>
                <p class="text-gray-400 text-sm">Reset global chat yang lebih dari 3 hari</p>
            </div>
            <form action="{{ route('dashboard.reset-global-chat') }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin mereset global chat?')">
                @csrf
                <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-6 py-2 rounded-lg transition-colors flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                    </svg>
                    Reset Global Chat
                </button>
            </form>
        </div>
    </div>

    <!-- Charts Section -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Bar Chart -->
        <div class="bg-[#161b22] border border-[#21262d] rounded-lg p-6">
            <h3 class="text-lg font-semibold text-white mb-4">Statistics Overview</h3>
            <canvas id="statisticsChart" class="max-h-80"></canvas>
        </div>

        <!-- Doughnut Chart -->
        <div class="bg-[#161b22] border border-[#21262d] rounded-lg p-6">
            <h3 class="text-lg font-semibold text-white mb-4">Data Distribution</h3>
            <canvas id="distributionChart" class="max-h-80"></canvas>
        </div>
    </div>

    <!-- Recent Data Tables -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Recent Users -->
        <div class="bg-[#161b22] border border-[#21262d] rounded-lg p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold text-white">Recent Users</h3>
                <a href="{{ route('dashboard.users.index') }}" class="text-blue-500 hover:text-blue-400 text-sm">View All</a>
            </div>
            <div class="space-y-3">
                @forelse($stats['recent_users'] as $user)
                    <div class="flex items-center gap-3 p-3 bg-[#0d1117] rounded-lg">
                        <div class="w-10 h-10 rounded-full bg-blue-500 text-white flex items-center justify-center font-bold text-sm">
                            {{ strtoupper(substr($user->name, 0, 1)) }}
                        </div>
                        <div class="flex-1">
                            <p class="text-white font-medium">{{ $user->name }}</p>
                            <p class="text-gray-400 text-xs">{{ $user->email }}</p>
                        </div>
                        <span class="px-2 py-1 text-xs rounded {{ $user->level === 'admin' ? 'bg-red-500/20 text-red-400' : 'bg-blue-500/20 text-blue-400' }}">
                            {{ ucfirst($user->level) }}
                        </span>
                    </div>
                @empty
                    <p class="text-gray-400 text-center py-4">No users yet</p>
                @endforelse
            </div>
        </div>

        <!-- Recent Comics -->
        <div class="bg-[#161b22] border border-[#21262d] rounded-lg p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold text-white">Recent Comics</h3>
                <a href="{{ route('dashboard.comics.index') }}" class="text-blue-500 hover:text-blue-400 text-sm">View All</a>
            </div>
            <div class="space-y-3">
                @forelse($stats['recent_comics'] as $comic)
                    <div class="p-3 bg-[#0d1117] rounded-lg">
                        <p class="text-white font-medium mb-1">{{ Str::limit($comic->title, 40) }}</p>
                        <div class="flex items-center gap-2 text-xs text-gray-400">
                            <span>{{ $comic->author ?? 'Unknown' }}</span>
                            @if($comic->status)
                                <span class="px-2 py-0.5 rounded bg-gray-700">{{ $comic->status }}</span>
                            @endif
                        </div>
                    </div>
                @empty
                    <p class="text-gray-400 text-center py-4">No comics yet</p>
                @endforelse
            </div>
        </div>

        <!-- Recent Chapters -->
        <div class="bg-[#161b22] border border-[#21262d] rounded-lg p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold text-white">Recent Chapters</h3>
                <a href="{{ route('dashboard.chapters.index') }}" class="text-blue-500 hover:text-blue-400 text-sm">View All</a>
            </div>
            <div class="space-y-3">
                @forelse($stats['recent_chapters'] as $chapter)
                    <div class="p-3 bg-[#0d1117] rounded-lg">
                        <p class="text-white font-medium mb-1">
                            Ch. {{ $chapter->chapter_number }} - {{ Str::limit($chapter->title ?? 'Untitled', 30) }}
                        </p>
                        <p class="text-gray-400 text-xs">{{ $chapter->comic->title ?? 'Unknown Comic' }}</p>
                    </div>
                @empty
                    <p class="text-gray-400 text-center py-4">No chapters yet</p>
                @endforelse
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Stats data dari backend - gunakan json_encode untuk clean parsing
    const statsData = {
        users: {{ $stats['total_users'] ?? 0 }},
        comics: {{ $stats['total_comics'] ?? 0 }},
        chapters: {{ $stats['total_chapters'] ?? 0 }},
        comments: {{ $stats['total_comments'] ?? 0 }},
        globalChats: {{ $stats['total_global_chats'] ?? 0 }}
    };

    // Chart config
    const chartColors = {
        blue: { bg: 'rgba(59, 130, 246, 0.8)', border: 'rgba(59, 130, 246, 1)' },
        green: { bg: 'rgba(34, 197, 94, 0.8)', border: 'rgba(34, 197, 94, 1)' },
        purple: { bg: 'rgba(168, 85, 247, 0.8)', border: 'rgba(168, 85, 247, 1)' },
        yellow: { bg: 'rgba(234, 179, 8, 0.8)', border: 'rgba(234, 179, 8, 1)' },
        red: { bg: 'rgba(239, 68, 68, 0.8)', border: 'rgba(239, 68, 68, 1)' }
    };

    const labels = ['Users', 'Comics', 'Chapters', 'Comments', 'Global Chats'];
    const dataValues = [
        statsData.users,
        statsData.comics,
        statsData.chapters,
        statsData.comments,
        statsData.globalChats
    ];
    const bgColors = Object.values(chartColors).map(c => c.bg);
    const borderColors = Object.values(chartColors).map(c => c.border);

    // Common chart options
    const commonOptions = {
        responsive: true,
        maintainAspectRatio: true,
        plugins: {
            tooltip: {
                backgroundColor: 'rgba(22, 27, 34, 0.95)',
                titleColor: '#c9d1d9',
                bodyColor: '#c9d1d9',
                borderColor: '#21262d',
                borderWidth: 1,
                padding: 12
            }
        }
    };

    // Bar Chart
    const statsCtx = document.getElementById('statisticsChart');
    if (statsCtx) {
        new Chart(statsCtx, {
            type: 'bar',
            data: {
                labels,
                datasets: [{
                    label: 'Total Count',
                    data: dataValues,
                    backgroundColor: bgColors,
                    borderColor: borderColors,
                    borderWidth: 2,
                    borderRadius: 8
                }]
            },
            options: {
                ...commonOptions,
                plugins: {
                    ...commonOptions.plugins,
                    legend: { display: false }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: { color: '#8b949e', font: { size: 12 } },
                        grid: { color: '#21262d' }
                    },
                    x: {
                        ticks: { color: '#8b949e', font: { size: 12 } },
                        grid: { display: false }
                    }
                }
            }
        });
    }

    // Doughnut Chart
    const distCtx = document.getElementById('distributionChart');
    if (distCtx) {
        new Chart(distCtx, {
            type: 'doughnut',
            data: {
                labels,
                datasets: [{
                    data: dataValues,
                    backgroundColor: bgColors,
                    borderColor: borderColors,
                    borderWidth: 2
                }]
            },
            options: {
                ...commonOptions,
                plugins: {
                    ...commonOptions.plugins,
                    legend: {
                        position: 'bottom',
                        labels: { color: '#c9d1d9', padding: 15, font: { size: 12 } }
                    },
                    tooltip: {
                        ...commonOptions.plugins.tooltip,
                        callbacks: {
                            label: ctx => {
                                const total = ctx.dataset.data.reduce((a, b) => a + b, 0);
                                const pct = ((ctx.parsed / total) * 100).toFixed(1);
                                return `${ctx.label}: ${ctx.parsed} (${pct}%)`;
                            }
                        }
                    }
                }
            }
        });
    }
</script>
@endpush
@endsection