<?php


namespace Tests\Unit;


use TalentuI33\ActiveCampaign\Contact;
use TalentuI33\ActiveCampaign\Deal;
use TalentuI33\ActiveCampaign\DealCustomField;
use TalentuI33\ActiveCampaign\Models\ContactModel;
use TalentuI33\ActiveCampaign\Models\DealCustomFieldDatumModel;
use TalentuI33\ActiveCampaign\Models\DealCustomFieldModel;
use TalentuI33\ActiveCampaign\Models\DealModel;
use TalentuI33\ActiveCampaign\User;
use Tests\TestCase;

class DealCustomFieldTest extends TestCase
{
    public function testGetAllDealCustomFields(): void
    {
        $dealCustomFields = DealCustomField::getAll();

        $this->assertIsArray($dealCustomFields);
    }

    public function testFindDealCustomFieldByPersonalization(): void
    {
        $dealCustomField = DealCustomField::findByPersonalization('DEAL_OFERTA');

        $this->assertTrue($dealCustomField instanceof DealCustomFieldModel || $dealCustomField === null);
    }

    public function testCreateDealCustomFieldValue(): void
    {
        $user = User::findByEmail($this->userEmail);
        $newContact = ContactModel::create([
            'firstName' => 'First Name Test',
            'lastName' => 'Last Name Test',
            'email' => 'test.email@test.com',
            'phone' => '3004672965'
        ]);

        $contact = Contact::add($newContact);

        $newDeal = DealModel::create([
            'contact' => $contact->id,
            'owner' => $user->id,
            'stage' => $this->DEAL_STAGE,
            'title' => 'Test Deal'
        ]);

        $deal = Deal::add($newDeal);

        $dealCustomFieldOffer = DealCustomField::findByPersonalization('DEAL_RESPONDIO_CUESTIONARIOS_PREENTREVISTA');
        $dealCustomFieldDatum = DealCustomField::createCustomFiledValue($deal, $dealCustomFieldOffer, '4');

        $this->assertTrue($dealCustomFieldDatum instanceof DealCustomFieldDatumModel || $dealCustomFieldDatum === null);

        Contact::delete($contact->id);
    }

    public function testBulkCreateDealCustomFieldValue(): void
    {
        $user = User::findByEmail($this->userEmail);
        $newContact = ContactModel::create([
            'firstName' => 'First Name Test',
            'lastName' => 'Last Name Test',
            'email' => 'test.email@test.com',
            'phone' => '3004672965'
        ]);

        $contact = Contact::add($newContact);

        $newDeal = DealModel::create([
            'contact' => $contact->id,
            'owner' => $user->id,
            'stage' => $this->DEAL_STAGE,
            'title' => 'Test Deal'
        ]);

        $deal = Deal::add($newDeal);

        $customFieldDatum = [];

        $dealCustomFields = DealCustomField::getAll();

        foreach ($dealCustomFields as $dealCustomField) {
            if ($dealCustomField->personalization === 'DEAL_RESPONDIO_CUESTIONARIOS_PREENTREVISTA') {
                $dealCustomFieldDatum = new DealCustomFieldDatumModel();
                $dealCustomFieldDatum->dealId = $deal->id;
                $dealCustomFieldDatum->customFieldId = $dealCustomField->id;
                $dealCustomFieldDatum->fieldValue = "4";
                array_push($customFieldDatum, $dealCustomFieldDatum);
            }
        }

        $newDealCustomFieldDatum = DealCustomField::createBulkCustomFieldValue($customFieldDatum);
        $this->assertTrue($newDealCustomFieldDatum || $newDealCustomFieldDatum === null);

        Contact::delete($contact->id);
    }

    public function testGetAllCustomFieldByDeal(): void
    {
        $user = User::findByEmail($this->userEmail);
        $newContact = ContactModel::create([
            'firstName' => 'First Name Test',
            'lastName' => 'Last Name Test',
            'email' => 'test.email@test.com',
            'phone' => '3004672965'
        ]);

        $contact = Contact::add($newContact);

        $newDeal = DealModel::create([
            'contact' => $contact->id,
            'owner' => $user->id,
            'stage' => $this->DEAL_STAGE,
            'title' => 'Test Deal'
        ]);

        $deal = Deal::add($newDeal);

        $customFieldDatum = [];

        $dealCustomFields = DealCustomField::getAll();

        foreach ($dealCustomFields as $dealCustomField) {
            if ($dealCustomField->personalization === 'DEAL_RESPONDIO_CUESTIONARIOS_PREENTREVISTA') {
                $dealCustomFieldDatum = new DealCustomFieldDatumModel();
                $dealCustomFieldDatum->dealId = $deal->id;
                $dealCustomFieldDatum->customFieldId = $dealCustomField->id;
                $dealCustomFieldDatum->fieldValue = "3";
                array_push($customFieldDatum, $dealCustomFieldDatum);
            }
        }

        $newDealCustomFieldDatum = DealCustomField::createBulkCustomFieldValue($customFieldDatum);
        $this->assertTrue($newDealCustomFieldDatum || $newDealCustomFieldDatum === null);

        $customFieldDatum = DealCustomField::getCustomFieldDataByDeal($deal);
        $this->assertIsArray($customFieldDatum);

        Contact::delete($contact->id);
    }

    public function testBulkUpdateDealCustomFieldValue(): void
    {
        $user = User::findByEmail($this->userEmail);
        $newContact = ContactModel::create([
            'firstName' => 'First Name Test',
            'lastName' => 'Last Name Test',
            'email' => 'test.email@test.com',
            'phone' => '3004672965'
        ]);

        $contact = Contact::add($newContact);

        $newDeal = DealModel::create([
            'contact' => $contact->id,
            'owner' => $user->id,
            'stage' => $this->DEAL_STAGE,
            'title' => 'Test Deal'
        ]);

        $deal = Deal::add($newDeal);

        $customFieldDatum = [];

        $dealCustomFields = DealCustomField::getAll();

        foreach ($dealCustomFields as $dealCustomField) {
            if ($dealCustomField->personalization === 'DEAL_RESPONDIO_CUESTIONARIOS_PREENTREVISTA') {
                $dealCustomFieldDatum = new DealCustomFieldDatumModel();
                $dealCustomFieldDatum->dealId = $deal->id;
                $dealCustomFieldDatum->customFieldId = $dealCustomField->id;
                $dealCustomFieldDatum->fieldValue = "4";
                array_push($customFieldDatum, $dealCustomFieldDatum);
            }
        }

        $newDealCustomFieldDatum = DealCustomField::createBulkCustomFieldValue($customFieldDatum);
        $this->assertTrue($newDealCustomFieldDatum || $newDealCustomFieldDatum === null);

        $fieldDatum = DealCustomField::getCustomFieldDataByDeal($deal);

        foreach ($fieldDatum as $fieldData) {
            if ($fieldData->customFieldId == 1 || $fieldData->customFieldId == 4) {
                $fieldData->fieldValue .= ' Updated';
            }
        }

        DealCustomField::updateBulkCustomFieldValue($fieldDatum);

        Contact::delete($contact->id);
    }
}
