<?php


namespace Tests\Unit;


use TalentuI33\ActiveCampaign\Contact;
use TalentuI33\ActiveCampaign\Deal;
use TalentuI33\ActiveCampaign\Models\ContactModel;
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
}
