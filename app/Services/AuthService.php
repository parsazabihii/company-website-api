<?php

namespace App\Services;

use App\Models\RefreshToken;
use App\Models\User;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Throwable;

class AuthService
{
    private const ACCESS_TOKEN_EXPIRES_IN_MINUTES = 30;

    private const REFRESH_TOKEN_EXPIRES_IN_DAYS = 15;

    public function login(array $data): array
    {
        $user = User::query()
            ->with('role.permissions')
            ->where('email', $data['email'])
            ->first();

        if ($user === null || ! Hash::check($data['password'], $user->password)) {
            throw new AuthenticationException('Invalid credentials.');
        }

        if (! $user->is_active || $user->role === null) {
            throw new AuthenticationException('Invalid credentials.');
        }

        return DB::transaction(function () use ($user): array {
            $user->update([
                'last_login_at' => now(),
            ]);

            return $this->createTokenPair($user);
        });
    }

    public function refresh(string $plainTextRefreshToken): array
    {
        $tokenHash = $this->hashRefreshToken($plainTextRefreshToken);

        $tokenPair = DB::transaction(function () use ($tokenHash): ?array {
            $refreshToken = RefreshToken::query()
                ->with('user.role.permissions')
                ->where('token', $tokenHash)
                ->lockForUpdate()
                ->first();

            if ($refreshToken === null) {
                return null;
            }

            if ($refreshToken->isExpired()) {
                $refreshToken->delete();

                return null;
            }

            $user = $refreshToken->user;

            if (! $user->is_active || $user->role === null) {
                $refreshToken->delete();

                return null;
            }

            $refreshToken->delete();

            return $this->createTokenPair($user);
        });

        if ($tokenPair === null) {
            throw new AuthenticationException('Invalid or expired refresh token.');
        }

        return $tokenPair;
    }

    public function logout(User $user, string $plainTextRefreshToken): void
    {
        $tokenHash = $this->hashRefreshToken($plainTextRefreshToken);

        DB::transaction(function () use ($user, $tokenHash): void {
            $refreshToken = $user->refreshTokens()
                ->where('token', $tokenHash)
                ->lockForUpdate()
                ->first();

            if ($refreshToken === null) {
                throw ValidationException::withMessages([
                    'refresh_token' => ['The refresh token is invalid.'],
                ]);
            }

            $refreshToken->delete();
            $user->currentAccessToken()?->delete();
        });
    }

    public function getAuthenticatedUser(User $user): User
    {
        return $user->loadMissing('role.permissions');
    }

    public function updateProfile(User $user, array $data): User
    {
        $attributes = Arr::only($data, [
            'first_name',
            'last_name',
        ]);

        $oldAvatarPath = $user->avatar;
        $newAvatarPath = null;

        if (
            array_key_exists('avatar', $data)
            && $data['avatar'] instanceof UploadedFile
        ) {
            $newAvatarPath = $data['avatar']->store('avatars', 'public');
            $attributes['avatar'] = $newAvatarPath;
        }

        try {
            DB::transaction(function () use ($user, $attributes): void {
                $user->update($attributes);
            });
        } catch (Throwable $exception) {
            if ($newAvatarPath !== null) {
                Storage::disk('public')->delete($newAvatarPath);
            }

            throw $exception;
        }

        if ($newAvatarPath !== null && $oldAvatarPath !== null) {
            Storage::disk('public')->delete($oldAvatarPath);
        }

        return $user->refresh()->load('role.permissions');
    }

    public function changePassword(User $user, array $data): void
    {
        if (! Hash::check($data['current_password'], $user->password)) {
            throw ValidationException::withMessages([
                'current_password' => ['The current password is incorrect.'],
            ]);
        }

        DB::transaction(function () use ($user, $data): void {
            $user->update([
                'password' => $data['password'],
            ]);

            $user->tokens()->delete();
            $user->refreshTokens()->delete();
        });
    }

    private function createTokenPair(User $user): array
    {
        $accessTokenExpiresAt = now()->addMinutes(
            self::ACCESS_TOKEN_EXPIRES_IN_MINUTES
        );

        $refreshTokenExpiresAt = now()->addDays(
            self::REFRESH_TOKEN_EXPIRES_IN_DAYS
        );

        $accessToken = $user
            ->createToken(
                'admin-access-token',
                ['*'],
                $accessTokenExpiresAt
            )
            ->plainTextToken;

        $plainTextRefreshToken = Str::random(64);

        $user->refreshTokens()->create([
            'token' => $this->hashRefreshToken($plainTextRefreshToken),
            'expires_at' => $refreshTokenExpiresAt,
        ]);

        return [
            'access_token' => $accessToken,
            'access_token_expires_at' => $accessTokenExpiresAt->toISOString(),
            'refresh_token' => $plainTextRefreshToken,
            'refresh_token_expires_at' => $refreshTokenExpiresAt->toISOString(),
            'user' => $user,
        ];
    }

    private function hashRefreshToken(string $plainTextToken): string
    {
        return hash('sha256', $plainTextToken);
    }
}
