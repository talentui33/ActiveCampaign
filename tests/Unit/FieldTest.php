<?php


namespace Tests\Unit;


use TalentuI33\ActiveCampaign\Field;
use TalentuI33\ActiveCampaign\Models\FieldModel;
use Tests\TestCase;

class FieldTest extends TestCase
{
    public function testGetAllFields()
    {
        $fields = Field::getAll();

        $this->assertIsArray($fields);
    }

    public function testGeAllFieldByPerStag()
    {
        $contactField = Field::getByPerStag('HORARIO_DE_CITACIN');

        $this->assertTrue($contactField instanceof FieldModel || $contactField === null);
    }

    public function testGetAllFieldValues()
    {
        $this->assertTrue(true);
    }
}
