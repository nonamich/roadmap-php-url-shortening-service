<?php

use App\Http\Controllers\Api\LinkApiController;
use Illuminate\Support\Facades\Route;

Route::put('/', function () {
    return response()->json(['fine']);
});

Route::middleware(['api', 'can:only-link-owner,link'])->prefix('shorten')->group(function () {
    // Route::get('/', [LinkApiController::class, 'index']);

    Route::prefix('/{link:code}')->group(function () {
        Route::get('/', [LinkApiController::class, 'show']);
        // Route::post('/', [LinkApiController::class, 'store']);
        Route::put('/', [LinkApiController::class, 'update']);
        Route::delete('/', [LinkApiController::class, 'destroy']);
    });
});
