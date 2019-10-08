<?php


namespace Tests\Unit;


use TalentuI33\ActiveCampaign\Contact;
use TalentuI33\ActiveCampaign\Deal;
use TalentuI33\ActiveCampaign\DealCustomField;
use TalentuI33\ActiveCampaign\Models\ContactModel;
use TalentuI33\ActiveCampaign\Models\DealCustomFieldDatumModel;
use TalentuI33\ActiveCampaign\Models\DealModel;
use TalentuI33\ActiveCampaign\User;
use Tests\TestCase;

class DealTest extends TestCase
{
    public function testGetAllDeals(): void
    {
        $deals = Deal::getAll();
        $this->assertIsArray($deals);
    }

    public function testAddNewDeal(): void
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

        $this->assertTrue($deal->title === $newDeal->title);

        Contact::delete($contact->id);
    }

    public function testFindDealById(): void
    {
        $user = User::findByEmail($this->userEmail);
        $newContact = ContactModel::create([
            'firstName' => 'First Name Test',
            'lastName' => 'Last Name Test',
            'email' => 'test_deal.email@test.com',
            'phone' => '3004672965'
        ]);

        $contact = Contact::add($newContact);

        $newDeal = DealModel::create([
            'contact' => $contact->id,
            'owner' => $user->id,
            'stage' => 1,
            'title' => 'Test Deal Find'
        ]);

        $dealAdded = Deal::add($newDeal);

        $deal = Deal::findById($dealAdded->id);
        $this->assertTrue($deal->title === $dealAdded->title);

        Contact::delete($contact->id);
    }

    public function testUpdateDeal()
    {
        $user = User::findByEmail($this->userEmail);
        $newContact = ContactModel::create([
            'firstName' => 'First Name Test',
            'lastName' => 'Last Name Test',
            'email' => 'test_deal.email@test.com',
            'phone' => '3004672965'
        ]);

        $contact = Contact::add($newContact);

        $newDeal = DealModel::create([
            'contact' => $contact->id,
            'owner' => $user->id,
            'stage' => 1,
            'title' => 'Test Deal Find'
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

        DealCustomField::createBulkCustomFieldValue($customFieldDatums);
        $fieldDatums = DealCustomField::getCustomFieldDataByDeal($deal);

        foreach ($fieldDatums as $fieldDatum) {
            if ($fieldDatum->customFieldId == 1 || $fieldDatum->customFieldId == 4) {
                $fieldDatum->fieldValue .= ' Updated';
            }
        }

        DealCustomField::updateBulkCustomFieldValue($fieldDatums);

        $deal->status = 1;
        $dealUpdated = Deal::updateDeal($deal);

        $this->assertTrue($deal->status == $dealUpdated->status);
        Contact::delete($contact->id);
    }
}
