<?php

namespace App\Http\Controllers;

use App\Models\Comic;

class ComicController extends Controller
{
    public function show(Comic $comic)
    {
        $chapters = $comic->chapters()
            ->orderBy('chapter_number', 'asc')
            ->get();

        return view('comics.show', compact('comic', 'chapters'));
    }
}
