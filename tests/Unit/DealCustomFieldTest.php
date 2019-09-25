<?php


namespace Tests\Unit;


use TalentuI33\ActiveCampaign\DealCustomField;
use Tests\TestCase;

class DealCustomFieldTest extends TestCase
{
    public function testGetAllDealCustomFields(): void
    {
        $dealCustomFields = DealCustomField::getAll();

        $this->assertIsArray($dealCustomFields);
    }
}
