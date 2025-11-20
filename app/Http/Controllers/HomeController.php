<?php

namespace App\Http\Controllers;

use App\Models\Comic;
use App\Models\GlobalChat;

class HomeController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        // Ambil komik sesuai censorship
        $query = Comic::orderByDesc('last_update');

        if (!$user || ($user && $user->censorship_enabled)) {
            $query->where('is_sensitive', false);
        }

        $comics = $query->get();

        // Ambil semua global chat dengan relasi user
        $chats = GlobalChat::with('user')
                    ->orderBy('created_at', 'asc')
                    ->get();

        return view('home', compact('comics', 'chats'));
    }
}
