<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\Contracts\RepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class UserRepository implements RepositoryInterface
{
    public function all(): Collection
    {
        return User::all();
    }

    public function find(int $id): ?User
    {
        return User::find($id);
    }

    public function create(array $data): User
    {
        return User::create($data);
    }

    public function update(int $id, array $data): ?User
    {
        $user = User::find($id);
        if ($user) {
            $user->update($data);

            return $user->fresh();
        }

        return null;
    }

    public function delete(int $id): bool
    {
        $user = User::find($id);
        if ($user) {
            return (bool) $user->delete();
        }

        return false;
    }
}
