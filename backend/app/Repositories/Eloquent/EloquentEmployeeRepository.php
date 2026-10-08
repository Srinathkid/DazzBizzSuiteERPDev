<?php

namespace App\Repositories\Eloquent;

use App\Models\Employee;
use App\Repositories\Contracts\EmployeeRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class EloquentEmployeeRepository implements EmployeeRepositoryInterface
{
    public function __construct(private readonly Employee $model) {}

    public function findById(int $id): ?Employee
    {
        return $this->model->find($id);
    }

    public function getAll(): Collection
    {
        return $this->model->orderBy('id')->get();
    }

    public function paginate(int $perPage = 20, ?string $search = null): LengthAwarePaginator
    {
        $query = Employee::query();
        if($search!==null && $search !== ''){
            $query->where(function($q) use ($search){
                $q->where('employee_code', 'like', "%{$search}%")
                ->orWhere('first_name', 'like', "%{$search}%")
                ->orWhere('last_name', 'like', "%{$search}%")
                ->orWhere('email', 'like', "%{$search}%")
                ->orWhere('phone', 'like', "%{$search}%");
            });
        }
        return $query
            ->orderBy('id')
            ->paginate($perPage);
    }

    public function create(array $data): Employee
    {
        return $this->model->create($data);
    }

    public function update(Employee $employee, array $data): Employee
    {

        $employee->update($data);

        return $employee->fresh();
    }

    public function delete(Employee $employee): bool
    {
        return (bool) $employee->delete();
    }
}
