<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ChangePasswordRequest;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\LogoutRequest;
use App\Http\Requests\Auth\RefreshTokenRequest;
use App\Http\Requests\Auth\UpdateProfileRequest;
use App\Http\Resources\AuthResource;
use App\Http\Resources\UserResource;
use App\Services\AuthService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function __construct(
        private readonly AuthService $authService
    ) {}

    public function login(LoginRequest $request): JsonResponse
    {
        $authData = $this->authService->login(
            $request->validated()
        );

        return $this->successResponse(
            'Login successful.',
            AuthResource::make($authData)->resolve($request)
        );
    }

    public function refresh(RefreshTokenRequest $request): JsonResponse
    {
        $authData = $this->authService->refresh(
            $request->validated('refresh_token')
        );

        return $this->successResponse(
            'Token refreshed successfully.',
            AuthResource::make($authData)->resolve($request)
        );
    }

    public function logout(LogoutRequest $request): JsonResponse
    {
        $this->authService->logout(
            $request->user(),
            $request->validated('refresh_token')
        );

        return $this->successResponse(
            'Logout successful.'
        );
    }

    public function me(Request $request): JsonResponse
    {
        $user = $this->authService->getAuthenticatedUser(
            $request->user()
        );

        return $this->successResponse(
            'Authenticated user retrieved successfully.',
            UserResource::make($user)->resolve($request)
        );
    }

    public function updateProfile(
        UpdateProfileRequest $request
    ): JsonResponse {
        $user = $this->authService->updateProfile(
            $request->user(),
            $request->validated()
        );

        return $this->successResponse(
            'Profile updated successfully.',
            UserResource::make($user)->resolve($request)
        );
    }

    public function changePassword(
        ChangePasswordRequest $request
    ): JsonResponse {
        $this->authService->changePassword(
            $request->user(),
            $request->validated()
        );

        return $this->successResponse(
            'Password changed successfully.'
        );
    }

    private function successResponse(string $message, mixed $data = null): JsonResponse {
        return response()->json([
            'success' => true,
            'message' => $message,
            'data' => $data,
        ]);
    }
}
