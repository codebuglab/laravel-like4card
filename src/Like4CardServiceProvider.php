<?php

namespace CodeBugLab\Like4Card;

use Illuminate\Support\ServiceProvider;
use CodeBugLab\Like4Card\Services\Like4CardAPI;
use CodeBugLab\Like4Card\Contracts\Like4CardInterface;

class Like4CardServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/config/like4card.php' => config_path('like4card.php'),
        ]);

        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
    }

    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/like4card.php', 'like4card');

        $this->app->bind(Like4CardInterface::class, function () {
            return new Like4CardAPI();
        });

    }
}
