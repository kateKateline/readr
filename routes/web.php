<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;

Route::get('/', [HomeController::class, 'index'])->name('home');

// show login form
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');

// proses login (POST)
Route::post('/login', [AuthController::class, 'login'])->name('login.post');

// logout (POST)
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'isAdmin']) // tambahkan middleware di sini
    ->name('dashboard');
