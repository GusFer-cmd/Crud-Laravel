<?php

namespace App\Providers;

use App\Factories\EloquentEntityFactory;
use App\Factories\Interfaces\IEntityFactory;
use App\Repositories\Eloquent\StudentRepository;
use App\Repositories\Interface\IStudentRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->registerRepositories();
        $this->registerFactories();
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }

    public function registerRepositories()
    {
        $this->app->bind(
            IStudentRepository::class,
            StudentRepository::class
        );
    }

    public function registerFactories()
    {
        $this->app->bind(
            IEntityFactory::class,
            EloquentEntityFactory::class
        );
    }
}