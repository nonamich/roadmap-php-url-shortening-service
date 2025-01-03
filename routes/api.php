<?php

use App\Http\Controllers\LinkController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:api')->prefix('shorten')->group(function () {
    Route::post('/', [LinkController::class, 'store']);

    Route::prefix('/{link:code}')->group(function () {
        Route::put('/', [LinkController::class, 'update']);
        Route::delete('/', [LinkController::class, 'destroy']);
    });
});
