<?php

namespace App\Http\Controllers;

use App\Models\Comic;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Ambil data per tipe
        $manga = Comic::where('type', 'manga')->orderBy('uploaded_at', 'desc')->get();
        $manhwa = Comic::where('type', 'manhwa')->orderBy('uploaded_at', 'desc')->get();
        $manhua = Comic::where('type', 'manhua')->orderBy('uploaded_at', 'desc')->get();

        return view('home', compact('manga', 'manhwa', 'manhua'));
    }
}
