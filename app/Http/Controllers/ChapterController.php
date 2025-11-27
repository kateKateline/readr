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

    return view('chapters.read', [
        'chapter' => $chapter,
        'images' => $imageUrls
    ]);
}

}
