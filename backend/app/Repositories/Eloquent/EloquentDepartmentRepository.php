<?php

namespace App\Repositories\Eloquent;

use App\Models\Department;
use App\Repositories\Contracts\DepartmentRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class EloquentDepartmentRepository implements DepartmentRepositoryInterface
{
    public function __construct(private readonly Department $model) {}

    public function paginate(
        int $perPage = 20,
        ?string $search = null
    ): LengthAwarePaginator {
        $query = $this->model->newQuery();

        if ($search !== null && $search !== '') {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('code', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            });
        }

        return $query->orderBy('id')->paginate($perPage);
    }

    public function findById(int $id): ?Department
    {
        return $this->model->newQuery()->find($id);
    }

    public function create(array $data): Department
    {
        return $this->model->create($data);
    }

    public function update(int $id, array $data): Department
    {
        $department = $this->model->newQuery()->findOrFail($id);
        $department->update($data);

        return $department->refresh();
    }

    public function delete(int $id): bool
    {
        $department = $this->model->newQuery()->findOrFail($id);

        return (bool) $department->delete();
    }
}
