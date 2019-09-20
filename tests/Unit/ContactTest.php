<?php


namespace Tests\Unit;

use TalentuI33\ActiveCampaign\Contact;
use TalentuI33\ActiveCampaign\Models\ContactModel;
use Tests\TestCase;

class ContactTest extends TestCase
{

    public function testGetAllContacts(): void
    {
        $contacts = Contact::getAll();
        $this->assertTrue(count($contacts) >= 0);
    }

    public function testAddNewContact(): void
    {
        $newContact = ContactModel::create([
            'firstName' => 'First Name Test',
            'lastName' => 'Last Name Test',
            'email' => 'test.email@test.com',
            'phone' => '3004672965'
        ]);

        $contact = Contact::add($newContact);
        $this->assertTrue($newContact->email === $contact->email);
    }

    public function testFindContactByEmail(): void
    {
        $contact = Contact::findByEmail('test.email@test.com');
        if($contact) {
            $this->assertTrue($contact->email == 'test.email@test.com');
        }
    }

    public function testUpdateContact(): void
    {
        $contact = Contact::findByEmail('test.email@test.com');

        if ($contact) {
            $contact = Contact::update(
                $contact->id,
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
        $contact = Contact::findByEmail('test.email@test.com');
        if ($contact) {
            $response = Contact::delete($contact->id);

            $this->assertJson($response);
        } else {
            $this->assertTrue(false, 'Data not Found on API');
        }
    }
}
