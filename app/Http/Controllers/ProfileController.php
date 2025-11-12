<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    // Tampilkan halaman profil user yang sedang login
    public function index()
    {
        $user = Auth::user();

        return view('profile.index', compact('user'));
    }
}
