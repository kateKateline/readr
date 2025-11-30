<?php

namespace App\Http\Controllers;

use App\Models\Chapter;

class ChapterController extends Controller
{
public function read(Chapter $chapter)
{
    // Jika tidak ada gambar tapi punya externalUrl → Redirect
    if ($chapter->pages == 0 && $chapter->external_url) {
        return redirect()->away($chapter->external_url);
    }

    if (!$chapter->hash || empty($chapter->data)) {
        abort(404, "Chapter tidak memiliki data gambar.");
    }

    $baseUrl = "https://uploads.mangadex.org";
    $hash = $chapter->hash;
    $images = $chapter->data;

    $imageUrls = array_map(fn($img) => "$baseUrl/data/$hash/$img", $images);

    // Load comic dengan relasi
    $comic = $chapter->comic;
    
    // Get next and previous chapters (same language, same comic)
    // Get all chapters untuk comic ini dengan bahasa yang sama, lalu filter di PHP
    $allChapters = Chapter::where('comic_id', $chapter->comic_id)
        ->where('translated_language', $chapter->translated_language)
        ->orderByRaw('CAST(chapter_number AS DECIMAL(10, 2)) ASC')
        ->get();

    $currentIndex = $allChapters->search(function($item) use ($chapter) {
        return $item->id === $chapter->id;
    });

    $nextChapter = null;
    $previousChapter = null;

    if ($currentIndex !== false) {
        if (isset($allChapters[$currentIndex + 1])) {
            $nextChapter = $allChapters[$currentIndex + 1];
        }
        if (isset($allChapters[$currentIndex - 1])) {
            $previousChapter = $allChapters[$currentIndex - 1];
        }
    }

    // Load comments dengan relasi user dan nested replies
    $comments = $comic->comments()
        ->parentOnly()
        ->with(['user', 'replies.user'])
        ->latest()
        ->get();

    return view('chapters.read', [
        'chapter' => $chapter,
        'comic' => $comic,
        'images' => $imageUrls,
        'nextChapter' => $nextChapter,
        'previousChapter' => $previousChapter,
        'comments' => $comments
    ]);
}

}
