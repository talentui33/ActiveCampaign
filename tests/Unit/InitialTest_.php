<?php

namespace Tests\Unit;

use TalentuI33\ActiveCampaign\ActiveCampaign;
use Tests\TestCase;

class InitialTest extends TestCase
{
    public function testConnectionToApiActiveCampaign(): void
    {
        $activeCampaign = new ActiveCampaign();
        $this->assertTrue($activeCampaign->testConnection());
    }
}
