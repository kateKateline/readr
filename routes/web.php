<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DashboardComicController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ComicController;
use App\Http\Controllers\GlobalChatController;

Route::post('/global-chat', [GlobalChatController::class, 'store'])
     ->name('global-chat.store');

// =============================================
// PUBLIC ROUTES
// =============================================
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/comics/{mangadex_id}', [ComicController::class, 'show'])
     ->name('comic.show');


// =============================================
// AUTH ROUTES
// =============================================
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
    
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.post');
});

Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

// =============================================
// PROTECTED ROUTES
// =============================================
Route::middleware('auth')->group(function () {
    
    // Profile
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');

    // DASHBOARD ADMIN (ROLE: ADMIN)
    Route::middleware('isAdmin')->group(function () {

        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        // Dashboard CRUD Comics/Manga
        Route::resource('/dashboard/comics', DashboardComicController::class)
            ->names('dashboard.comics')
            ->except(['show']);

    });

});
