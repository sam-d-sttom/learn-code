<?php

namespace App\Providers;

use App\Services\WalletServices;
use App\Services\ChapterServices;
use Illuminate\Support\ServiceProvider;

class KidsCodeServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
        $this->app->bind('App\Services\WalletServices', function ($app) {
            return new WalletServices();
        });

        $this->app->bind('App\Services\ChapterServices', function ($app) {
            return new ChapterServices();
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
