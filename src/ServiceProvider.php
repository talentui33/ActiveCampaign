<?php

namespace talentui33\ActiveCampaign;


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
            __DIR__.'/config/active-campaign.php' => config_path('active-campaign.php'),
        ], 'config');
    }

    public function register(): void
    {
        $this->mergeConfigFrom(
            __DIR__.'/config/active-campaign.php', 'active-campaign'
        );
    }
}
