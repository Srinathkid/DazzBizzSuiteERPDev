<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

class HealthController extends Controller
{
    /**
     * Check API Health.
     */
    public function index(): JsonResponse
    {
        return response()->json([
            'success' => true,
            'message' => 'DazzBizzSuite ERP API is running successfully.',
            'data' => [
                'version' => 'v1',
                'environment' => app()->environment(),
            ],

        ]);
    }
}
