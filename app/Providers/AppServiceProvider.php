<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Contracts\Support\DeferrableProvider;
use App\Http\Controllers\Repositories\CategoryRepository;
use App\Http\Controllers\Repositories\ProjectRepository;
use App\Models\Category;
use App\Models\Project;

class AppServiceProvider extends ServiceProvider implements DeferrableProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(CategoryRepository::class, function () {
            return new CategoryRepository(new Category());
        });
        $this->app->bind(ProjectRepository::class, function () {
            return new ProjectRepository(new Project());
        });
    }

    public function provides()
    {
        return [
            CategoryRepository::class,
            ProjectRepository::class,
        ];
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();
    }
}
