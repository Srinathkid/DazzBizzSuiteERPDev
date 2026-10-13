<?php

namespace App\Repositories\Contracts;

use App\Models\Department;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface DepartmentRepositoryInterface
{
    public function paginate(
        int $perPage = 20,
        ?string $search = null,
    ): LengthAwarePaginator;

    public function findById(int $id): ?Department;

    public function create(array $data): Department;

    public function update(int $id, array $data): Department;

    public function delete(int $id): bool;
}
