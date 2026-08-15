<?php

use App\Http\Controllers\API\V1\HealthController;
use App\Http\Controllers\API\V1\TestValidationController;
use App\Http\Controllers\API\V1\TestServiceController;
use App\Http\Controllers\API\V1\TestRepositoryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Log;
/*
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
*/

Route::prefix('v1')->group(function () {
    Route::get('/health', [HealthController::class, 'index']);
    Route::post('/test-validation', [TestValidationController::class, 'store']);
    Route::get('/test-repository', [TestRepositoryController::class, 'index']);


});
