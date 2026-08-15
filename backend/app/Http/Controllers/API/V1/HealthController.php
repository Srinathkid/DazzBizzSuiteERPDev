<?php

namespace App\Http\Controllers\API\V1;

use Illuminate\Http\JsonResponse;

class HealthController extends BaseApiController
{
    /**
     * Check API Health.
     */
    public function index(): JsonResponse
    {
        return $this->successResponse([
            'version' => 'v1',
            'environment' => app()->environment(),
        ],
            'DazzBizzSuiteERP API is running',
        );
    }
}
