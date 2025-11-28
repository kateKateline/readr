<?php

namespace App\Services;

use App\Models\Comic;
use App\Models\Chapter;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Client\RequestException;

class ChapterService
{
    private string $base = "https://api.mangadex.org";

    /**
     * Sync chapters untuk sebuah manga (mengambil juga translatedLanguage per chapter)
     *
     * @param string $mangaId Mangadex manga id
     * @param string $language kode bahasa yang ingin diambil (default "en")
     * @return bool
     */
    public function syncChapters(string $mangaId, string $language = "en"): bool
    {
        $limit = 50;
        $offset = 0;
        $total = 1;

        $comic = Comic::where('mangadex_id', $mangaId)->first();

        if (!$comic) {
            Log::error("Comic tidak ditemukan: {$mangaId}");
            return false;
        }

        while ($offset < $total) {
            $url = "{$this->base}/chapter?manga={$mangaId}&translatedLanguage[]={$language}"
                 . "&limit={$limit}&offset={$offset}&order[chapter]=asc";

            try {
                // retry 2x on transient failures, 10s timeout
                $response = Http::retry(2, 1000)->timeout(10)->get($url);
            } catch (RequestException $e) {
                Log::warning("Gagal fetch chapters (exception): " . $e->getMessage());
                break;
            }

            if (!$response->successful()) {
                Log::warning("Gagal fetch chapters: HTTP {$response->status()} - " . $response->body());
                break;
            }

            $payload = $response->json();
            $total = $payload['total'] ?? 0;

            if (empty($payload['data'])) {
                // tidak ada data pada response
                break;
            }

            foreach ($payload['data'] as $c) {
                $chapterId = $c['id'] ?? null;
                $attr      = $c['attributes'] ?? [];

                if (!$chapterId) {
                    // skip jika data buruk
                    continue;
                }

                $chapterTitle  = $attr['title'] ?? null;
                $chapterNumber = $attr['chapter'] ?? null;
                $chapterVolume = $attr['volume'] ?? null;
                $translatedLanguage = $attr['translatedLanguage'] ?? null;

                /*
                |------------------------------------------------------------------
                | Fetch At-Home server (image data)
                |------------------------------------------------------------------
                */
                try {
                    $atHome = Http::timeout(10)->get("https://api.mangadex.org/at-home/server/{$chapterId}");
                } catch (RequestException $e) {
                    Log::warning("Gagal fetch at-home untuk chapter {$chapterId}: " . $e->getMessage());
                    $atHome = null;
                }

                if ($atHome && $atHome->successful()) {
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
                |------------------------------------------------------------------
                | Save Chapter
                |------------------------------------------------------------------
                */
                try {
                    Chapter::updateOrCreate(
                        ['mangadex_id' => $chapterId],
                        [
                            'comic_id'            => $comic->id,
                            'title'               => $chapterTitle,
                            'chapter_number'      => $chapterNumber,
                            'volume'              => $chapterVolume,
                            'publish_at'          => $this->toMysqlDatetime($attr['publishAt'] ?? null),
                            'translated_language' => $translatedLanguage, // disimpan di sini
                            'external_url'        => $attr['externalUrl'] ?? null,
                            'is_unavailable'      => empty($dataImages),
                            'md_updated_at'       => $this->toMysqlDatetime($attr['updatedAt'] ?? null),
                            'hash'                => $hash,
                            'data'                => $dataImages,
                            'data_saver'          => $dataSaver,
                            'pages'               => count($dataImages),
                        ]
                    );
                } catch (\Throwable $e) {
                    Log::error("Gagal simpan chapter {$chapterId}: " . $e->getMessage());
                    // lanjutkan ke chapter selanjutnya
                }

                // jeda kecil untuk mengurangi kemungkinan kena rate limit
                usleep(250000); // 0.25s
            }

            $offset += $limit;
        }

        return true;
    }

    /**
     * Convert ISO8601 (MangaDex datetime) ke MySQL datetime
     */
    private function toMysqlDatetime(?string $date): ?string
    {
        if (!$date) return null;

        return date('Y-m-d H:i:s', strtotime($date));
    }
}
