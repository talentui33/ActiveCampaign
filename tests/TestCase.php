<?php

namespace Tests;

use Orchestra\Testbench\TestCase as BaseTestCase;

class TestCase extends BaseTestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->app['config']->set('activecampaign.api_url', 'Your ActiveCampaign Url');
        $this->app['config']->set('activecampaign.api_key', 'Your ActiveCampaign Api Token');
    }
}
