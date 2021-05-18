<?php

namespace Akhaled\Like4Card;

use Illuminate\Support\ServiceProvider;

class Like4CardServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/config/like4card.php' => config_path('like4card.php'),
        ]);
    }

    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/like4card.php', 'like4card');

        $this->app->bind(Like4CardInterface::class, function () {
            return new Like4Card();
        });
    }
}
