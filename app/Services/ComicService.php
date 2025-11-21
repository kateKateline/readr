<?php 
 
namespace App\Services; 
 
use App\Models\Comic; 
use Illuminate\Support\Facades\Http; 
use Carbon\Carbon; 
use Illuminate\Support\Facades\Log;
 
class ComicService 
{ 
    private $base = "https://api.mangadex.org"; 
    //Base URL Mangadex API
    public function fetchPopular($limit = 20) 
    { 
        $url = "{$this->base}/manga?limit={$limit}&includes[]=cover_art&includes[]=author&order[followedCount]=desc"; 
 
        $res = Http::get($url); 
 
        if ($res->failed() || empty($res->json('data'))) { 
            return []; 
        } 
 
        return $res->json('data'); 
    }

    /**
     * Build a comma-separated author string from an API item and an authors map.
     * This consolidates duplicated logic used during sync operations.
     *
     * @param array $item
     * @param array $authorsMap
     * @return string
     */
    private function getAuthorNames(array $item, array $authorsMap): string
    {
        $authorNames = collect($item['relationships'] ?? [])
            ->filter(fn($rel) => ($rel['type'] ?? '') === 'author')
            ->map(function ($rel) use ($authorsMap) {
                if (isset($rel['id']) && isset($authorsMap[$rel['id']])) {
                    return $authorsMap[$rel['id']];
                }
                if (isset($rel['attributes']['name'])) {
                    return $rel['attributes']['name'];
                }
                return null;
            })
            ->filter()
            ->values();

        $authorName = $authorNames->isEmpty() ? 'Unknown Author' : $authorNames->join(', ');
        return mb_substr($authorName, 0, 200);
    }

    /**
     * Fetch top ranked manga berdasarkan rating
     * 
     * @param int $limit
     * @return \Illuminate\Support\Collection
     */
    public function getTopRankedComics($limit = 10, $censorshipEnabled = false)
    {
        // Ambil manga dengan rating tertinggi yang sudah ada di database
        $query = Comic::query()
            ->whereNotNull('rating')
            ->where('rating', '>', 0);

        // Filter berdasarkan censorship
        if ($censorshipEnabled) {
            $query->where('is_sensitive', false);
        }

        $topComics = $query
            ->orderByDesc('rating')
            ->orderByDesc('rating_count')
            ->take($limit)
            ->get();

        // Jika kurang dari limit, fetch dari API
        if ($topComics->count() < $limit) {
            $this->syncTopRated($limit);
            
            // Query lagi setelah sync
            $topComics = Comic::query()
                ->whereNotNull('rating')
                ->where('rating', '>', 0)
                ->when($censorshipEnabled, function($q) {
                    $q->where('is_sensitive', false);
                })
                ->orderByDesc('rating')
                ->orderByDesc('rating_count')
                ->take($limit)
                ->get();
        }

        return $topComics;
    }

