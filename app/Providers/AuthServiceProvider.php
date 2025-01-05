<?php

namespace App\Providers;

use App\Guards\JwtGuard;
use App\Models\Link;
use App\Policies\LinkPolicy;
use App\Services\JwtService;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Auth;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * All of the container singletons that should be registered.
     *
     * @var array
     */
    public $singletons = [
        JwtService::class => JwtService::class,
    ];

    protected $policies = [
        Link::class => LinkPolicy::class,
    ];

    public function boot()
    {
        $this->registerPolicies();

        Auth::extend('jwt', function () {
            $guard = new JwtGuard;

            return $guard;
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array<int, string>
     */
    public function provides(): array
    {
        return [JwtService::class];
    }
}
