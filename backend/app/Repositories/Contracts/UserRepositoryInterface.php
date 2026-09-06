<?php

namespace App\Repositories\Contracts;

use App\Models\User;

interface UserRepositoryInterface
{
    public function findById(int $id): ?User;

    public function findByUsername(string $username): ?User;
}
