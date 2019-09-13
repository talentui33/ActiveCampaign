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
}
