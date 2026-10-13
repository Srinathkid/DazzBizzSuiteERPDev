<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDepartmentRequest;
use App\Http\Requests\UpdateDepartmentRequest;
use App\Http\Resources\DepartmentResource;
use App\Services\DepartmentService;
use App\Support\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function __construct(
        private readonly DepartmentService $departmentService
    ) {}

    public function index(Request $request): JsonResponse
    {
        $perPage = min(max((int) $request->input('per_page', 20), 1), 100);

        $search = trim((string) $request->input('search', ''));

        $departments = $this->departmentService->paginate($perPage, $search !== '' ? $search : null);

        return ApiResponse::success(
            'Departments retrieved successfully',
            [
                'departments' => DepartmentResource::collection($departments->items()),
                'pagination' => [
                    'current_page' => $departments->currentpage(),
                    'per-page' => $departments->perPage(),
                    'total' => $departments->total(),
                    'last_page' => $departments->lastPage(),
                ],
            ]
        );
    }

    public function store(StoreDepartmentRequest $request): JsonResponse
    {
        $department = $this->departmentService->create($request->validated());

        return ApiResponse::success(
            'Department created successfully',
            [
                'department' => new DepartmentResource($department),
            ]
        );
    }

    public function show(int $department): JsonResponse
    {
        $record = $this->departmentService->findById($department);

        if (! $record) {
            return ApiResponse::error('Department not found', 404);
        }

        return ApiResponse::success(
            'Department retrieved successfully',
            [
                'department' => new DepartmentResource($record),
            ]
        );
    }

    public function update(
        UpdateDepartmentRequest $request, int $department
    ): JsonResponse {
        $existing = $this->departmentService->findById($department);

        if (! $existing) {
            return ApiResponse::error('Department not found', 404);
        }

        $record = $this->departmentService->update($department, $request->validated());

        return ApiResponse::success(
            'Department updated successfully.',
            [
                'department' => new DepartmentResource($record),
            ]
        );
    }

    public function destroy(int $department): JsonResponse
    {
        $existing = $this->departmentService->findById($department);
        if (! $existing) {
            return ApiResponse::error('Department not found', 404);
        }

        $this->departmentService->delete($department);

        return ApiResponse::success('Department deleted successfully', null);
    }
}
