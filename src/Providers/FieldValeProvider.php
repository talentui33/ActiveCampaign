<?php


namespace TalentuI33\ActiveCampaign\Providers;


use TalentuI33\ActiveCampaign\Models\FieldValueModel;

class FieldValeProvider
{
    public static function createFromString(string $metaData): array
    {
        $fieldValues = array();
        $fieldValuesObject = json_decode($metaData, true);
        foreach ($fieldValuesObject['fieldValues'] as $field) {
            array(array_push($fieldValues, FieldValueModel::create($field)));
        }

        return $fieldValues;
    }
}
