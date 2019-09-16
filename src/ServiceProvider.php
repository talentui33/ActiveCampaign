<?php

namespace TalentuI33\ActiveCampaign;


class ServiceProvider extends \Illuminate\Support\ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    public function boot(): void
    {
        $this->publishes([
            __DIR__.'/config/activecampaign.php' => config_path('activecampaign.php'),
        ], 'config');
    }

    public function register(): void
    {
        $this->mergeConfigFrom(
            __DIR__.'/config/activecampaign.php', 'activecampaign'
        );

        $this->app->bind('activecampaign', function ($app) {
            return new ActiveCampaign();
        });
    }
}
