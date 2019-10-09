<?php


namespace TalentuI33\ActiveCampaign\Providers;


use TalentuI33\ActiveCampaign\Models\DealCustomFieldDatumModel;

class DealCustomFieldDatumProvider
{
    public static function createFromString(string $metaData): array
    {
        $dealCustomFieldDatums = [];
        $dealCustomFieldObject = json_decode($metaData, true);
        foreach ($dealCustomFieldObject['dealCustomFieldData'] as $dealCustomField) {
            array(array_push($dealCustomFieldDatums, DealCustomFieldDatumModel::create($dealCustomField)));
        }

        return $dealCustomFieldDatums;
    }
}
