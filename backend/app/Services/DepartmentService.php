<?php

namespace App\Services;

use App\Models\Department;
use App\Repositories\Contracts\DepartmentRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class DepartmentService
{
    public function __construct(private readonly DepartmentRepositoryInterface $departmentRepository) {}

    public function paginate(
        int $perPage = 20,
        ?string $search = null
    ): LengthAwarePaginator {
        return $this->departmentRepository->paginate($perPage, $search);
    }

    public function findById(int $id): ?Department
    {
        return $this->departmentRepository->findById($id);
    }

    public function create(array $data): Department
    {
        return $this->departmentRepository->create($data);
    }

    public function update(int $id, array $data): Department
    {
        return $this->departmentRepository->update($id, $data);
    }

    public function delete(int $id): bool
    {
        return $this->departmentRepository->delete($id);
    }
}
