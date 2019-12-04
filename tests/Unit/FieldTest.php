<?php


namespace Tests\Unit;


use TalentuI33\ActiveCampaign\Contact;
use TalentuI33\ActiveCampaign\Field;
use TalentuI33\ActiveCampaign\Models\FieldModel;
use Tests\TestCase;

class FieldTest extends TestCase
{
    private static $PER_TAG = 'PROFILE_URL';

    public function testGetAllFields()
    {
        $fields = Field::getAll();

        $this->assertIsArray($fields);
    }

    public function testGeAllFieldByPerStag()
    {
        $contactField = Field::getByPerStag(self::$PER_TAG);

        $this->assertTrue($contactField instanceof FieldModel || $contactField === null);
    }

    public function testGetAllFieldValues()
    {
        $fieldValues = Field::getAllFieldValues();

        $this->assertIsArray($fieldValues);
    }

    public function testUpdateFieldValues()
    {
        try {
            $value = 'New value for testing 2';
            $contact = Contact::findById('56369');
            $fieldValues = Contact::getFieldValues($contact);
            $field = Field::getByPerStag(self::$PER_TAG);

            foreach ($fieldValues as $fieldValue) {
                if ($field->id == $fieldValue->field) {
                    $fieldValue->value = $value;
                    $response = Field::updateOrCreateFieldValue($contact, $fieldValue);
                    $this->assertTrue($response);
                }
            }

            $fieldValuesTest = Contact::getFieldValues($contact);
            foreach ($fieldValuesTest as $item) {
                if ($item->field == $field->id) {
                    $this->assertTrue($item->value == $value);
                    break;
                }
            }
        } catch (\Exception $e) {
            $this->assertTrue(false, $e->getMessage());
        }
    }
}
