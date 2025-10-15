<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Comic;


class ProfileController extends Controller
{
    public function show($id)
    {
        // Ambil data user
        $user = User::with(['favorites.comic', 'bookmarks.comic'])->findOrFail($id);

        // Render blade in resources/views/pages/profile.blade.php
        return view('pages.profile', compact('user'));
    }
}
