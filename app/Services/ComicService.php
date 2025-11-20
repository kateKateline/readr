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