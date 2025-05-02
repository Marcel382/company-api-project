<?php

declare(strict_types=1);

use Infrastructure\Http\Controllers\CreateCompanyController;
use Illuminate\Routing\Router;

/** @var Router $router */
$router->middleware([])->prefix('companies')->group(static function (Router $router): void {
    $router->post('/', CreateCompanyController::class);
});
