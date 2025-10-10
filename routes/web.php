<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/signup', [AuthController::class, 'showSignupForm'])->name('signup.form');
Route::post('/signup', [AuthController::class, 'signup'])->name('signup');

Route::get('/signin', [AuthController::class, 'showSigninForm'])->name('signin.form');
Route::post('/signin', [AuthController::class, 'signin'])->name('signin');

Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

