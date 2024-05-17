<?php

namespace App\Providers;

use App\Modules\Category\Domain\Repositories\ICategoryRepository;
use App\Modules\Category\Infra\Repositories\CategoryRepository;
use App\Modules\Products\Infra\Repositories\ProductsRepository;
use App\Modules\Products\Domain\Repositories\IProductsRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
        $this->app->bind(ICategoryRepository::class, CategoryRepository::class);
        $this->app->bind(IProductsRepository::class, ProductsRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
