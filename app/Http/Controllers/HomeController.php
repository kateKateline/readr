<?php

namespace App\Http\Controllers;

use App\Models\Comic;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class HomeController extends Controller
{
    public function index()
    {
        // Ambil data per tipe
        $manga = Comic::where('type', 'manga')->orderBy('uploaded_at', 'desc')->get();
        $manhwa = Comic::where('type', 'manhwa')->orderBy('uploaded_at', 'desc')->get();
        $manhua = Comic::where('type', 'manhua')->orderBy('uploaded_at', 'desc')->get();

        // Pastikan setiap item punya slug (jika kolom slug belum diisi)
        foreach ([$manga, $manhwa, $manhua] as $comics) {
            foreach ($comics as $comic) {
                if (empty($comic->slug)) {
                    // Generate slug sementara dari judul
                    $comic->slug = Str::slug($comic->title);
                }
            }
        }

        // Kirim data ke view
        return view('home', compact('manga', 'manhwa', 'manhua'));
    }
}
