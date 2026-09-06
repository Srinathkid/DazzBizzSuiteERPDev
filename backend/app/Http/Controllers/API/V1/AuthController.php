<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Requests\LoginRequest;
use App\Http\Resources\UserResource;
use App\Services\AuthService;
use App\Support\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AuthController extends BaseApiController
{
    public function __construct(private readonly AuthService $authService) {}

    public function login(LoginRequest $request): JsonResponse
    {
        $user = $this->authService->login(
            $request->input('username'),
            $request->input('password'),
        );

        $request->session()->regenerate();

        return ApiResponse::success(
            'Login Successful',
            [
                'user' => new UserResource($user),
            ]
        );
    }

    public function me(Request $request): JsonResponse
    {
        /*return response()->json([
            'success' => true,
            'message' => 'Authenticated User',
            'data' => [
                'user' => $request->user(),
            ],
        ]);*/

        return ApiResponse::success(
            'Authenticated User',
            ['user' => new UserResource($request->user())]

        );

    }

    public function logout(Request $request): JsonResponse
    {
        $this->authService->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return response()->json([
            'success' => true,
            'message' => 'Logout Successful',
            'data' => null,
        ]);

    }
}
