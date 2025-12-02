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

        // Komik rekomendasi (random) dari tabel comics dengan filter censorship yang sama
        $recommendedQuery = Comic::query();
        if (!$user || ($user && $user->censorship_enabled)) {
            $recommendedQuery->where('is_sensitive', false);
        }
        $recommendedComics = $recommendedQuery
            ->inRandomOrder()
            ->limit(10)
            ->get();

        // Ambil semua global chat dengan relasi user
        $chats = GlobalChat::with('user')
                    ->orderBy('created_at', 'asc')
                    ->get();

        // ✅ GANTI: Gunakan service untuk top ranks
        $censorshipEnabled = !$user || ($user && $user->censorship_enabled);
        $topRanks = $comicService->getTopRankedComics(10, $censorshipEnabled);

        return view('home', compact('comics', 'chats', 'topRanks', 'recommendedComics'));
    }

    public function search(ComicService $comicService)
    {
        /** @var User|null $user */
        $user = Auth::user();

        $query = request()->get('q', '');
        
        // Base query
        $comicQuery = Comic::query();

        // Apply censorship filter
        if (!$user || ($user && $user->censorship_enabled)) {
            $comicQuery->where('is_sensitive', false);
        }

        // Search by title or author if query is provided
        if (!empty($query)) {
            $comicQuery->where(function($q) use ($query) {
                $q->where('title', 'LIKE', '%' . $query . '%')
                  ->orWhere('author', 'LIKE', '%' . $query . '%');
            });
        }

        // Order by last update
        $comics = $comicQuery->orderByDesc('last_update')->paginate(15)->withQueryString();

        // Komik rekomendasi (random) dari tabel comics dengan filter censorship yang sama
        $recommendedQuery = Comic::query();
        if (!$user || ($user && $user->censorship_enabled)) {
            $recommendedQuery->where('is_sensitive', false);
        }
        $recommendedComics = $recommendedQuery
            ->inRandomOrder()
            ->limit(10)
            ->get();

        // Get global chat
        $chats = GlobalChat::with('user')
                    ->orderBy('created_at', 'asc')
                    ->get();

        // Get top ranks
        $censorshipEnabled = !$user || ($user && $user->censorship_enabled);
        $topRanks = $comicService->getTopRankedComics(10, $censorshipEnabled);

        return view('home', compact('comics', 'chats', 'topRanks', 'query', 'recommendedComics'));
    }
}