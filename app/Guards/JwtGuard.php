<?php

namespace App\Guards;

use App\Services\JwtService;
use Illuminate\Auth\GuardHelpers;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Traits\Macroable;

class JwtGuard implements Guard
{
    use GuardHelpers;
    use Macroable;

    private Request $request;

    private JwtService $jwtService;

    public function __construct()
    {
        $provider = (string) config('auth.guards.api.provider');
        $providerInstance = Auth::createUserProvider($provider);

        $this->jwtService = app(JwtService::class);
        $this->request = request();
        $this->provider = $providerInstance;
    }

    public function user()
    {
        if ($this->user) {
            return $this->user;
        }

        $token = $this->getTokenForRequest();

        if (! $token) {
            return null;
        }

        try {
            $payload = $this->jwtService->decode($token);

            $this->user = $this->provider->retrieveById($payload->user_id);
        } catch (\Exception $e) {
            return null;
        }

        return $this->user;
    }

    public function validate(array $credentials = [])
    {
        return false;
    }

    protected function getTokenForRequest()
    {
        $token = $this->request->bearerToken();

        if (empty($token)) {
            $token = $this->request->query('token');

            if (is_array($token)) {
                $token = (string) array_shift($token);
            }
        }

        return $token;
    }
}
