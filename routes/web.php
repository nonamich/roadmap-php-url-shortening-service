<?php

use Illuminate\Support\Facades\Route;

require_once __DIR__.'/web/auth.php';
require_once __DIR__.'/web/link.php';

Route::get('/', function () {
    return view('pages.welcome');
});
