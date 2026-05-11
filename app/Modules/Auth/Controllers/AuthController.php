<?php

namespace App\Modules\Auth\Controllers;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Modules\Auth\DTOs\LoginDTO;
use App\Modules\Auth\DTOs\RegisterDTO;
use App\Modules\Auth\DTOs\ChangePasswordDTO;
use App\Modules\Auth\Requests\LoginRequest;
use App\Modules\Auth\Requests\RegisterRequest;
use App\Modules\Auth\Requests\ChangePasswordRequest;
use App\Modules\Auth\Services\AuthService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function __construct(
        private readonly AuthService $authService,
    ) {}
    public function register(RegisterRequest $request): JsonResponse
    {
        $result = $this->authService->register(
            RegisterDTO::fromArray($request->validated())
        );

        return ApiResponse::success(
            data: [
                'user'  => $result['user'],
                'token' => $result['token'],
            ],
            message: 'Admin registered successfully.',
            code: 201,
        );
    }


    public function login(LoginRequest $request): JsonResponse
    {
        $result = $this->authService->login(
            LoginDTO::fromArray($request->validated())
        );

        return ApiResponse::success(
            data: [
                'user'  => $result['user'],
                'token' => $result['token'],
            ],
            message: 'Login successful.',
            code: 200,
        );
    }


    public function logout(Request $request): JsonResponse
    {
        $this->authService->logout($request->user());

        return ApiResponse::success(
            message: 'Logged out successfully.',
        );
    }


    public function profile(Request $request): JsonResponse
    {
        $user = $this->authService->profile($request->user());

        return ApiResponse::success(
            data: $user,
            message: 'Profile retrieved successfully.',
        );
    }


    public function ChangePassword(ChangePasswordRequest $request): JsonResponse
    {
        $user = $this->authService->ChangePassword(
            $request->user(),
            ChangePasswordDTO::fromArray($request->validated()),
        );

        return ApiResponse::success(
            data: $user,
            message: 'Password updated successfully.',
        );
    }
}
