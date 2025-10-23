<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comic;

class ComicController extends Controller
{
    public function index(Request $request)
    {
        // Optional: ambil query params untuk filter / search
        $q = $request->query('q');
        $type = $request->query('type');
        $status = $request->query('status');
        $sort = $request->query('sort');
        $perPage = 12;

        // Section 1: Top Rank
        $topRank = Comic::whereNotNull('rank')
                        ->orderBy('rank', 'asc')
                        ->limit(10)
                        ->get();

        // Section 2: Top Rated
        $topRated = Comic::orderBy('rating', 'desc')
                        ->limit(10)
                        ->get();

        // Section 3: Latest
        $latest = Comic::orderBy('created_at', 'desc')->limit(12)->get();

        // Section 4: Manga Populer
        $mangaPopular = Comic::where('type', 'Manga')
                            ->orderBy('rating', 'desc')
                            ->limit(10)
                            ->get();

        // Section 5: Manhwa Populer
        $manhwaPopular = Comic::where('type', 'Manhwa')
                            ->orderBy('rating', 'desc')
                            ->limit(10)
                            ->get();

        // Section 6: Manhua Populer
        $manhuaPopular = Comic::where('type', 'Manhua')
                            ->orderBy('rating', 'desc')
                            ->limit(10)
                            ->get();

        // Main listing with filters
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
            $listing->orderByRaw('rank IS NULL, rank ASC');
        } elseif ($sort === 'rating') {
            $listing->orderBy('rating', 'desc');
        } elseif ($sort === 'chapters') {
            $listing->orderBy('chapters', 'desc');
        } else {
            $listing->orderBy('created_at', 'desc');
        }

        $comics = $listing->paginate($perPage)->withQueryString();

        return view('landing', compact(
            'topRank', 
            'topRated', 
            'latest', 
            'mangaPopular', 
            'manhwaPopular', 
            'manhuaPopular', 
            'comics'
        ));
    }
}