<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ComicController;

//landing page
Route::get('/', [HomeController::class, 'index'])->name('home');

//Auth
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

//Dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'isAdmin'])
    ->name('dashboard');

//Show comic
Route::get('/comics/show/{slug}', [ComicController::class, 'show'])->name('comic.show');
