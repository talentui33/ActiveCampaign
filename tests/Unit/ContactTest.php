<?php


namespace Tests\Unit;

use Illuminate\Http\Response;
use TalentuI33\ActiveCampaign\Contact;
use Tests\TestCase;

class ContactTest extends TestCase
{
    protected $contactId;

    public function testGetAllContacts(): void
    {
        $response = Contact::getAll();

        $this->assertTrue($response->getStatusCode() === Response::HTTP_OK);
    }

    public function testGetContactByEmail(): void
    {
        $response = Contact::getByEmail('test.email@test.com');

        $this->assertTrue($response->getStatusCode() === Response::HTTP_OK);
    }

    public function testAddNewContact(): void
    {
        $response = Contact::add(
            'First Name Test',
            'Last Name Test',
            'test.email@test.com',
            '3004672965'
        );

        $this->assertTrue($response->getStatusCode() === Response::HTTP_CREATED);
    }

    public function testUpdateContact(): void
    {
        $response = Contact::getByEmail('test.email@test.com');
        $contact = json_decode((string)$response->getBody());

        if (isset($contact->contacts[0])) {
            $response = Contact::update(
                $contact->contacts[0]->id,
                'First Name Test Edited',
                'Last Name Test Edited',
                'test.email@test.com',
                '3004672965'
            );

            $this->assertTrue($response->getStatusCode() === Response::HTTP_OK);
        } else {
            $this->assertTrue(false, 'Data not Found on API');
        }
    }

    public function testDeleteContact(): void
    {
        $response = Contact::getByEmail('test.email@test.com');
        $contact = json_decode((string)$response->getBody());

        if (isset($contact->contacts[0])) {
            $response = Contact::delete($contact->contacts[0]->id);
            $this->assertTrue($response->getStatusCode() === Response::HTTP_OK);
        } else {
            $this->assertTrue(false, 'Data not Found on API');
        }
    }
}
