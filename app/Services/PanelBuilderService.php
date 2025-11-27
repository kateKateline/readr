<?php

namespace App\Services;

use App\Models\Chapter;
use App\Models\ChapterPanel;
use Illuminate\Support\Facades\Log;

class PanelBuilderService
{
    private string $baseUrl = "https://uploads.mangadex.org";

    /**
     * Generate panels for a chapter
     */
    public function buildPanelsForChapter(Chapter $chapter): bool
    {
        if (!$chapter->hash || empty($chapter->data)) {
            Log::warning("Chapter {$chapter->id} tidak memiliki data gambar.");
            return false;
        }

        // Hapus panel lama kalau ada
        ChapterPanel::where('chapter_id', $chapter->id)->delete();

        $hash = $chapter->hash;
        $images = $chapter->data;

        foreach ($images as $index => $img) {
            $url = "{$this->baseUrl}/data/{$hash}/{$img}";

            ChapterPanel::create([
                'chapter_id'  => $chapter->id,
                'page_number' => $index + 1,
                'image_url'   => $url,
                'width'       => null, // Metadata tidak tersedia di API
                'height'      => null,
            ]);
        }

        Log::info("Panels generated for chapter {$chapter->id}");

        return true;
    }


    /**
     * Generate panels for all chapters of a manga
     */
    public function buildPanelsForManga(string $mangaId): int
    {
        $chapters = Chapter::whereHas('comic', fn($q) => $q->where('mangadex_id', $mangaId))
                           ->where('pages', '>', 0)
                           ->get();

        $count = 0;

        foreach ($chapters as $chapter) {
            if ($this->buildPanelsForChapter($chapter)) {
                $count++;
                usleep(150000); // 0.15 sec to avoid overload
            }
        }

        return $count;
    }
}
    