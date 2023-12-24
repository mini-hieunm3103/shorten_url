<?php

namespace App\Providers;

use App\View\Components\Admin\Button;
use App\View\Components\Cannot;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;

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
        Blade::component('cannot', Cannot::class);
        Blade::component('admin-btn', Button::class);
    }
}
