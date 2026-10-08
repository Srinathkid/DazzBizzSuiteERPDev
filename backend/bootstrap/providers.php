<?php

use App\Providers\AppServiceProvider;
use App\Providers\EmployeeRepositoryInterface;
use App\Providers\RepositoryServiceProvider;

return [
    AppServiceProvider::class,
    EmployeeRepositoryInterface::class,
    RepositoryServiceProvider::class,
];
