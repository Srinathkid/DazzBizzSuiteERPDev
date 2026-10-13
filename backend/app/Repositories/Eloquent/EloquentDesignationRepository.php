<?php

namespace App\Repositories\Eloquent;

use App\Models\Designation;
use App\Repositories\Contracts\DesignationRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;

class EloquentDesignationRepository implements DesignationRepositoryInterface
{
    public function __construct(private readonly Designation $model) {}

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

        return $query->orderByDesc('id')->paginate($perPage);
    }

    public function findById(int $id): ?Designation
    {
        return $this->model->newQuery()->find($id);
    }

    public function create(array $data): Designation
    {
        return $this->model->create($data);
    }

    public function update(int $id, array $data): Designation
    {
        $designation = $this->model->newQuery()->findOrFail($id);
        $designation->update($data);

        return $designation->refresh();
    }

    public function delete(int $id): bool
    {
        $designation = $this->model->newQuery()->findOrFail($id);

        return (bool) $designation->delete();
    }
}
