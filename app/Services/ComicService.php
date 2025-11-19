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

            // Ambil title paling masuk akal
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

            // Insert / Update database
            Comic::updateOrCreate(
                ['mangadex_id' => $item['id']],
                [
                    'title'       => $title,
                    'type'        => $attr['originalLanguage'] ?? 'unknown',
                    'image'       => $image,
                    'status'      => $attr['status'] ?? null,
                    'last_update' => isset($attr['updatedAt'])
                        ? Carbon::parse($attr['updatedAt'])
                        : null,
                ]
            );
        }

        return true;
    }
}
