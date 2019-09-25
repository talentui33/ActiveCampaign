<?php


namespace TalentuI33\ActiveCampaign\Models;


class DealCustomFieldModel
{
    public $id;
    public $fieldLabel;
    public $fieldType;
    public $fieldOptions;
    public $fieldDefault;
    public $fieldDefaultCurrency;
    public $isFormVisible;
    public $isRequired;
    public $displayOrder;
    public $personalization;
    public $knownFieldId;
    public $hideFieldFlag;
    public $createdTimestamp;
    public $updatedTimestamp;

    public static function create(array $metaData): self
    {
        $meta = new self();
        foreach ($metaData as $key => $value) {
            $meta->$key = $value;
        }

        return $meta;
    }

    public static function createFromString(string $metaData): self
    {
        $contactObject = json_decode($metaData, true);
        return self::create($contactObject['dealCustomFieldMeta']);
    }
}
