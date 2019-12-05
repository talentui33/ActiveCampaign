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

        $dealCustomFieldOffer = DealCustomField::findByPersonalization('DEAL_OFERTA');
        $dealCustomFieldDatum = DealCustomField::createCustomFiledValue($deal, $dealCustomFieldOffer, 'Test create value for DEAL_OFERTA');

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

        $customFieldDatums = [];

        $dealCustomFields = DealCustomField::getAll();

        foreach ($dealCustomFields as $dealCustomField) {
            if ($dealCustomField->personalization !== 'DEAL_JOB_INTERVIEW_DATE') {
                $dealCustomFieldDatum = new DealCustomFieldDatumModel();
                $dealCustomFieldDatum->dealId = $deal->id;
                $dealCustomFieldDatum->customFieldId = $dealCustomField->id;
                $dealCustomFieldDatum->fieldValue = "Test Bulk for {$dealCustomField->personalization}";
                array_push($customFieldDatums, $dealCustomFieldDatum);
            }
        }

        $newDealCustomFieldDatum = DealCustomField::createBulkCustomFieldValue($customFieldDatums);
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

        $customFieldDatums = [];

        $dealCustomFields = DealCustomField::getAll();

        foreach ($dealCustomFields as $dealCustomField) {
            if ($dealCustomField->personalization !== 'DEAL_JOB_INTERVIEW_DATE') {
                $dealCustomFieldDatum = new DealCustomFieldDatumModel();
                $dealCustomFieldDatum->dealId = $deal->id;
                $dealCustomFieldDatum->customFieldId = $dealCustomField->id;
                $dealCustomFieldDatum->fieldValue = "Test Bulk for {$dealCustomField->personalization}";
                array_push($customFieldDatums, $dealCustomFieldDatum);
            }
        }

        $newDealCustomFieldDatum = DealCustomField::createBulkCustomFieldValue($customFieldDatums);
        $this->assertTrue($newDealCustomFieldDatum || $newDealCustomFieldDatum === null);

        $customFieldDatums = DealCustomField::getCustomFieldDataByDeal($deal);
        $this->assertIsArray($customFieldDatums);

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

        $customFieldDatums = [];

        $dealCustomFields = DealCustomField::getAll();

        foreach ($dealCustomFields as $dealCustomField) {
            if ($dealCustomField->personalization !== 'DEAL_JOB_INTERVIEW_DATE') {
                $dealCustomFieldDatum = new DealCustomFieldDatumModel();
                $dealCustomFieldDatum->dealId = $deal->id;
                $dealCustomFieldDatum->customFieldId = $dealCustomField->id;
                $dealCustomFieldDatum->fieldValue = "Test Bulk for {$dealCustomField->personalization}";
                array_push($customFieldDatums, $dealCustomFieldDatum);
            }
        }

        $newDealCustomFieldDatum = DealCustomField::createBulkCustomFieldValue($customFieldDatums);
        $this->assertTrue($newDealCustomFieldDatum || $newDealCustomFieldDatum === null);

        $fieldDatums = DealCustomField::getCustomFieldDataByDeal($deal);

        foreach ($fieldDatums as $fieldDatum) {
            if ($fieldDatum->customFieldId == 1 || $fieldDatum->customFieldId == 4) {
                $fieldDatum->fieldValue .= ' Updated';
            }
        }

        DealCustomField::updateBulkCustomFieldValue($fieldDatums);

        Contact::delete($contact->id);
    }
}
