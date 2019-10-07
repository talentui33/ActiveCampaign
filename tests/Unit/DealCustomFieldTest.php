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
            'stage' => 1,
            'title' => 'Test Deal'
        ]);

        $deal = Deal::add($newDeal);

        $dealCustomFieldOffer = DealCustomField::findByPersonalization('DEAL_OFERTA');
        $dealCustomFieldDatum = DealCustomField::updateCustomFiledValue($deal, $dealCustomFieldOffer, 'Test create value for DEAL_OFERTA');

        $this->assertTrue($dealCustomFieldDatum instanceof DealCustomFieldDatumModel || $dealCustomFieldDatum === null);

        Contact::delete($contact->id);
    }

    public function testBulkCreateDealCustomFieldValue()
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
            'stage' => 1,
            'title' => 'Test Deal'
        ]);

        $deal = Deal::add($newDeal);

        $customFieldDatums = [];

        $dealCustomFieldOffer = DealCustomField::findByPersonalization('DEAL_OFERTA');
        $dealCustomFieldDatum = new DealCustomFieldDatumModel();
        $dealCustomFieldDatum->dealId = $deal->id;
        $dealCustomFieldDatum->customFieldId = $dealCustomFieldOffer->id;
        $dealCustomFieldDatum->fieldValue = 'Test Bulk for DEAL_OFERTA';
        array_push($customFieldDatums, $dealCustomFieldDatum);

        $dealCustomFieldCompany = DealCustomField::findByPersonalization('DEAL_COMPANIA');
        $dealCustomFieldDatum = new DealCustomFieldDatumModel();
        $dealCustomFieldDatum->dealId = $deal->id;
        $dealCustomFieldDatum->customFieldId = $dealCustomFieldCompany->id;
        $dealCustomFieldDatum->fieldValue = 'test Bulk for DEAL_COMPANIA';
        array_push($customFieldDatums, $dealCustomFieldDatum);


        $newDealCustomFieldDatum = DealCustomField::updateBulkCustomFieldValue($customFieldDatums);

        $this->assertTrue($newDealCustomFieldDatum || $newDealCustomFieldDatum === null);

        Contact::delete($contact->id);
    }
}
