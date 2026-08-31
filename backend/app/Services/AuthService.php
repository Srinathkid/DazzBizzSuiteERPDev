<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthService
{
    public function login(string $username, string $password): User
    {
        if (! Auth::guard('web')->attempt([
            'username' => $username,
            'password' => $password,
        ])) {
            throw ValidationException::withMessages([
                'username' => ['The provided credentials are incorrect.'],
            ]);
        }

        $user = Auth::guard('web')->user();

        return $user;
    }

    public function logout(): void
    {
        Auth::guard('web')->logout();
    }

    public function user(): ?User
    {
        return Auth::guard('web')->user();
    }
}
