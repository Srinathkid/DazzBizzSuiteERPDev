<?php

namespace App\Repositories\Contracts;

use App\Models\Designation;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface DesignationRepositoryInterface
{
    public function paginate(
        int $perPage = 20,
        ?string $search = null
    ): LengthAwarePaginator;

    public function findById(int $id): ?Designation;

    public function create(array $data): Designation;

    public function update(int $id, array $data): Designation;

    public function delete(int $id): bool;
}
