<?php

use App\Http\Controllers\API\V1\AuthController;
use App\Http\Controllers\API\V1\HealthController;
use App\Http\Controllers\API\V1\TestRepositoryController;
use App\Http\Controllers\API\V1\TestValidationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Support\ApiResponse;
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

    //Route::middleware('auth:sanctum')
   /* Route::get('/test-permission', function () {
        return response()->json([
            'success' => true,
            'message' => 'Auth middleware successful.',
            'data' => null,
        ]);
    });*/

});
