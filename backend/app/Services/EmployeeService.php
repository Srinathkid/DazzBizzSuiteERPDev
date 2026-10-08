<?php

namespace App\Services;

use App\Models\Employee;
use App\Repositories\Contracts\EmployeeRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class EmployeeService
{
    public function __construct(private readonly EmployeeRepositoryInterface $employeeRepository) {}

    public function findById(int $id): ?Employee
    {
        return $this->employeeRepository->findById($id);
    }

    public function getAll(): Collection
    {
        return $this->employeeRepository->getAll();
    }

    public function paginate(int $perPage = 20, ?string $search = null): LengthAwarePaginator
    {
        return $this->employeeRepository->paginate($perPage, $search);
    }

    public function create(array $data): Employee
    {
        return $this->employeeRepository->create($data);
    }

    public function update(Employee $employee, array $data): Employee
    {
        return $this->employeeRepository->update($employee, $data);
    }

    public function delete(Employee $employee): bool
    {
        return $this->employeeRepository->delete($employee);
    }
}
