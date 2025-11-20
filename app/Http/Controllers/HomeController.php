<?php

namespace App\Http\Controllers;

use App\Models\Comic;

class HomeController extends Controller
{
public function index()
{
    $user = auth()->user();

    $query = Comic::orderByDesc('last_update');

    // Jika user belum login → sembunyikan komik sensitive
    if (!$user) {
        $query->where('is_sensitive', false);
    }

    // Jika user login & censorship_enabled = true → sembunyikan komik sensitive
    if ($user && $user->censorship_enabled) {
        $query->where('is_sensitive', false);
    }

    // Jika user login & censorship_enabled = false → tampilkan semua komik

    $comics = $query->get();

    return view('home', compact('comics'));
}

}
