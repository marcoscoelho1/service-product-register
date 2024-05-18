<?php

namespace App\Providers;

use App\Modules\Category\Domain\Repositories\ICategoryRepository;
use App\Modules\Category\Infra\Repositories\CategoryRepository;
use App\Modules\Products\Infra\Repositories\ProductsRepository;
use App\Modules\Products\Domain\Repositories\IProductsRepository;
use App\Modules\Users\Domain\Repositories\IUsersRepository;
use App\Modules\Users\Infra\Repositories\UsersRepository;
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
        $this->app->bind(IUsersRepository::class, UsersRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
