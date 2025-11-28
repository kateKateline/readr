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
     */
    public function syncChapters(string $mangaId, ?string $language = null): array
    {
        $limit = 50;
        $offset = 0;
        $total = 1;
        $syncedCount = 0;
        $failedCount = 0;

        $comic = Comic::where('mangadex_id', $mangaId)->first();

        if (!$comic) {
            Log::error("Comic tidak ditemukan: {$mangaId}");
            return ['success' => false, 'synced' => 0, 'failed' => 0];
        }

        while ($offset < $total) {

            // Jika language di-set, filter berdasarkan language, jika tidak ambil semua
            $url = "{$this->base}/chapter?manga={$mangaId}";
            
            if ($language) {
                $url .= "&translatedLanguage[]={$language}";
            }
            
            $url .= "&limit={$limit}&offset={$offset}&order[chapter]=asc";

            try {
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
                break;
            }

            foreach ($payload['data'] as $c) {

                $chapterId = $c['id'] ?? null;
                $attr = $c['attributes'] ?? [];

                if (!$chapterId) continue;

                /*
                |--------------------------------------------------------------------------
                | NORMALISASI CHAPTER NUMBER
                |--------------------------------------------------------------------------
                */
                $chapterNumber = $attr['chapter'] ?? null;

                if ($chapterNumber !== null) {
                    // Hilangkan trailing zero → "1.0" jadi "1", "5.50" jadi "5.5"
                    // Tapi tetap pertahankan nilai aslinya termasuk "0"
                    $chapterNumber = rtrim(rtrim($chapterNumber, '0'), '.');
                    
                    // Jika setelah rtrim jadi string kosong, kembalikan ke "0"
                    if ($chapterNumber === '') {
                        $chapterNumber = "0";
                    }
                }

                /*
                |--------------------------------------------------------------------------
                | FIX TITLE - Ambil dari bahasa apapun yang tersedia
                |--------------------------------------------------------------------------
                */
                $chapterTitle = $attr['title'] ?? null;

                // Jika title adalah string dan tidak kosong, gunakan apa adanya
                if (is_string($chapterTitle) && trim($chapterTitle) !== "" && mb_strlen(trim($chapterTitle)) > 0) {
                    $chapterTitle = trim($chapterTitle);
                } 
                // Jika title adalah array/object (multi-language), ambil dari bahasa manapun
                elseif (is_array($chapterTitle) || is_object($chapterTitle)) {
                    $titles = (array) $chapterTitle;
                    $chapterTitle = $titles['en'] 
                        ?? $titles['ja-ro']
                        ?? $titles['ja'] 
                        ?? $titles['id']
                        ?? $titles['zh']
                        ?? $titles['zh-hk']
                        ?? $titles['ko']
                        ?? (!empty($titles) ? reset($titles) : null);
                    
                    // Jika masih null atau kosong setelah ambil dari array
                    if (!$chapterTitle || trim($chapterTitle) === "") {
                        $chNum = $chapterNumber ?? "Unknown";
                        $chapterTitle = "Chapter " . $chNum;
                    } else {
                        $chapterTitle = trim($chapterTitle);
                    }
                } 
                // Jika benar-benar null atau kosong, gunakan default
                else {
                    $chNum = $chapterNumber ?? "Unknown";
                    $chapterTitle = "Chapter " . $chNum;
                }

                $chapterVolume = $attr['volume'] ?? null;
                $translatedLanguage = $attr['translatedLanguage'] ?? null;

                /*
                |--------------------------------------------------------------------------
                | Fetch At-Home server (image data)
                |--------------------------------------------------------------------------
                */
                try {
                    $atHome = Http::timeout(10)->get("https://api.mangadex.org/at-home/server/{$chapterId}");
                } catch (RequestException $e) {
                    Log::warning("Gagal fetch at-home untuk chapter {$chapterId}: " . $e->getMessage());
                    $atHome = null;
                }

                if ($atHome && $atHome->successful()) {
                    $img = $atHome->json();

                    $hash = $img['chapter']['hash'] ?? null;
                    $dataImages = $img['chapter']['data'] ?? [];
                    $dataSaver = $img['chapter']['dataSaver'] ?? [];

                } else {
                    $hash = null;
                    $dataImages = [];
                    $dataSaver = [];
                }

                /*
                |--------------------------------------------------------------------------
                | Save Chapter - Hanya pakai publish_at
                |--------------------------------------------------------------------------
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
                            'translated_language' => $translatedLanguage,
                            'external_url'        => $attr['externalUrl'] ?? null,
                            'is_unavailable'      => empty($dataImages),
                            'hash'                => $hash,
                            'data'                => $dataImages,
                            'data_saver'          => $dataSaver,
                            'pages'               => count($dataImages),
                        ]
                    );
                    
                    $syncedCount++;
                } catch (\Throwable $e) {
                    Log::error("Gagal simpan chapter {$chapterId}: " . $e->getMessage());
                    $failedCount++;
                }

                // Jeda untuk menghindari rate limit
                usleep(250000);
            }

            $offset += $limit;
        }

        return [
            'success' => true,
            'synced' => $syncedCount,
            'failed' => $failedCount,
            'total' => $syncedCount + $failedCount
        ];
    }

    /**
     * Convert ISO8601 ke MySQL datetime
     */
    private function toMysqlDatetime(?string $date): ?string
    {
        if (!$date) return null;
        return date('Y-m-d H:i:s', strtotime($date));
    }
}