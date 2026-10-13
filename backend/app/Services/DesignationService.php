<?php

namespace App\Services;

use App\Models\Designation;
use App\Repositories\Contracts\DesignationRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;

class DesignationService
{
    public function __construct(
        private readonly DesignationRepositoryInterface $designationRepository
    ) {}

    public function paginate(
        int $perPage = 20,
        ?string $search = null
    ): LengthAwarePaginator {
        return $this->designationRepository->paginate($perPage, $search);
    }

    public function findById(int $id): ?Designation
    {
        return $this->designationRepository->findById($id);
    }

    public function create(array $data): Designation
    {
        return $this->designationRepository->create($data);
    }

    public function update(int $id, array $data): Designation
    {
        return $this->designationRepository->update($id, $data);
    }

    public function delete(int $id): bool
    {
        return $this->designationRepository->delete($id);
    }
}
