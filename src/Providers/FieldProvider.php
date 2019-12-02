<?php


namespace TalentuI33\ActiveCampaign\Providers;


use TalentuI33\ActiveCampaign\Models\FieldModel;

class FieldProvider
{
    public static function create(array $metaData): array
    {
        $fields = [];
        foreach ($metaData as $field) {
            $newField = FieldModel::create($field);
            array_push($fields, $newField);
        }

        return $fields;
    }

    public static function createFromString(string $metaData): array
    {
        $fields = array();
        $fieldObject = json_decode($metaData, true);
        foreach ($fieldObject['fields'] as $field) {
            array(array_push($fields, FieldModel::create($field)));
        }

        return $fields;
    }

    public static function filter(string $property, string $value, array $fields): ?FieldModel
    {
        foreach ($fields as $field) {
            if ($field->{$property} == $value) {
                return $field;
            }
        }

        return null;
    }

}
