<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;
use App\Http\Resources\EmployeeResource;
use App\Models\Employee;
use App\Services\EmployeeService;
use App\Support\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function __construct(private readonly EmployeeService $employeeService) {}

    public function index(Request $request): JsonResponse
    {
        // $perPage = (int) $request->input('per_page', 20);
        $perPage = min(max((int) $request->input('per_page', 20), 1), 100);

        $search = trim((string) $request->input('search', ''));

        $employees = $this->employeeService->paginate($perPage, $search !== '' ? $search : null);

        return ApiResponse::success('Employees retirved successfully.',
            [
                'employees' => EmployeeResource::collection($employees->items()),
                'pagination' => [
                    'current_page' => $employees->currentPage(),
                    'per_page' => $employees->perPage(),
                    'total' => $employees->total(),
                    'last_page' => $employees->lastPage(),
                ],
            ]
        );
    }

    public function store(StoreEmployeeRequest $request): JsonResponse
    {
        $employee = $this->employeeService->create($request->validated());

        return ApiResponse::success(
            'Employee created successfully.',
            [
                'employee' => new EmployeeResource($employee),
            ],
            201
        );
    }

    public function show(Employee $employee): JsonResponse
    {
        return ApiResponse::success(
            'Employee retrieved successfully.',
            ['employee' => new EmployeeResource($employee)]
        );
    }

    public function update(
        UpdateEmployeeRequest $request,
        Employee $employee
    ): JsonResponse {
        $employee = $this->employeeService->update(
            $employee,
            $request->validated()
        );

        return ApiResponse::success(
            'Employee updated successfully.',
            [
                'employee' => new EmployeeResource($employee),
            ]
        );

    }

    public function destroy(Employee $employee): JsonResponse
    {

        $this->employeeService->delete($employee);

        return ApiResponse::success(
            'Employee deleted successfully.',
            null
        );
    }
}
