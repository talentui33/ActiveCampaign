<?php


namespace Tests\Unit;


use TalentuI33\ActiveCampaign\Contact;
use TalentuI33\ActiveCampaign\Field;
use TalentuI33\ActiveCampaign\Models\ContactModel;
use TalentuI33\ActiveCampaign\Models\FieldModel;
use Tests\TestCase;

class FieldTest extends TestCase
{
    private static $PER_TAG = 'TAG_FOR_TESTING_PURPOSE';

    public function testGetAllFields(): void
    {
        $fields = Field::getAll();

        $this->assertIsArray($fields);
    }

    public function testGeAllFieldByPerStag(): void
    {
        $contactField = Field::getByPerStag(self::$PER_TAG);

        $this->assertTrue($contactField instanceof FieldModel || $contactField === null);
    }

    public function testGetAllFieldValues(): void
    {
        $fieldValues = Field::getAllFieldValues();

        $this->assertIsArray($fieldValues);
    }

    public function testUpdateFieldValues(): void
    {
        try {
            $newContact = ContactModel::create([
                'firstName' => 'First Name Test',
                'lastName' => 'Last Name Test',
                'email' => 'test.email@test.com',
                'phone' => '3004672965'
            ]);
            $contactAdded = Contact::add($newContact);

            $value = 'New value for testing 2';
            $contact = Contact::findById($contactAdded->id);
            $fieldValues = Contact::getFieldValues($contact);
            $field = Field::getByPerStag(self::$PER_TAG);

            if(!is_null($field)) {
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
            }else{
                $this->assertNull($field);
            }

            Contact::delete($contact->id);
        } catch (\Exception $e) {
            $this->assertTrue(false, $e->getMessage());
        }
    }
}
