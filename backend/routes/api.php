<?php

use App\Http\Controllers\API\V1\AuthController;
use App\Http\Controllers\API\V1\DepartmentController;
use App\Http\Controllers\API\V1\DesignationController;
use App\Http\Controllers\API\V1\EmployeeController;
use App\Http\Controllers\API\V1\HealthController;
use App\Http\Controllers\API\V1\TestRepositoryController;
use App\Http\Controllers\API\V1\TestValidationController;
use App\Http\Controllers\API\V1\UserController;
use App\Support\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
*/

Route::prefix('v1')->group(function () {
    Route::get('/health', [HealthController::class, 'index']);
    Route::post('/test-validation', [TestValidationController::class, 'store']);
    Route::get('/test-repository', [TestRepositoryController::class, 'index']);

    // Auth Routes
    Route::post('/login', [AuthController::class, 'login']);

    Route::middleware('auth:sanctum')->group(function () {
        Route::get('/me', [AuthController::class, 'me']);
        Route::get('/auth-test', function () {
            return response()->json([
                'success' => true,
                'message' => 'Authentication successful.',
                /*'data' => [
                    'user_id' => $request->user()->id,
                    'username' => $request->user()->username,
                ],*/
            ]);
        });
        Route::post('/logout', [AuthController::class, 'logout']);
    });

    Route::middleware(['auth:sanctum', 'permission:sales.create'])
        ->get('/test-permission', function () {
            return ApiResponse::success('Permission check successful.');
        });

    // User Routes
    Route::middleware('auth:sanctum')->group(function () {
        Route::get('/users/{id}', [UserController::class, 'show']);
    });

    Route::middleware('auth:sanctum')->group(function () {
        // Route::apiResource('employees', EmployeeController::class);
        // Employee Routes
        Route::get('/employees', [EmployeeController::class, 'index'])
            ->middleware('permission:employees.view');

        Route::post('/employees', [EmployeeController::class, 'store'])
            ->middleware('permission:employees.create');

        Route::get('/employees/{employee}', [EmployeeController::class, 'show'])
            ->middleware('permission:employees.view');

        Route::put('/employees/{employee}', [EmployeeController::class, 'update'])
            ->middleware('permission:employees.update');

        Route::delete('/employees/{employee}', [EmployeeController::class, 'destroy'])
            ->middleware('permission:employees.delete');

        // Department Routes
        Route::get('/department-auth-test', function (Request $request) {
            return response()->json([
                'authenticated' => $request->user() !== null,
                'user_id' => $request->user()?->id,
                'session_id' => $request->session()->getId(),
            ]);
        });

        Route::get('/departments', [DepartmentController::class, 'index'])
            ->middleware('permission:departments.view');

        Route::post('/departments', [DepartmentController::class, 'store'])
            ->middleware('permission:departments.create');

        Route::get('/departments/{department}', [DepartmentController::class, 'show'])
            ->middleware('permission:departments.view');

        Route::put('/departments/{department}', [DepartmentController::class, 'update'])
            ->middleware('permission:departments.update');

        Route::delete('/departments/{department}', [DepartmentController::class, 'destroy'])
            ->middleware('permission:departments.delete');

        // Designation Routes
        Route::get('/designations', [DesignationController::class, 'index'])
            ->middleware('permission:designations.view');

        Route::post('/designations', [DesignationController::class, 'store'])
            ->middleware('permission:designations.create');

        Route::get('/designations/{designation}', [DesignationController::class, 'show'])
            ->middleware('permission:designations.view');

        Route::put('/designations/{designation}', [DesignationController::class, 'update'])
            ->middleware('permission:designations.update');

        Route::delete('/designations/{designation}', [DesignationController::class, 'destroy'])
            ->middleware('permission:designations.delete');

    });

    // Route::middleware('auth:sanctum')
    /* Route::get('/test-permission', function () {
         return response()->json([
             'success' => true,
             'message' => 'Auth middleware successful.',
             'data' => null,
         ]);
     });*/

});
