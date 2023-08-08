<?php

namespace Eslamfaroug\LaravelLikeDislike;

use Eslamfaroug\LaravelLikeDislike\Repositories\LikeSystemRepository;
use Eslamfaroug\LaravelLikeDislike\Services\LikeSystemService;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Config;

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

    protected function loadMigrations()
    {
        if (Config::get('comments.load_migrations') === true) {
            $this->loadMigrationsFrom(__DIR__ . '/../migrations');
        }
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadMigrations();

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
