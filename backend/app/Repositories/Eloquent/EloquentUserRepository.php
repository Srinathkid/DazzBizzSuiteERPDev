<?php

namespace App\Repositories\Eloquent;

use App\Models\User;
use App\Repositories\Contracts\UserRepositoryInterface;
use Override;

class EloquentUserRepository implements UserRepositoryInterface
{
    #[Override]
    public function findById(int $id): ?User
    {
        return User::find($id);
    }

    #[Override]
    public function findByUsername(string $username): ?User
    {
        return User::where('username', $username)->first();
    }
}
