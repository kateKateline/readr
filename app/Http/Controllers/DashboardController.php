<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Comic;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        // load data for dashboard tabs
        $users = User::all();
        $comics = Comic::all();

        return view('dashboard.index', compact('user', 'users', 'comics'));
    }
}
