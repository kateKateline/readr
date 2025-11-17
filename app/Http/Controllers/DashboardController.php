<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Manga;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard.index', [
            'users' => User::all(),
            'mangas' => Manga::all(),
        ]);
    }
}
