<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Domain\Model\CompanyRepository;
use Infrastructure\Repositories\CompanyRepositoryUsesInMemory;
use Infrastructure\Support\SimpleUuidFactoryUsingRamsey;
use Infrastructure\Support\SimpleUuidUsingRamsey;
use Domain\SimpleUuidFactory;
use Domain\SimpleUuidInterface;

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
        $this->app->bind(SimpleUuidFactory::class, SimpleUuidFactoryUsingRamsey::class);
        $this->app->bind(SimpleUuidInterFace::class, SimpleUuidUsingRamsey::class);
    }
}