    /**
     * Sync top rated manga dari MangaDex
     * 
     * @param int $limit
     * @return void
     */
    public function syncTopRated($limit = 20)
    {
        // Fetch manga dengan rating tertinggi dari MangaDex
        $url = "{$this->base}/manga?limit={$limit}&includes[]=cover_art&includes[]=author&order[rating]=desc&contentRating[]=safe&contentRating[]=suggestive&contentRating[]=erotica";

        $res = Http::get($url);

        if ($res->failed() || empty($res->json('data'))) {
            Log::warning("Failed to fetch top rated manga from MangaDex");
            return;
        }

        $data = $res->json('data');
        $authorsMap = $this->getAuthorsMap($data);

        // Fetch statistics untuk semua manga sekaligus
        $mangaIds = collect($data)->pluck('id')->toArray();
        $statistics = $this->fetchBatchStatistics($mangaIds);

        foreach ($data as $item) {
            $attr = $item['attributes'];
            $mangaId = $item['id'];

            // Ambil title
            $titles = $attr['title'] ?? [];
            $title = $titles['en'] 
                ?? $titles['ja-ro']
                ?? $titles['ja'] 
                ?? $titles['jp']
                ?? (!empty($titles) ? reset($titles) : "No Title");

            // Ambil cover
            $cover = collect($item['relationships'])
                ->firstWhere('type', 'cover_art');

            $image = $cover 
                ? "https://uploads.mangadex.org/covers/{$mangaId}/{$cover['attributes']['fileName']}.256.jpg" 
                : null;

            // Get author string (comma-separated) using shared helper
            $authorName = $this->getAuthorNames($item, $authorsMap);

            // Ambil chapter info
            $chapterInfo = $this->fetchLastChapter($mangaId) ?? [];

            // Ambil rating dari statistics
            $stat = $statistics[$mangaId] ?? null;
            $rating = null;
            $ratingCount = null;

            if ($stat) {
                // Gunakan Bayesian rating (lebih akurat)
                $rating = $stat['rating']['bayesian'] ?? $stat['rating']['average'] ?? null;
                $ratingCount = isset($stat['rating']['distribution']) 
                    ? array_sum($stat['rating']['distribution']) 
                    : 0;
            }

            try {
                Comic::updateOrCreate(
                    ['mangadex_id' => $mangaId],
                    [
                        'title'        => $title,
                        'type'         => $attr['originalLanguage'] ?? 'unknown',
                        'image'        => $image,
                        'status'       => $attr['status'] ?? null,
                        'author'       => $authorName,
                        'is_sensitive' => $this->isSensitive($item),
                        'last_update'  => isset($chapterInfo['updated']) 
                                            ? Carbon::parse($chapterInfo['updated']) 
                                            : null,
                        'last_chapter' => $chapterInfo['chapter'] ?? null,
                        'rating'       => $rating,
                        'rating_count' => $ratingCount,
                    ]
                );

                Log::info("✅ Synced (Top Rated): {$title} | Rating: " . ($rating ? number_format($rating, 2) : 'N/A'));

            } catch (\Exception $e) {
                Log::error("❌ Failed to sync top rated {$title}: " . $e->getMessage());
            }
        }
    }

    /**
     * Fetch statistics untuk multiple manga sekaligus
     * 
     * @param array $mangaIds
     * @return array [manga_id => statistics]
     */
    private function fetchBatchStatistics($mangaIds)
    {
        $statistics = [];

        // MangaDex API mendukung batch statistics
        $chunks = array_chunk($mangaIds, 100);

        foreach ($chunks as $chunk) {
            $ids = implode('&manga[]=', $chunk);
            $url = "{$this->base}/statistics/manga?manga[]={$ids}";

            try {
                $res = Http::timeout(15)->get($url);

                if ($res->successful()) {
                    $data = $res->json('statistics', []);
                    $statistics = array_merge($statistics, $data);
                }
            } catch (\Exception $e) {
                Log::warning("Failed to fetch batch statistics: {$e->getMessage()}");
            }

            // Rate limiting
            usleep(200000); // 200ms delay
        }

        return $statistics;
    }

    /**
     * Fetch single manga statistics
     * 
     * @param string $mangaId
     * @return array|null
     */
    public function fetchMangaStatistics($mangaId)
    {
        $url = "{$this->base}/statistics/manga/{$mangaId}";

        try {
            $res = Http::timeout(10)->get($url);

            if ($res->successful()) {
                return $res->json("statistics.{$mangaId}");
            }
        } catch (\Exception $e) {
            Log::warning("Failed to fetch statistics for {$mangaId}: {$e->getMessage()}");
        }

        return null;
    }
 

