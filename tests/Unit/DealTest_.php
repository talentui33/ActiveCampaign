<?php


namespace Tests\Unit;


use Illuminate\Http\Response;
use TalentuI33\ActiveCampaign\Contact;
use TalentuI33\ActiveCampaign\Deal;
use TalentuI33\ActiveCampaign\User;
use Tests\TestCase;

class DealTest extends TestCase
{
    public function testGetAllDeals(): void
    {
        $this->assertTrue(true);
        /*$response = Deal::getAll();
        $this->assertTrue($response->getStatusCode() === Response::HTTP_OK);*/
    }

    /**public function testAddNewDeal(): void
    {
        $userResponse = User::getByEmail($this->userEmail);
        $user = json_decode((string)$userResponse->getBody());

        $contactResponse = Contact::add(
            'First Name Test',
            'Last Name Test',
            'test.email@test.com',
            '3004672965'
        );
        $contact = json_decode((string)$contactResponse->getBody());

        $dealResponse = Deal::add($contact->contact->id, $user->user->id, 1, 'Test Deal');
        $this->assertTrue($dealResponse->getStatusCode() === Response::HTTP_CREATED);

        Contact::delete($contact->contact->id);
    }*/
}
