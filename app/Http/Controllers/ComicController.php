<?php

namespace App\Http\Controllers;

use App\Models\Comic;
use Illuminate\Support\Facades\DB;

class ComicController extends Controller
{
    public function show(Comic $comic)
    {
        // Mapping bahasa lengkap
        $languageNames = [
            'en' => 'English',
            'id' => 'Indonesia',
            'fr' => 'French',
            'es' => 'Spanish',
            'de' => 'German',
            'it' => 'Italian',
            'ru' => 'Russian',
            'pt' => 'Portuguese',
            'pl' => 'Polish',
            'tr' => 'Turkish',
            'th' => 'Thai',
            'vi' => 'Vietnamese',
            'ar' => 'Arabic',
            'ja' => 'Japanese',
            'zh' => 'Chinese',
            'zh-hk' => 'Chinese (Hong Kong)',
            'ko' => 'Korean',
            'nl' => 'Dutch',
            'ms' => 'Malay',
            'hi' => 'Hindi',
            'bn' => 'Bengali',
            'fa' => 'Persian',
            'sv' => 'Swedish',
            'fi' => 'Finnish',
            'no' => 'Norwegian',
            'da' => 'Danish',
            'he' => 'Hebrew',
            'ka'=> 'Georgian',
            'pt-br' => 'portuguese (Brazil)',
            // tambahkan jika butuh lagi
        ];

        // Ambil semua chapter dan kelompokkan berdasarkan bahasa
        $chaptersByLanguage = $comic->chapters()
            ->select('*')
            ->orderByRaw('CAST(chapter_number AS DECIMAL(10, 2)) ASC')
            ->get()
            ->groupBy('translated_language');

        // Ambil daftar bahasa yang ada
        $availableLanguages = $chaptersByLanguage->keys();

        // Tentukan bahasa default
        $defaultLanguage = $availableLanguages->first();

        // Convert kode → nama
        $languageLabels = [];
        foreach ($availableLanguages as $lang) {
            $languageLabels[$lang] = $languageNames[$lang] ?? strtoupper($lang);
        }

        return view('comics.show', compact(
            'comic',
            'chaptersByLanguage',
            'availableLanguages',
            'defaultLanguage',
            'languageLabels'
        ));
    }
}