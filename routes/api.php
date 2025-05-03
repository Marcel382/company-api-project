<?php

declare(strict_types=1);

use Illuminate\Routing\Router;
use Infrastructure\Http\Controllers\CreateCompanyController;
use Infrastructure\Http\Controllers\UpdateCompanyController;
use Infrastructure\Http\Controllers\ListCompaniesController;
use Infrastructure\Http\Controllers\GetCompanyController;

/** @var Router $router */
$router->middleware([])->prefix('companies')->group(static function (Router $router): void {
    $router->post('/', CreateCompanyController::class);
    $router->patch('/{companyId}', UpdateCompanyController::class);
    $router->get('/', ListCompaniesController::class);
    $router->get('/{companyId}', GetCompanyController::class);
});
