<?php

namespace App\Services;

use App\Models\Comic;
use App\Models\Chapter;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ChapterService
{
    private string $base = "https://api.mangadex.org";

    public function syncChapters(string $mangaId, string $language = "en")
    {
        $limit = 50;
        $offset = 0;
        $total = 1;

        $comic = Comic::where('mangadex_id', $mangaId)->first();

        if (!$comic) {
            Log::error("Comic tidak ditemukan: $mangaId");
            return false;
        }

        while ($offset < $total) {

            $url = "{$this->base}/chapter?manga={$mangaId}&translatedLanguage[]={$language}"
                 . "&limit={$limit}&offset={$offset}&order[chapter]=asc";

            $response = Http::timeout(20)->get($url);

            if (!$response->successful()) {
                Log::warning("Gagal fetch chapters: " . $response->body());
                break;
            }

            $payload = $response->json();
            $total = $payload['total'] ?? 0;

            if (empty($payload['data'])) break;

            foreach ($payload['data'] as $c) {

                $chapterId = $c['id'];
                $attr      = $c['attributes'];

                $chapterTitle  = $attr['title'] ?? null;
                $chapterNumber = $attr['chapter'] ?? null;
                $chapterVolume = $attr['volume'] ?? null;

                /*
                |--------------------------------------------------------------------------
                | Fetch At-Home server (image data)
                |--------------------------------------------------------------------------
                */
                $atHome = Http::get("https://api.mangadex.org/at-home/server/{$chapterId}");

                if ($atHome->successful()) {
                    $img = $atHome->json();
                    $hash       = $img['chapter']['hash'] ?? null;
                    $dataImages = $img['chapter']['data'] ?? [];
                    $dataSaver  = $img['chapter']['dataSaver'] ?? [];
                } else {
                    $hash       = null;
                    $dataImages = [];
                    $dataSaver  = [];
                }

                /*
                |--------------------------------------------------------------------------
                | Save Chapter
                |--------------------------------------------------------------------------
                */
                Chapter::updateOrCreate(
                    ['mangadex_id' => $chapterId],
                    [
                        'comic_id'       => $comic->id,
                        'title'          => $chapterTitle,
                        'chapter_number' => $chapterNumber,
                        'volume'         => $chapterVolume,
                        'publish_at'     => $this->toMysqlDatetime($attr['publishAt'] ?? null),
                        'external_url'   => $attr['externalUrl'] ?? null,
                        'is_unavailable' => empty($dataImages), // jika tidak ada halaman
                        'md_updated_at'  => $this->toMysqlDatetime($attr['updatedAt'] ?? null),
                        'hash'           => $hash,
                        'data'           => $dataImages,
                        'data_saver'     => $dataSaver,
                        'pages'          => count($dataImages),
                    ]
                );

                usleep(250000); // 0.25 detik (aman rate limit)
            }

            $offset += $limit;
        }

        return true;
    }

    /**
     * Convert ISO8601 (MangaDex datetime) ke MySQL datetime
     */
    private function toMysqlDatetime(?string $date)
    {
        if (!$date) return null;

        return date('Y-m-d H:i:s', strtotime($date));
    }
}
