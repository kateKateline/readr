<?php

namespace App\Http\Controllers;

use App\Models\Comic;
use Illuminate\Support\Facades\DB;

class ComicController extends Controller
{
    public function show(Comic $comic)
    {
        // 1. Ambil semua chapters.
        // PENTING: Gunakan CAST(chapter_number AS DECIMAL(10, 2)) untuk memastikan pengurutan numerik
        // karena chapter_number mungkin disimpan sebagai string atau float, dan perlu diurutkan dengan benar (0, 1, 2, ..., 10, 11)
        $chaptersByLanguage = $comic->chapters()
            ->select('*') // Pilih semua kolom  
            // Mengurutkan secara numerik   
            ->orderByRaw('CAST(chapter_number AS DECIMAL(10, 2)) ASC') 
            ->get()
            ->groupBy('translated_language');

        // 2. Ambil daftar bahasa unik yang tersedia untuk ditampilkan sebagai tab.
        $availableLanguages = $chaptersByLanguage->keys();

        // 3. Tentukan bahasa default (misalnya, bahasa pertama yang ditemukan)
        $defaultLanguage = $availableLanguages->first();
        
        return view('comics.show', compact('comic', 'chaptersByLanguage', 'availableLanguages', 'defaultLanguage'));
    }
}