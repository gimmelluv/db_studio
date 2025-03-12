<?php

namespace App\Providers;

use App\Models\Diagram;
use App\Policies\DiagramPolicy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;

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
        Model::unguard();

        // Регистрация политики
        $this->registerPolicies();
    }

     /**
     * Register the application's policies.
     */
    protected function registerPolicies(): void
    {
        //
    }
}
