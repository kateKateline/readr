<?php 
 
namespace App\Services; 
 
use App\Models\Comic; 
use Illuminate\Support\Facades\Http; 
use Carbon\Carbon; 
use Illuminate\Support\Facades\Log;
 
class ComicService 
{ 
    private $base = "https://api.mangadex.org"; 
 
    public function fetchPopular($limit = 20) 
    { 
        // Tambahkan author ke includes
        $url = "{$this->base}/manga?limit={$limit}&includes[]=cover_art&includes[]=author&order[followedCount]=desc"; 
 
        $res = Http::get($url); 
 
        if ($res->failed() || empty($res->json('data'))) { 
            return []; 
        } 
 
        return $res->json('data'); 
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

            // Ambil author
            $authorNames = collect($item['relationships'] ?? [])
                ->filter(fn($rel) => $rel['type'] === 'author')
                ->map(function($rel) use ($authorsMap) {
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
            
            $authorName = $authorNames->isEmpty() 
                ? 'Unknown Author' 
                : $authorNames->join(', ');
            
            $authorName = mb_substr($authorName, 0, 200);

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
 
            // ✅ FIX: Ambil SEMUA author dan gabungkan dengan koma
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
            
            // Gabungkan semua author dengan koma, max 200 karakter
            $authorName = $authorNames->isEmpty() 
                ? 'Unknown Author' 
                : $authorNames->join(', ');
            
            // Potong jika terlalu panjang (database limit)
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
                
                Log::info("✅ Synced: {$title} | Author: {$authorName}");
                
            } catch (\Exception $e) {
                Log::error("❌ Failed to sync {$title}: " . $e->getMessage());
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
        // Coba ambil chapter bahasa Inggris dulu
        $url = "{$this->base}/chapter?manga={$mangaId}&limit=1&translatedLanguage[]=en&order[readableAt]=desc&includeFutureUpdates=0";
 
        $res = Http::get($url); 
 
        // Jika ada chapter bahasa Inggris, return
        if ($res->successful() && !empty($res->json('data'))) { 
            $chapter = $res->json('data')[0]; 
            return $this->extractChapterInfo($chapter);
        } 
 
        // Kalau tidak ada EN, coba ambil chapter BAHASA APAPUN
        $url = "{$this->base}/chapter?manga={$mangaId}&limit=1&order[readableAt]=desc&includeFutureUpdates=0";
 
        $res = Http::get($url); 
 
        if ($res->successful() && !empty($res->json('data'))) { 
            $chapter = $res->json('data')[0]; 
            return $this->extractChapterInfo($chapter);
        }
 
        // Fallback ke createdAt jika readableAt tidak ada
        $url = "{$this->base}/chapter?manga={$mangaId}&limit=1&order[createdAt]=desc";
 
        $res = Http::get($url); 
 
        if ($res->successful() && !empty($res->json('data'))) { 
            $chapter = $res->json('data')[0]; 
            return $this->extractChapterInfo($chapter);
        }
 
        // Tidak ada chapter sama sekali
        return null; 
    } 
 
    private function extractChapterInfo($chapter)
    {
        return [ 
            'chapter' => $chapter['attributes']['chapter'] ?? 'N/A', 
            'updated' => $chapter['attributes']['readableAt'] 
                ?? $chapter['attributes']['publishAt']
                ?? $chapter['attributes']['createdAt']
                ?? $chapter['attributes']['updatedAt'] 
                ?? null, 
        ];
    }
    
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