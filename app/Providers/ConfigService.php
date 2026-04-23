<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ConfigService extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $config = [
            "framework"=>"laravel",
            "service"=>[
                "web_server"=>"apache2",
                "mail_server"=>"postfix"
            ]
        ];
        view()->share('config', $config);
    }
}
