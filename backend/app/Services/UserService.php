<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\Contracts\UserRepositoryInterface;

class UserService
{
    public function __construct(
        private readonly UserRepositoryInterface $userRepository
    ) {}

    public function findById(int $id): ?User
    {
        return $this->userRepository->findById($id);
    }
}
