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
 
            // 🔥 FIX: Coba ambil chapter dengan berbagai fallback
            $chapterInfo = $this->fetchLastChapter($item['id']) ?? []; 
 
            // 🔍 Logging untuk debug manga yang tidak punya chapter
            if (empty($chapterInfo['chapter'])) {
                Log::info("No chapter found for: {$title} (ID: {$item['id']})");
            }
 
            Comic::updateOrCreate( 
                ['mangadex_id' => $item['id']], 
                [ 
                    'title'        => $title, 
                    'type'         => $attr['originalLanguage'] ?? 'unknown', 
                    'image'        => $image, 
                    'status'       => $attr['status'] ?? null, 
                 
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
        // 🔥 FIX 1: Coba ambil chapter bahasa Inggris dulu
        $url = "{$this->base}/chapter?manga={$mangaId}&limit=1&translatedLanguage[]=en&order[readableAt]=desc&includeFutureUpdates=0";
 
        $res = Http::get($url); 
 
        // Jika ada chapter bahasa Inggris, return
        if ($res->successful() && !empty($res->json('data'))) { 
            $chapter = $res->json('data')[0]; 
            return $this->extractChapterInfo($chapter);
        } 
 
        // 🔥 FIX 2: Kalau tidak ada EN, coba ambil chapter BAHASA APAPUN
        $url = "{$this->base}/chapter?manga={$mangaId}&limit=1&order[readableAt]=desc&includeFutureUpdates=0";
 
        $res = Http::get($url); 
 
        if ($res->successful() && !empty($res->json('data'))) { 
            $chapter = $res->json('data')[0]; 
            return $this->extractChapterInfo($chapter);
        }
 
        // 🔥 FIX 3: Fallback ke createdAt jika readableAt tidak ada
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
}