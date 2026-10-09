<?php

namespace App\OpenApi;

use OpenApi\Attributes as OA;

final class AuthDocumentation
{
    #[OA\Post(
        path: '/api/admin/auth/login',
        operationId: 'authLogin',
        summary: 'Login to admin panel',
        tags: ['Authentication'],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                ref: '#/components/schemas/LoginRequest'
            )
        ),
        responses: [
            new OA\Response(
                response: 200,
                description: 'Login successful',
                content: new OA\JsonContent(
                    ref: '#/components/schemas/AuthSuccessResponse'
                )
            ),
            new OA\Response(
                response: 401,
                description: 'Invalid credentials',
                content: new OA\JsonContent(
                    ref: '#/components/schemas/AuthenticationError'
                )
            ),
            new OA\Response(
                response: 422,
                description: 'Validation error',
                content: new OA\JsonContent(
                    ref: '#/components/schemas/ValidationError'
                )
            )
        ]
    )]
    public function login(): void {}


    #[OA\Post(
        path: '/api/admin/auth/refresh',
        operationId: 'authRefresh',
        summary: 'Refresh authentication token',
        tags: ['Authentication'],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                ref: '#/components/schemas/RefreshTokenRequest'
            )
        ),
        responses: [
            new OA\Response(
                response: 200,
                description: 'Token refreshed successfully',
                content: new OA\JsonContent(
                    ref: '#/components/schemas/AuthSuccessResponse'
                )
            ),
            new OA\Response(
                response: 401,
                description: 'Invalid refresh token'
            )
        ]
    )]
    public function refresh(): void {}


    #[OA\Post(
        path: '/api/admin/auth/logout',
        operationId: 'authLogout',
        summary: 'Logout current user',
        tags: ['Authentication'],
        security: [
            ['sanctum' => []]
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: 'Logout successful',
                content: new OA\JsonContent(
                    ref: '#/components/schemas/EmptySuccessResponse'
                )
            ),
            new OA\Response(
                response: 401,
                description: 'Unauthenticated'
            )
        ]
    )]
    public function logout(): void {}


    #[OA\Get(
        path: '/api/admin/auth/me',
        operationId: 'authMe',
        summary: 'Get authenticated user',
        tags: ['Authentication'],
        security: [
            ['sanctum' => []]
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: 'User retrieved successfully',
                content: new OA\JsonContent(
                    ref: '#/components/schemas/UserSuccessResponse'
                )
            ),
            new OA\Response(
                response: 401,
                description: 'Unauthenticated'
            )
        ]
    )]
    public function me(): void {}


    #[OA\Patch(
        path: '/api/admin/auth/profile',
        operationId: 'authUpdateProfile',
        summary: 'Update profile',
        tags: ['Authentication'],
        security: [
            ['sanctum' => []]
        ],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\MediaType(
                mediaType: 'multipart/form-data',
                schema: new OA\Schema(
                    ref: '#/components/schemas/UpdateProfileRequest'
                )
            )
        ),
        responses: [
            new OA\Response(
                response: 200,
                description: 'Profile updated successfully',
                content: new OA\JsonContent(
                    ref: '#/components/schemas/UserSuccessResponse'
                )
            ),
            new OA\Response(
                response: 422,
                description: 'Validation error'
            )
        ]
    )]
    public function updateProfile(): void {}


    #[OA\Put(
        path: '/api/admin/auth/change-password',
        operationId: 'authChangePassword',
        summary: 'Change password',
        tags: ['Authentication'],
        security: [
            ['sanctum' => []]
        ],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                ref: '#/components/schemas/ChangePasswordRequest'
            )
        ),
        responses: [
            new OA\Response(
                response: 200,
                description: 'Password changed successfully',
                content: new OA\JsonContent(
                    ref: '#/components/schemas/EmptySuccessResponse'
                )
            ),
            new OA\Response(
                response: 422,
                description: 'Current password incorrect or validation failed'
            )
        ]
    )]
    public function changePassword(): void {}
}
