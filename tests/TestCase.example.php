<?php

namespace Tests;

use Orchestra\Testbench\TestCase as BaseTestCase;

// Rename Class name by "TestCase" in the new file "TestCase.php"
class TestCaseExample extends BaseTestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->app['config']->set('activecampaign.api_url', 'Your_Active_Campaign_Api_Url');
        $this->app['config']->set('activecampaign.api_key', 'Your_Active_Campaign_Api_Token');
    }
}
