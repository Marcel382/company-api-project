<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Domain\Model\CompanyRepository;
use Domain\SimpleUuidInterface;
use Infrastructure\Repositories\CompanyRepositoryUsesInMemory;
use Infrastructure\Support\SimpleUuidUsingRamsey;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->app->bind(CompanyRepository::class, CompanyRepositoryUsesInMemory::class);
        $this->app->bind(SimpleUuidInterface::class, SimpleUuidUsingRamsey::class);
    }
}
