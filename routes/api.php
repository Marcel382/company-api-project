<?php

declare(strict_types=1);

use Infrastructure\Http\Controllers\CreateCompanyController;
use Illuminate\Routing\Router;
use Infrastructure\Http\Controllers\UpdateCompanyController;

/** @var Router $router */
$router->middleware([])->prefix('companies')->group(static function (Router $router): void {
    $router->post('/', CreateCompanyController::class);
    $router->patch('/{companyId}', UpdateCompanyController::class);
});
