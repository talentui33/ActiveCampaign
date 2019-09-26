<?php


namespace TalentuI33\ActiveCampaign\Providers;


use TalentuI33\ActiveCampaign\Models\DealModel;

class DealProvider
{
    public static function createFromString(string $metaData): array
    {
        $contacts = array();
        $contactObject = json_decode($metaData, true);
        foreach ($contactObject['deals'] as $contact) {
            array(array_push($contacts, DealModel::create($contact)));
        }

        return $contacts;
    }
}
