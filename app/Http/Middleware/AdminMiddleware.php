<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Session;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $userId = Session::get('user_id');
        $user = User::find($userId);

        // Jika belum login
        if (!$user) {
            return redirect()->route('login')->with('error', 'Please login first.');
        }

        // Jika login tapi bukan admin
        if ($user->role !== 'admin') {
            return redirect()->route('home')->with('error', 'Access denied.');
        }

        // Jika admin → lanjut ke halaman berikutnya
        return $next($request);
    }
}
