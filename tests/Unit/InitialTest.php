<?php

namespace talentui33\ActiveCampaign\Tests;

use talentui33\ActiveCampaign\ActiveCampaign;

class InitialTest extends TestCase
{
    public function testConnectionToApiActiveCampaign(): void
    {
        $activeCampaign = new ActiveCampaign();
        $this->assertTrue($activeCampaign->testConnection());
    }
}
