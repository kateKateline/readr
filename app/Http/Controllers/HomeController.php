<?php

namespace App\Http\Controllers;

use App\Models\Comic;

class HomeController extends Controller
{
    public function index()
    {
        $comics = Comic::orderByDesc('last_update')->get();
        return view('home', compact('comics'));
    }
}
