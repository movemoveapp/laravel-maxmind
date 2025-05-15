<?php

namespace MoveMoveApp\Maxmind;

use Illuminate\Support\ServiceProvider;

class MaxmindServiceProvider extends ServiceProvider
{
    /**
     * @return void
     */
    public function register(): void
    {
        $this->app->singleton('maxmind', function () {
            return new SuggestionsOrganizationApi();
        });
    }

    /**
     * @return void
     */
    public function boot(): void
    {
        $this->publishes([
            __DIR__.'/../config/maxmind.php' => config_path('maxmind.php')
        ]);
    }
}
