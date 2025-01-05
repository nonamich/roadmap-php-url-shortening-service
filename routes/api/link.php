<?php

use App\Http\Controllers\LinkController;
use Illuminate\Support\Facades\Route;

Route::prefix('shorten')->group(function () {

    Route::prefix('/{link:code}')->group(function () {
        Route::get('/', [LinkController::class, 'show']);

        Route::middleware('auth:api')->group(function () {
            Route::put('/', [LinkController::class, 'update']);
            Route::delete('/', [LinkController::class, 'destroy']);
        });
    });

    Route::middleware('auth:api')->group(function () {
        Route::post('/', [LinkController::class, 'store']);
    });
});
