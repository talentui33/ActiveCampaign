<?php


namespace Tests\Unit;

use TalentuI33\ActiveCampaign\Contact;
use Tests\TestCase;

class ContactTest extends TestCase
{
    protected $contactId;

    public function testGetAllContacts(): void
    {
        $response = Contact::getAll();

        $this->assertTrue($response->getStatusCode() === 200);
    }

    public function testGetContactByEmail()
    {
        $response = Contact::getByEmail('smilenaferr22@gmail.com');

        $this->assertTrue($response->getStatusCode() === 200);
    }

    public function testAddNewContact(): void
    {
        $response = Contact::add(
            'Sandra Milena',
            'Ferreira Dimian',
            'smilenaferr22@gmail.com',
            '3154770365'
        );

        $contact = json_decode((string)$response->getBody());
        $this->contactId = $contact->contact->id;

        $this->assertTrue($response->getStatusCode() === 201);
    }

    public function testUpdateContact()
    {
        $response = Contact::getByEmail('smilenaferr22@gmail.com');
        $contact = json_decode((string)$response->getBody());

        if (isset($contact->contacts[0])) {
            $response = Contact::update(
                $contact->contacts[0]->id,
                'Sandra',
                'Ferreira',
                'smilenaferr22@gmail.com',
                '3154770365'
            );

            $this->assertTrue($response->getStatusCode() === 200);
        } else {
            $this->assertTrue(false, 'Data not Found on API');
        }
    }

    public function testDeleteContact()
    {
        $response = Contact::getByEmail('smilenaferr22@gmail.com');
        $contact = json_decode((string)$response->getBody());

        if (isset($contact->contacts[0])) {
            $response = Contact::delete($contact->contacts[0]->id);
            $this->assertTrue($response->getStatusCode() === 200);
        } else {
            $this->assertTrue(false, 'Data not Found on API');
        }
    }
}
