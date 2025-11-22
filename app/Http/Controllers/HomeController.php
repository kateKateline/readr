<?php

namespace App\Http\Controllers;

use App\Models\Comic;
use App\Models\GlobalChat;
use App\Models\User;
use App\Services\ComicService;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index(ComicService $comicService)
    {
        /** @var User|null $user */
        $user = Auth::user();

        // Ambil komik sesuai censorship dan paginate (15 per page)
        $query = Comic::orderByDesc('last_update');

        if (!$user || ($user && $user->censorship_enabled)) {
            $query->where('is_sensitive', false);
        }

        // Gunakan paginate agar mudah menavigasi banyak data
        $comics = $query->paginate(15)->withQueryString();

        // Ambil semua global chat dengan relasi user
        $chats = GlobalChat::with('user')
                    ->orderBy('created_at', 'asc')
                    ->get();

        // ✅ GANTI: Gunakan service untuk top ranks
        $censorshipEnabled = !$user || ($user && $user->censorship_enabled);
        $topRanks = $comicService->getTopRankedComics(10, $censorshipEnabled);

        return view('home', compact('comics', 'chats', 'topRanks'));
    }
}