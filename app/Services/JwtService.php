<?php

namespace App\Services;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Illuminate\Contracts\Auth\Authenticatable;

class JwtService
{
    protected const EXPIRED_IN_SEC = 60 * 60;

    protected const ALGORITHM = 'HS256';

    private string $secret;

    public function __construct()
    {
        $this->secret = (string) config('auth.jwt_secret');
    }

    public function encode(Authenticatable $user)
    {
        return JWT::encode(
            $this->createPayload($user),
            $this->secret,
            static::ALGORITHM
        );
    }

    public function createPayload(Authenticatable $user)
    {
        $timestamp = time();

        return [
            'user_id' => $user->getAuthIdentifier(),
            'iat' => $timestamp,
            'exp' => $timestamp + static::EXPIRED_IN_SEC,
        ];
    }

    public function decode(string $token)
    {
        $payload = JWT::decode(
            $token,
            new Key($this->secret, static::ALGORITHM),
        );

        return $payload;
    }
}
