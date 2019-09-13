<?php


namespace talentui33\ActiveCampaign\Tests\Unit;

use talentui33\ActiveCampaign\Contact;
use talentui33\ActiveCampaign\Tests\TestCase;

class ContactTest extends TestCase
{
    public function testGetAllContacts(): void
    {
        $contacts = Contact::getAll();
        $this->assertJson($contacts);
    }
}
