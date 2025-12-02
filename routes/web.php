<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DashboardComicController;
use App\Http\Controllers\DashboardUserController;
use App\Http\Controllers\DashboardChapterController;
use App\Http\Controllers\DashboardCommentController;
use App\Http\Controllers\DashboardGlobalChatController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ComicController;
use App\Http\Controllers\GlobalChatController;
use App\Http\Controllers\ChapterController;
use App\Http\Controllers\CommentController;


Route::middleware(['auth'])->group(function () {
    Route::post('/comments', [CommentController::class, 'store'])->name('comments.store');
    Route::put('/comments/{comment}', [CommentController::class, 'update'])->name('comments.update');
    Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');
});
Route::post('/global-chat', [GlobalChatController::class, 'store'])
     ->name('global-chat.store');

// =============================================
// PUBLIC ROUTES
// =============================================
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/search', [\App\Http\Controllers\ExploreController::class, 'search'])->name('comics.search');

Route::get('/comic/{comic:mangadex_id}', [ComicController::class, 'show'])
    ->name('comic.show');

Route::get('/chapter/{chapter}', [ChapterController::class, 'read'])
    ->name('chapter.read');



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
        Route::post('/dashboard/reset-global-chat', [DashboardController::class, 'resetGlobalChat'])->name('dashboard.reset-global-chat');

        // Dashboard CRUD
        Route::resource('/dashboard/users', DashboardUserController::class)
            ->names('dashboard.users')
            ->except(['show']);

        Route::resource('/dashboard/comics', DashboardComicController::class)
            ->names('dashboard.comics')
            ->except(['show']);

        Route::resource('/dashboard/chapters', DashboardChapterController::class)
            ->names('dashboard.chapters')
            ->except(['show']);

        Route::resource('/dashboard/comments', DashboardCommentController::class)
            ->names('dashboard.comments')
            ->except(['show']);

        Route::resource('/dashboard/global-chats', DashboardGlobalChatController::class)
            ->names('dashboard.global-chats')
            ->except(['show']);

        // Print routes
        Route::get('/dashboard/users/print', [DashboardUserController::class, 'print'])->name('dashboard.users.print');
        Route::get('/dashboard/comics/print', [DashboardComicController::class, 'print'])->name('dashboard.comics.print');
        Route::get('/dashboard/chapters/print', [DashboardChapterController::class, 'print'])->name('dashboard.chapters.print');
        Route::get('/dashboard/comments/print', [DashboardCommentController::class, 'print'])->name('dashboard.comments.print');
        Route::get('/dashboard/global-chats/print', [DashboardGlobalChatController::class, 'print'])->name('dashboard.global-chats.print');

    });

});
