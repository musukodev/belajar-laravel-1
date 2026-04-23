<?php

namespace App\Providers;

use App\Views\Composers\MenuComposer;
use Illuminate\Support\ServiceProvider;
use Illuminate\View\View;

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
        // view()->share('menu', [
        //     "Home" => "/",
        //     "About" => "/about",
        //     "Contact"=>"/contact"
        // ]);

        view()->composer(['movie.index', 'movie.show'], MenuComposer::class);
    }
}
