<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Resources\UserResource;
use App\Support\ApiResponse;
use Illuminate\Http\JsonResponse;
use App\Services\UserService;
class UserController extends BaseApiController
{
    public function __construct(
        private readonly UserService $userService
    ) {}

    public function show(int $id): JsonResponse
    {
        $user = $this->userService->findById($id);

        if (! $user) {
            return ApiResponse::error('User not found.', null, 404);
        }

        return ApiResponse::success('User retrived successfully.', ['user' => new UserResource($user)]);

    }
}
