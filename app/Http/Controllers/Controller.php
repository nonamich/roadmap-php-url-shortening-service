<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Routing\Controller as BaseController;

abstract class Controller extends BaseController
{
    use AuthorizesRequests;

    protected function response(callable $callbackWeb, callable $callbackApi)
    {
        if (request()->expectsJson()) {
            return call_user_func($callbackApi);
        }

        return call_user_func($callbackWeb);
    }
}
