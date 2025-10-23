<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comic;
use Illuminate\Support\Facades\Cache;

class ComicController extends Controller
{
    public function index(Request $request)
    {
        // Optional: ambil query params untuk filter / search
        $q = $request->query('q');
        $type = $request->query('type');    // Manga, Manhwa, dll
        $status = $request->query('status'); // ongoing, completed
        $sort = $request->query('sort');    // e.g. 'rank', 'rating', 'latest'
        $perPage = 12;

        // Section 1: Top Rank (descending)
        $topRank = Cache::remember('comics_top_rank', 60, function () {
            return Comic::whereNotNull('rank')->orderBy('rank', 'asc') // rank 1 is highest
                        ->limit(10)->get();
        });

        // Section 2: Top Rated
        $topRated = Cache::remember('comics_top_rated', 60, function () {
            return Comic::orderBy('rating', 'desc')
                        ->limit(10)->get();
        });

        // Section 3: Latest (by created_at)
        $latest = Comic::orderBy('created_at', 'desc')->limit(12)->get();

        // Section 4: Popular by chapters or rating (example)
        $popular = Comic::orderBy('chapters', 'desc')->limit(12)->get();

        // Main listing with filters / search / sort (paginated)
        $listing = Comic::query();

        if ($q) {
            $listing->where(function($sub) use ($q) {
                $sub->where('title', 'like', "%{$q}%")
                    ->orWhere('author', 'like', "%{$q}%")
                    ->orWhere('synopsis', 'like', "%{$q}%");
            });
        }

        if ($type) {
            $listing->where('type', $type);
        }

        if ($status) {
            $listing->where('status', $status);
        }

        if ($sort === 'rank') {
            $listing->orderByRaw('rank IS NULL, rank ASC'); // rank null di akhir
        } elseif ($sort === 'rating') {
            $listing->orderBy('rating', 'desc');
        } elseif ($sort === 'chapters') {
            $listing->orderBy('chapters', 'desc');
        } else {
            $listing->orderBy('created_at', 'desc'); // default latest
        }

        $comics = $listing->paginate($perPage)->withQueryString();

        return view('landing', compact('topRank', 'topRated', 'latest', 'popular', 'comics'));
    }
}
