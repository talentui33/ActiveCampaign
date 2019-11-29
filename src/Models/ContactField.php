<?php


namespace TalentuI33\ActiveCampaign\Models;


class ContactField
{
    public $fieldOptions = [];
    public $fieldRels = [];
    public $fields;
    public $meta = null;

    public static function create(array $metaData): self
    {
        $meta = new self();
        $meta->fieldOptions = $metaData['filedOptions'];
        $meta->fieldRels = $metaData['fieldRels'];
        $meta->fields = Field::create($metaData['fields']);
        $meta->meta = $metaData['meta'];
        return $meta;
    }

    public static function createFromString(string $metaData): self
    {
        $contactFieldObject = json_decode($metaData, true);
        return self::create($contactFieldObject);
    }
}
