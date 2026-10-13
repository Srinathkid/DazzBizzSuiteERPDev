<?php

namespace App\Repositories\Contracts;

use App\Models\Employee;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

interface EmployeeRepositoryInterface
{
    public function findById(int $id): ?Employee;

    public function getAll(): Collection;

    public function paginate(int $perPage = 20, ?string $search = null): LengthAwarePaginator;

    public function create(array $data): Employee;

    public function update(Employee $employee, array $data): Employee;

    public function delete(Employee $employee): bool;
}
