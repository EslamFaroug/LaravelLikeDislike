<?php

namespace EslamFaroug\LaravelLikeDislike;

use Eslamfaroug\LaravelLikeDislike\Repositories\LikeSystemRepository;
use Eslamfaroug\LaravelLikeDislike\Services\LikeSystemService;
use Illuminate\Support\ServiceProvider;

class LikeSystemServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('like-system', function ($app) {
            return new LikeSystemService(new LikeSystemRepository());
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        // Publish migration
        $this->publishes([
            __DIR__.'/../database/migrations' => database_path('migrations'),
        ], 'migrations');

        // Publish configuration
        $this->publishes([
            __DIR__.'/../config/like-system.php' => config_path('like-system.php'),
        ], 'config');
    }

}
