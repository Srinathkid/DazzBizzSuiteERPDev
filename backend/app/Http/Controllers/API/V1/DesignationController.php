<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDesignationRequest;
use App\Http\Requests\UpdateDesignationRequest;
use App\Http\Resources\DesignationResource;
use App\Services\DesignationService;
use App\Support\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class DesignationController extends Controller
{
    public function __construct(
        private readonly DesignationService $designationService
    ) {}

    public function index(Request $request): JsonResponse
    {
        $perPage = min(max((int) $request->input('per_page', 20), 1), 100);
        $search = trim((string) $request->input('search', ''));

        $designations = $this->designationService->paginate(
            $perPage,
            $search !== '' ? $search : null
        );

        return ApiResponse::success(
            'Designations retrieved successfully.',
            [
                'designations' => DesignationResource::collection(
                    $designations->items()
                ),
                'pagination' => [
                    'current_page' => $designations->currentPage(),
                    'per_page' => $designations->perPage(),
                    'total' => $designations->total(),
                    'last_page' => $designations->lastPage(),
                ],
            ]
        );
    }

    public function store(StoreDesignationRequest $request): JsonResponse
    {
        $designation = $this->designationService->create(
            $request->validated()
        );

        return ApiResponse::success(
            'Designation created successfully.',
            ['designation' => new DesignationResource($designation)]
        );
    }

    public function show(int $designation): JsonResponse
    {
        $record = $this->designationService->findById($designation);

        if (! $record) {
            return ApiResponse::error('Designation not found.', 404);
        }

        return ApiResponse::success(
            'Designation retrieved successfully.',
            ['designation' => new DesignationResource($record)]
        );
    }

    public function update(
        UpdateDesignationRequest $request,
        int $designation
    ): JsonResponse {
        $existing = $this->designationService->findById($designation);

        if (! $existing) {
            return ApiResponse::error('Designation not found.', 404);
        }

        $record = $this->designationService->update(
            $designation,
            $request->validated()
        );

        return ApiResponse::success(
            'Designation updated successfully.',
            ['designation' => new DesignationResource($record)]
        );
    }

    public function destroy(int $designation): JsonResponse
    {
        $existing = $this->designationService->findById($designation);

        if (! $existing) {
            return ApiResponse::error('Designation not found.', 404);
        }

        $this->designationService->delete($designation);

        return ApiResponse::success('Designation deleted successfully.', null);
    }
}
