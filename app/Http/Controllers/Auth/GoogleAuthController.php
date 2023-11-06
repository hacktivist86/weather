<?php

namespace App\Http\Controllers\Auth;
use App\Components\User\Services\AuthService;
use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;

class GoogleAuthController extends Controller
{
    public function __construct(private AuthService $authService)
    {
    }

    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        $this->authService->googleAuth();
        return redirect('/');
    }
}
