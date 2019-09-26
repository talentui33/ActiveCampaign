<?php


namespace TalentuI33\ActiveCampaign\Providers;


use TalentuI33\ActiveCampaign\Models\DealCustomFieldModel;

class DealCustomFieldProvider
{
    public static function createFromString(string $metaData): array
    {
        $dealCustomFields = [];
        $dealCustomFieldObject = json_decode($metaData, true);
        foreach ($dealCustomFieldObject['dealCustomFieldMeta'] as $dealCustomField) {
            array(array_push($dealCustomFields, DealCustomFieldModel::create($dealCustomField)));
        }

        return $dealCustomFields;
    }
}
