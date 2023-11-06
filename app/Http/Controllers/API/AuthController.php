<?php

namespace App\Http\Controllers\API;

use App\Components\User\DTO\UserLoginData;
use App\Components\User\DTO\UserRegisterData;
use App\Components\User\Services\AuthService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\LoginRequest;
use App\Http\Requests\Api\RegisterRequest;
use Illuminate\Http\JsonResponse;

class AuthController extends Controller
{
    public function __construct(private AuthService $authService)
    {
    }

    public function register(RegisterRequest $request): JsonResponse
    {
        $token = $this->authService->apiRegister(UserRegisterData::from($request->all()));

        return response()->json(['token' => $token]);
    }

    public function login(LoginRequest $request): JsonResponse
    {
        $token = $this->authService->apiLogin(UserLoginData::from($request->all()));

        if (! $token) {
            return response()->json(['error' => 'The provided credentials are incorrect.'], 401);
        }

        return response()->json(['token' => $token]);
    }
}
