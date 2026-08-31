<?php

namespace App\Repositories\Contracts;

interface RepositoryInterface
{
    public function all(): mixed;

    public function find(int $id): mixed;

    public function create(array $data): mixed;

    public function update(int $id, array $data): mixed;

    public function delete(int $id): mixed;
}
