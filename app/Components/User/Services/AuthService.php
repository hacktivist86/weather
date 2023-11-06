<?php

namespace App\Components\User\Services;

use App\Components\User\DTO\UserLoginData;
use App\Components\User\DTO\UserRegisterData;
use App\Components\User\Repositories\UserRepository;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Laravel\Socialite\Facades\Socialite;

class AuthService
{
    public function __construct(private UserRepository $userRepository)
    {
    }

    public function googleAuth(): void
    {
        try {
            $googleUser = Socialite::driver('google')->user();
            $user = User::where('google_id', $googleUser->id)->first();

            if (! $user) {
                $user = $this->userRepository->create([
                    'first_name' => $googleUser->name,
                    'email' => $googleUser->email,
                    'google_id' => $googleUser->id,
                    'password' => Hash::make('')
                ]);
                event(new Registered($user));
            }

            Auth::login($user);

        } catch (\Throwable $exception) {
            Log::error($exception->getMessage());
        }
    }

    public function apiRegister(UserRegisterData $userRegisterData): string
    {
        $user = $this->userRepository->create([
            'first_name' => $userRegisterData->name,
            'email' => $userRegisterData->email,
            'password' => Hash::make($userRegisterData->password),
        ]);
        event(new Registered($user));

        return $user->createToken($userRegisterData->token_name)->plainTextToken;
    }

    public function apiLogin(UserLoginData $userLoginData): ?string
    {
        $user = $this->userRepository->findOneBy(['email' => $userLoginData->email]);

        if (! $user || ! Hash::check($userLoginData->password, $user->password)) {
            return null;
        }

        return $user->createToken($userLoginData->token_name)->plainTextToken;
    }
}
