<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use App\Repositories\Contracts\RepositoryInterface;


class TestRepositoryController extends BaseAPIController
{
    public function index(
        RepositoryInterface $repository
    ): JsonResponse {
      return $this->successResponse([
        'repository' => get_class($repository),
      ], 'Repository layer test successfully.');
        
    }
}
