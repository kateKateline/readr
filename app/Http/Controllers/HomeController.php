<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class HomeController extends Controller
{
    public function index()
    {
        $url = "https://api.mangadex.org/manga?limit=20&includes[]=cover_art&order[followedCount]=desc";

        // 🔥 Cache data 6 jam supaya tidak hit API terus
        $raw = Cache::remember('mangadex_home', now()->addHours(6), function () use ($url) {
            $response = Http::get($url);

            if ($response->failed()) {
                return []; // jangan crash
            }

            return $response->json()['data'] ?? [];
        });

        $manga = collect($raw)->map(function ($item) {

            $attr = $item['attributes'];

            $title =
                $attr['title']['en']
                ?? $attr['title']['ja']
                ?? $attr['title']['jp']
                ?? 'No Title';

            $type = $attr['originalLanguage'] ?? 'Unknown';

            // cover relationship
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
                'endpoint' => $item['id'],
            ];
        });

        return view('home', compact('manga'));
    }
}
