<?php

namespace AKhaled\Like4Card;

use Illuminate\Support\ServiceProvider;

class Like4CardServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            // Config file.
            __DIR__ . '/config/like4card.php' => config_path('like4card.php'),
        ]);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
    }
}
