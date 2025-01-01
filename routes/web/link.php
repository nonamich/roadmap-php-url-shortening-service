<?php

use App\Http\Controllers\LinkController;
use Illuminate\Support\Facades\Route;

Route::get('/links', [LinkController::class, 'links']);
Route::post('/', [LinkController::class, 'create']);

Route::middleware(['can:only-link-owner,link'])->group(function () {
    Route::patch('/{link:code}', [LinkController::class, 'update']);
    Route::get('/{link:code}/edit', [LinkController::class, 'edit']);
    Route::delete('/{link:code}', [LinkController::class, 'destroy']);
});

Route::get('/{link:code}', [LinkController::class, 'redirect']);
