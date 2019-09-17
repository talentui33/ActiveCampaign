<?php

namespace TalentuI33\ActiveCampaign;


use Illuminate\Foundation\Application as LaravelApplication;
use Illuminate\Support\ServiceProvider;

class ActiveCampaignServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    public function boot(): void
    {
        $this->setupConfig();
    }

    protected function setupConfig(): void
    {
        $source = realpath(__DIR__ . '/../config/activecampaign.php');
        if ($this->app instanceof LaravelApplication && $this->app->runningInConsole()) {
            $this->publishes([$source => config_path('activecampaign.php')]);
        }

        $this->mergeConfigFrom($source, 'activecampaign');
    }
}
