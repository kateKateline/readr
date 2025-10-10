<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function showSignupForm() {
        return view('auth.signup');
    }

    public function signup(Request $request) {
        $request->validate([
            'username' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        DB::table('users')->insert([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('signin.form')->with('success', 'Account created successfully!');
    }

    public function showSigninForm() {
        return view('auth.signin');
    }

    public function signin(Request $request) {
        $user = DB::table('users')->where('email', $request->email)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            Session::put('user', $user);
            return redirect('/')->with('success', 'Welcome back, ' . $user->username . '!');
        }

        return back()->with('error', 'Invalid email or password.');
    }

    public function logout() {
    Session::forget('user');
    return redirect('/')->with('success', 'You have been logged out.');
    }
    
}
