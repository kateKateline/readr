<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// 🏠 Halaman utama
Route::get('/', function () {
    return view('welcome');
})->name('home');


// 👑 Route khusus admin (harus login + role admin)
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::post('/admin/comics/store', [AdminController::class, 'store'])->name('admin.comics.store');
});


// 🔐 Route untuk autentikasi (login, signup, logout)
Route::controller(AuthController::class)->group(function () {
    Route::get('/signup', 'showSignupForm')->name('signup.form');
    Route::post('/signup', 'signup')->name('signup');

    Route::get('/signin', 'showSigninForm')->name('signin.form');
    Route::post('/signin', 'signin')->name('signin');

    Route::get('/logout', 'logout')->name('logout');
});

// Alias untuk compatibility dengan middleware 'auth' (Laravel cari route('login'))
Route::get('/login', [AuthController::class, 'showSigninForm'])->name('login');


// 👤 Route untuk profil user
Route::get('/profile', [AuthController::class, 'profile'])->name('profile');
Route::get('/profile/{id}', [ProfileController::class, 'show'])->name('profile.show');
