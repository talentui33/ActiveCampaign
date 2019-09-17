<?php


namespace Tests\Unit;


use TalentuI33\ActiveCampaign\Contact;
use TalentuI33\ActiveCampaign\Deal;
use TalentuI33\ActiveCampaign\User;
use Tests\TestCase;

class DealTest extends TestCase
{
    public function testGetAllDeals(): void
    {
        $deals = Deal::getAll();

        $this->assertJson($deals);
    }

    public function testAddNewDeal(): void
    {
        $user = json_decode(User::findByEmail($this->userEmail));

        $contact = json_decode(Contact::add(
            'First Name Test',
            'Last Name Test',
            'test.email@test.com',
            '3004672965'
        ));

        $deal = Deal::add($contact->contact->id, $user->user->id, 1, 'Test Deal');
        $this->assertJson($deal);

        Contact::delete($contact->contact->id);
    }
}
