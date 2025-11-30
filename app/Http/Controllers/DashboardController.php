<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Comic;
use App\Models\Chapter;
use App\Models\Comment;
use App\Models\GlobalChat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class DashboardController extends Controller
{
    public function index()
    {
        // Statistik
        $stats = [
            'total_users' => User::count(),
            'total_comics' => Comic::count(),
            'total_chapters' => Chapter::count(),
            'total_comments' => Comment::count(),
            'total_global_chats' => GlobalChat::count(),
            'recent_users' => User::latest()->take(5)->get(),
            'recent_comics' => Comic::latest()->take(5)->get(),
            'recent_chapters' => Chapter::with('comic')->latest()->take(5)->get(),
        ];

        return view('dashboard.index', compact('stats'));
    }

    public function resetGlobalChat()
    {
        try {
            Artisan::call('globalchat:reset');
            $output = Artisan::output();
            
            return redirect()->route('dashboard')->with('success', 'Global chat berhasil direset! ' . trim($output));
        } catch (\Exception $e) {
            return redirect()->route('dashboard')->with('error', 'Gagal reset global chat: ' . $e->getMessage());
        }
    }
}

