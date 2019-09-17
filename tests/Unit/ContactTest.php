<?php


namespace Tests\Unit;

use TalentuI33\ActiveCampaign\Contact;
use Tests\TestCase;

class ContactTest extends TestCase
{

    public function testGetAllContacts(): void
    {
        $contacts = Contact::getAll();
        $this->assertJson($contacts);
    }

    public function testAddNewContact(): void
    {
        $contact = Contact::add(
            'First Name Test',
            'Last Name Test',
            'test.email@test.com',
            '3004672965'
        );

        $this->assertJson($contact);
    }

    public function testFindContactByEmail(): void
    {
        $contact = Contact::findByEmail('test.email@test.com');

        $this->assertJson($contact);
    }

    public function testUpdateContact(): void
    {
        $contact = json_decode((string)Contact::findByEmail('test.email@test.com'));

        if (isset($contact->contacts[0])) {
            $contact = Contact::update(
                $contact->contacts[0]->id,
                'First Name Test Edited',
                'Last Name Test Edited',
                'test.email@test.com',
                '3004672965'
            );

            $this->assertJson($contact);
        } else {
            $this->assertTrue(false, 'Email not found on Active Campaign API');
        }
    }

    public function testDeleteContact(): void
    {
        $contact = json_decode((string)Contact::findByEmail('test.email@test.com'));
        if (isset($contact->contacts[0])) {
            $response = Contact::delete($contact->contacts[0]->id);

            $this->assertJson($response);
        } else {
            $this->assertTrue(false, 'Data not Found on API');
        }
    }
}
