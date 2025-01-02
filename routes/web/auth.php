<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('/login', fn () => view('pages.login'))->name('login');
    Route::get('/register', [RegisterController::class, 'create'])->name('register');

    Route::post('/login', [LoginController::class, 'authenticate']);
    Route::post('/register', [RegisterController::class, 'store']);
});

Route::get('/logout', [RegisterController::class, 'logout']);
