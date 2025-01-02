<?php

namespace App\Providers;

use App\Models\Link;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Session;

class AuthServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Gate::define(
            'only-link-owner',
            function (mixed $user, Link $link) {
                return Auth::id() === $link->user_id || Session::id() === $link->session_id;
            }
        );
    }
}
