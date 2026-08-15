<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Requests\TestValidationRequest;
use Illuminate\Http\JsonResponse;

class TestValidationController extends BaseApiController
{
    public function store(TestValidationRequest $request): JsonResponse
    {
        return $this->successResponse(
            $request->validated(),
            'Validation successful'
        );
    }
}
