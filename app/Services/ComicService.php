<?php

namespace App\Services;

use App\Models\Comic;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;

class ComicService
{
    private $base = "https://api.mangadex.org";

    public function fetchPopular($limit = 20)
    {
        $url = "{$this->base}/manga?limit={$limit}&includes[]=cover_art&order[followedCount]=desc";

        $res = Http::get($url);

        if ($res->failed() || empty($res->json('data'))) {
            return [];
        }

        return $res->json('data');
    }

    public function sync($limit = 20)
    {
        $data = $this->fetchPopular($limit);

foreach ($data as $item) {

    $attr = $item['attributes'];

    // Ambil title
    $title = $attr['title']['en']
        ?? $attr['title']['ja']
        ?? $attr['title']['jp']
        ?? "No Title";

    // Ambil cover
    $cover = collect($item['relationships'])
        ->firstWhere('type', 'cover_art');

    $image = $cover
        ? "https://uploads.mangadex.org/covers/{$item['id']}/{$cover['attributes']['fileName']}.256.jpg"
        : null;

    // 🔥 Ambil chapter terbaru
    $chapterInfo = $this->fetchLastChapter($item['id']) ?? [];



            Comic::updateOrCreate(
                ['mangadex_id' => $item['id']],
                [
                    'title'        => $title,
                    'type'         => $attr['originalLanguage'] ?? 'unknown',
                    'image'        => $image,
                    'status'       => $attr['status'] ?? null,
                
                    // ⬇️ gunakan updatedAt chapter TERBARU (bukan manga)
                    'last_update'  => isset($chapterInfo['updated'])
                                        ? Carbon::parse($chapterInfo['updated'])
                                        : null,
                
                    'last_chapter' => $chapterInfo['chapter'] ?? null,
                ]
            );

        }

        return true;
    }

    private function fetchLastChapter($mangaId)
    {
        $url = "{$this->base}/chapter?manga={$mangaId}&limit=1&translatedLanguage[]=en&order[readableAt]=desc";

        $res = Http::get($url);

        if ($res->failed() || empty($res->json('data'))) {
            return null;
        }

        $chapter = $res->json('data')[0];

        return [
            'chapter' => $chapter['attributes']['chapter'] ?? null,
            'updated' => $chapter['attributes']['readableAt']
                ?? $chapter['attributes']['updatedAt']
                ?? null,
        ];
    }
}
