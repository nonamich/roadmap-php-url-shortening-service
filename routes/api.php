<?php

use App\Http\Controllers\LinkController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return response()->json(Auth::user());
});

Route::middleware(['api', 'can:only-link-owner,link'])->prefix('shorten')->group(function () {
    // Route::get('/', [LinkController::class, 'index']);

    Route::prefix('/{link:code}')->group(function () {
        Route::get('/', [LinkController::class, 'show']);
        // Route::post('/', [LinkController::class, 'store']);
        Route::put('/', [LinkController::class, 'update']);
        Route::delete('/', [LinkController::class, 'destroy']);
    });
});
