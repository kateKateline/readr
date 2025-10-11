<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Models\User; // import model Eloquent User

class AuthController extends Controller
{
    // Menampilkan halaman signup
    public function showSignupForm() {
        return view('auth.signup');
    }

    // Proses signup user baru
    public function signup(Request $request) {
        $request->validate([
            'username' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        //  Menggunakan Eloquent untuk insert data user
        User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'profile' => 'default.png',
            'role' => 'user',           // default role
        ]);

        return redirect()->route('signin.form')->with('success', 'Account created successfully!');
    }

    // Menampilkan halaman signin
    public function showSigninForm() {
        return view('auth.signin');
    }

    // Proses signin (login)
    public function signin(Request $request) {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        //  Ambil user berdasarkan email menggunakan Eloquent
        $user = User::where('email', $request->email)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            Session::put('user_id', $user->id);
            return redirect('/')->with('success', 'Welcome back, ' . $user->username . '!');
        }

        return back()->with('error', 'Invalid email or password.');
    }

    // Logout user
    public function logout() {
        Session::forget('user_id');
        return redirect('/')->with('success', 'You have been logged out.');
    }

    public function profile() {
    $user = \App\Models\User::find(session('user_id'));
    if (!$user) {
        return redirect()->route('signin.form')->with('error', 'Please login first.');
    }

    return view('auth.profile', compact('user'));
}


}
