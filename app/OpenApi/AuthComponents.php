<?php

namespace App\OpenApi;

use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: 'LoginRequest',
    required: ['email', 'password'],
    properties: [
        new OA\Property(
            property: 'email',
            type: 'string',
            format: 'email',
            example: 'admin@example.com'
        ),
        new OA\Property(
            property: 'password',
            type: 'string',
            format: 'password',
            example: 'SecurePassword123!'
        ),
    ]
)]
#[OA\Schema(
    schema: 'RefreshTokenRequest',
    required: ['refresh_token'],
    properties: [
        new OA\Property(
            property: 'refresh_token',
            type: 'string',
            example: 'plain-text-refresh-token'
        ),
    ]
)]
#[OA\Schema(
    schema: 'UpdateProfileRequest',
    properties: [
        new OA\Property(
            property: 'first_name',
            type: 'string',
            maxLength: 255,
            example: 'Updated Admin'
        ),
        new OA\Property(
            property: 'last_name',
            type: 'string',
            maxLength: 255,
            example: 'User'
        ),
        new OA\Property(
            property: 'avatar',
            description: 'JPG, JPEG, PNG or WebP. Maximum size: 2 MB.',
            type: 'string',
            format: 'binary'
        ),
    ]
)]
#[OA\Schema(
    schema: 'ChangePasswordRequest',
    required: [
        'current_password',
        'password',
        'password_confirmation',
    ],
    properties: [
        new OA\Property(
            property: 'current_password',
            type: 'string',
            format: 'password',
            example: 'CurrentPassword123!'
        ),
        new OA\Property(
            property: 'password',
            description: 'Minimum 8 characters with uppercase, lowercase, number and symbol.',
            type: 'string',
            format: 'password',
            example: 'NewSecurePassword456!'
        ),
        new OA\Property(
            property: 'password_confirmation',
            type: 'string',
            format: 'password',
            example: 'NewSecurePassword456!'
        ),
    ]
)]
#[OA\Schema(
    schema: 'AuthSuccessResponse',
    required: ['success', 'message', 'data'],
    properties: [
        new OA\Property(
            property: 'success',
            type: 'boolean',
            example: true
        ),
        new OA\Property(
            property: 'message',
            type: 'string',
            example: 'Authentication operation completed successfully.'
        ),
        new OA\Property(
            property: 'data',
            ref: '#/components/schemas/AuthData'
        ),
    ]
)]
#[OA\Schema(
    schema: 'UserSuccessResponse',
    required: ['success', 'message', 'data'],
    properties: [
        new OA\Property(
            property: 'success',
            type: 'boolean',
            example: true
        ),
        new OA\Property(
            property: 'message',
            type: 'string',
            example: 'User retrieved successfully.'
        ),
        new OA\Property(
            property: 'data',
            ref: '#/components/schemas/User'
        ),
    ]
)]
#[OA\Schema(
    schema: 'EmptySuccessResponse',
    required: ['success', 'message', 'data'],
    properties: [
        new OA\Property(
            property: 'success',
            type: 'boolean',
            example: true
        ),
        new OA\Property(
            property: 'message',
            type: 'string',
            example: 'Operation completed successfully.'
        ),
        new OA\Property(
            property: 'data',
            nullable: true,
            example: null
        ),
    ]
)]
final class AuthComponents {}
