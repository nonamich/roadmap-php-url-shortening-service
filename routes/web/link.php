<?php

use App\Http\Controllers\LinkController;
use Illuminate\Support\Facades\Route;

Route::post('/', [LinkController::class, 'store']);
Route::get('/links', [LinkController::class, 'index']);
Route::get('/{link:code}', [LinkController::class, 'show']);
Route::get('/{link:code}/edit', [LinkController::class, 'edit']);
Route::patch('/{link:code}', [LinkController::class, 'update']);
Route::delete('/{link:code}', [LinkController::class, 'destroy']);