    // Base sync manga
    public function sync($limit = 20) 
    { 
        $data = $this->fetchPopular($limit); 
        
        // Batch fetch semua author sekaligus (LEBIH CEPAT)
        $authorsMap = $this->getAuthorsMap($data);
 
        foreach ($data as $item) { 
 
            $attr = $item['attributes']; 
 
            // Ambil title dari bahasa apapun yang tersedia
            $titles = $attr['title'] ?? [];
            $title = $titles['en'] 
                ?? $titles['ja-ro']
                ?? $titles['ja'] 
                ?? $titles['jp']
                ?? (!empty($titles) ? reset($titles) : "No Title");
 
            // Ambil cover 
            $cover = collect($item['relationships']) 
                ->firstWhere('type', 'cover_art'); 
 
            $image = $cover 
                ? "https://uploads.mangadex.org/covers/{$item['id']}/{$cover['attributes']['fileName']}.256.jpg" 
                : null; 
 
            // Ambil author
            $authorNames = collect($item['relationships'] ?? [])
                ->filter(fn($rel) => $rel['type'] === 'author')
                ->map(function($rel) use ($authorsMap) {
                    // Cek di map dulu
                    if (isset($rel['id']) && isset($authorsMap[$rel['id']])) {
                        return $authorsMap[$rel['id']];
                    }
                    // Fallback ke attributes jika ada
                    if (isset($rel['attributes']['name'])) {
                        return $rel['attributes']['name'];
                    }
                    return null;
                })
                ->filter()
                ->values();
            
            // Gabungkan semua author dengan koma
            $authorName = $authorNames->isEmpty() 
                ? 'Unknown Author' 
                : $authorNames->join(', ');
            
            // Max 200 karakter
            $authorName = mb_substr($authorName, 0, 200);
 
            // Ambil chapter dengan berbagai fallback
            $chapterInfo = $this->fetchLastChapter($item['id']) ?? []; 
 
            // Logging untuk debug manga yang tidak punya chapter
            if (empty($chapterInfo['chapter'])) {
                Log::info("No chapter found for: {$title} (ID: {$item['id']})");
            }
 
            try {
                Comic::updateOrCreate( 
                    ['mangadex_id' => $item['id']], 
                    [ 
                        'title'        => $title, 
                        'type'         => $attr['originalLanguage'] ?? 'unknown', 
                        'image'        => $image, 
                        'status'       => $attr['status'] ?? null, 
                        'author'       => $authorName,
                        'is_sensitive' => $this->isSensitive($item), 
                     
                        'last_update'  => isset($chapterInfo['updated']) 
                                            ? Carbon::parse($chapterInfo['updated']) 
                                            : null, 
                     
                        'last_chapter' => $chapterInfo['chapter'] ?? null, 
                    ] 
                );
                
                Log::info("Synced: {$title} | Author: {$authorName}");
                
            } catch (\Exception $e) {
                Log::error("Failed to sync {$title}: " . $e->getMessage());
            }
 
        } 
 
        return true; 
    }
    
    /**
     * Batch fetch semua author sekaligus untuk performa lebih baik
     * 
     * @param array $mangaList
     * @return array [author_id => author_name]
     */
    private function getAuthorsMap($mangaList)
    {
        $authorsMap = [];
        
        // Kumpulkan author yang SUDAH ada di attributes
        foreach ($mangaList as $manga) {
            foreach ($manga['relationships'] ?? [] as $rel) {
                if ($rel['type'] === 'author' && isset($rel['attributes']['name'])) {
                    $authorsMap[$rel['id']] = $rel['attributes']['name'];
                }
            }
        }
        
        // Kumpulkan author IDs yang BELUM ada di map
        $missingAuthorIds = collect($mangaList)
            ->flatMap(fn($item) => collect($item['relationships'] ?? [])
                ->where('type', 'author')
                ->pluck('id')
            )
            ->unique()
            ->filter(fn($id) => !isset($authorsMap[$id]))
            ->values()
            ->toArray();
        
        // Jika ada yang missing, fetch dari API
        if (!empty($missingAuthorIds)) {
            $chunks = array_chunk($missingAuthorIds, 100);
            
            foreach ($chunks as $chunk) {
                $ids = implode('&ids[]=', $chunk);
                $url = "{$this->base}/author?ids[]={$ids}";
                
                try {
                    $res = Http::timeout(10)->get($url);
                    
                    if ($res->successful()) {
                        foreach ($res->json('data', []) as $author) {
                            $authorsMap[$author['id']] = $author['attributes']['name'] ?? 'Unknown';
                        }
                    }
                } catch (\Exception $e) {
                    Log::warning("Failed to fetch authors batch: {$e->getMessage()}");
                }
            }
        }
        
        return $authorsMap;
    }
 
