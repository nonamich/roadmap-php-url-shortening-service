<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\AuthenticateRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use App\Services\JwtService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ApiAuthController extends Controller
{
    public function __construct(private readonly JwtService $jwtService) {}

    public function register(RegisterRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return response()->json(['user' => $user], 201);
    }

    public function login(AuthenticateRequest $request)
    {
        $credentials = $request->only([
            'email',
            'password',
        ]);

        $isAuth = Auth::attempt($credentials);

        if (! $isAuth) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        $user = Auth::user();

        if (! $user) {
            return response()->json(['message' => 'User not found'], 401);
        }

        $token = $this->jwtService->encode($user);

        return response()->json(['token' => $token]);
    }

    public function logout()
    {
        // Implement logout logic if needed
    }
}
