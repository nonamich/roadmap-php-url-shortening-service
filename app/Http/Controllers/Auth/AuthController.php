<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\AuthenticateRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\Link;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function authenticate(AuthenticateRequest $request): RedirectResponse
    {
        $credentials = $request->all([
            'email',
            'password',
        ]);
        $remember = $request->has('remember');

        if (auth()->attempt($credentials, $remember)) {
            $request->session()->regenerate();

            $count = Link::whereOwner()->count();
            $defaultIntended = $count ? '/links' : '/';

            return redirect()->intended($defaultIntended);

        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email', 'remember');
    }

    public function store(RegisterRequest $request)
    {
        $fields = $request->all([
            'name',
            'email',
            'password',
        ]);

        $user = User::create([
            'name' => $fields['name'],
            'email' => $fields['email'],
            'password' => Hash::make($fields['password']),
        ]);

        auth()->login($user);

        return redirect()->intended();
    }

    public function logout()
    {
        auth()->logout();

        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect('/');
    }

    public function create()
    {
        return view('pages.register');
    }

    public function login()
    {
        return view('pages.login');
    }
}
