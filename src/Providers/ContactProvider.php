<?php


namespace TalentuI33\ActiveCampaign\Providers;


use TalentuI33\ActiveCampaign\Models\ContactModel;

class ContactProvider
{
    public static function createFromString(string $metaData): array
    {
        $contacts = array();
        $contactObject = json_decode($metaData, true);
        foreach ($contactObject['contacts'] as $contact) {
            array(array_push($contacts, ContactModel::create($contact)));
        }

        return $contacts;
    }
}
