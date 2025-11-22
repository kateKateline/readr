<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comic;
use App\Services\ComicService;

class ComicController extends Controller
{
    /**
     * Show a comic page with chapter list fetched from MangaDex.
     *
     * @param string $mangadex_id
     */
    public function show($mangadex_id, ComicService $comicService)
    {
        // Try to find the comic in local database, fallback to minimal placeholder
        $comic = Comic::where('mangadex_id', $mangadex_id)->first();

        if (!$comic) {
            // If not found locally, create a minimal placeholder (do not persist)
            $comic = (object)[
                'mangadex_id' => $mangadex_id,
                'title' => 'Unknown Title',
                'author' => null,
                'image' => null,
                'type' => null,
            ];
        }

        // Fetch chapters via ComicService (MangaDex)
        $chapters = $comicService->getChapters($mangadex_id, 200, 0);

        // Sort chapters by numeric chapter_num ascending if available
        usort($chapters, function ($a, $b) {
            $an = $a['chapter_num'] ?? null;
            $bn = $b['chapter_num'] ?? null;

            if ($an === null && $bn === null) {
                return 0;
            }
            if ($an === null) return 1;
            if ($bn === null) return -1;
            return $an <=> $bn;
        });

        return view('comics.show', compact('comic', 'chapters'));
    }

    /**
     * Show a reader view for a specific chapter id using MangaDex CDN pages.
     *
     * @param string $mangadex_id
     * @param string $chapterId
     */
    public function chapter($mangadex_id, $chapterId, ComicService $comicService)
    {
        $comic = Comic::where('mangadex_id', $mangadex_id)->first();

        if (!$comic) {
            $comic = (object)[
                'mangadex_id' => $mangadex_id,
                'title' => 'Unknown Title',
                'author' => null,
                'image' => null,
                'type' => null,
            ];
        }

        $pages = $comicService->getChapterPages($chapterId);

        // Return reader view even if pages empty so the view can show a friendly message
        return view('comics.reader', compact('comic', 'pages', 'chapterId'));
    }
}
