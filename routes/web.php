<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;



// Halaman utama
Route::get('/', function () {
    return view('welcome');
})->name('home');

// Auth Routes
Route::get('/signup', [AuthController::class, 'showSignupForm'])->name('signup.form');
Route::post('/signup', [AuthController::class, 'signup'])->name('signup');

Route::get('/signin', [AuthController::class, 'showSigninForm'])->name('signin.form');
Route::post('/signin', [AuthController::class, 'signin'])->name('signin');

Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

// Profile Route
Route::get('/profile', [AuthController::class, 'profile'])->name('profile');


Route::get('/profile/{id}', [ProfileController::class, 'show'])->name('profile.show');