    private function fetchLastChapter($mangaId) 
    { 
        // Fetch multiple chapters (up to 100) and pick the one with the highest numeric chapter value.
        // This avoids cases where ordering by date returns a low-numbered chapter while the
        // highest chapter number exists elsewhere (e.g. decimals or different languages).
        $limits = [
            // prefer English translations first
            "{$this->base}/chapter?manga={$mangaId}&limit=100&translatedLanguage[]=en&order[readableAt]=desc&includeFutureUpdates=0",
            // then any language
            "{$this->base}/chapter?manga={$mangaId}&limit=100&order[readableAt]=desc&includeFutureUpdates=0",
            // fallback to createdAt ordering
            "{$this->base}/chapter?manga={$mangaId}&limit=100&order[createdAt]=desc",
        ];

        $allCandidates = [];

        foreach ($limits as $url) {
            try {
                $res = Http::get($url);
            } catch (\Exception $e) {
                continue;
            }

            if (!$res->successful()) {
                continue;
            }

            $data = $res->json('data', []);
            foreach ($data as $chapter) {
                $info = $this->extractChapterInfo($chapter);
                if ($info) {
                    $allCandidates[] = $info;
                }
            }

            // If we already have candidates with numeric chapter numbers, stop after first successful fetch
            if (!empty($allCandidates)) {
                break;
            }
        }

        if (empty($allCandidates)) {
            return null;
        }

        // Prefer the entry with the largest numeric chapter value. If none have numeric, pick the most recent updated.
        $numericCandidates = array_filter($allCandidates, fn($c) => isset($c['chapter_num']) && $c['chapter_num'] !== null);

        if (!empty($numericCandidates)) {
            usort($numericCandidates, fn($a, $b) => $b['chapter_num'] <=> $a['chapter_num']);
            return $numericCandidates[0];
        }

        usort($allCandidates, function ($a, $b) {
            $ta = $a['updated'] ? strtotime($a['updated']) : 0;
            $tb = $b['updated'] ? strtotime($b['updated']) : 0;
            return $tb <=> $ta;
        });

        return $allCandidates[0];
    } 
 
    private function extractChapterInfo($chapter)
    {
        $raw = $chapter['attributes']['chapter'] ?? null;

        return [
            'chapter' => $raw ?? 'N/A',
            // parsed numeric chapter when possible (e.g. '123', '12.5')
            'chapter_num' => $this->parseChapterValue($raw),
            'updated' => $chapter['attributes']['readableAt']
                ?? $chapter['attributes']['publishAt']
                ?? $chapter['attributes']['createdAt']
                ?? $chapter['attributes']['updatedAt']
                ?? null,
        ];
    }

    /**
     * Parse a chapter string and return a numeric value when possible.
     * Examples: '123' -> 123.0, '12.5' -> 12.5, 'ch. 45' -> 45.0
     * Returns null when no numeric part is found.
     *
     * @param mixed $raw
     * @return float|null
     */
    private function parseChapterValue($raw)
    {
        if ($raw === null) {
            return null;
        }

        // Normalize to string and trim
        $s = trim((string) $raw);

        // Find first numeric occurrence, allowing decimals
        if (preg_match('/(\d+(?:\.\d+)?)/', $s, $m)) {
            return (float) $m[1];
        }

        return null;
    }
    

    // Cek apakah manga termasuk sensitif berdasarkan tags
    private function isSensitive($item)
    {
        $sensitiveTags = [
            'ecchi',
            'adult',
            'mature',
            'sexual violence',
            'gore',
            'smut',
            'hentai'
        ];

        $tags = collect($item['attributes']['tags'] ?? [])
            ->pluck('attributes.name.en')
            ->map(fn($t) => strtolower($t))
            ->toArray();

        foreach ($sensitiveTags as $tag) {
            if (in_array(strtolower($tag), $tags)) {
                return true;
            }
        }

        return false;
    }
}