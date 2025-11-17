<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;

class HomeController extends Controller
{
    public function index()
    {
        $url = "https://api.mangadex.org/manga?limit=20&includes[]=cover_art&order[followedCount]=desc";

        $response = Http::get($url);

        if ($response->failed()) {
            abort(500, "Gagal mengambil data dari MangaDex API");
        }

        $raw = $response->json()['data'] ?? [];

        $manga = collect($raw)->map(function ($item) {

            // ambil attributes
            $attr = $item['attributes'];

            // ambil judul
            $title =
                $attr['title']['en']
                ?? $attr['title']['ja']
                ?? $attr['title']['jp']
                ?? 'No Title';

            // ambil type (Format)
            $type = $attr['originalLanguage'] ?? 'Unknown';

            // ambil cover
            $coverRel = collect($item['relationships'])
                ->firstWhere('type', 'cover_art');

            if ($coverRel) {
                $coverFile = $coverRel['attributes']['fileName'];
                $mangaId = $item['id'];

                $image = "https://uploads.mangadex.org/covers/{$mangaId}/{$coverFile}.256.jpg";
            } else {
                $image = asset('images/no-image.png');
            }

            return [
                'id'       => $item['id'],
                'title'    => $title,
                'type'     => $type,
                'image'    => $image,
                'endpoint' => $item['id'], // untuk route comic.show
            ];
        });

        return view('home', compact('manga'));
    }
}
