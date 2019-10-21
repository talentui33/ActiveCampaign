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

        $meta->id = $metaData['id'] ?? '';
        $meta->fieldLabel = $metaData['fieldLabel'] ?? '';
        $meta->fieldType = $metaData['fieldType'] ?? '';
        $meta->fieldOptions = $metaData['fieldOptions'] ?? '';
        $meta->fieldDefault = $metaData['fieldDefault'] ?? '';
        $meta->fieldDefaultCurrency = $metaData['fieldDefaultCurrency'] ?? '';
        $meta->isFormVisible = $metaData['isFormVisible'] ?? '';
        $meta->isRequired = $metaData['isRequired'] ?? '';
        $meta->displayOrder = $metaData['displayOrder'] ?? '';
        $meta->personalization = $metaData['personalization'] ?? '';
        $meta->knownFieldId = $metaData['knownFieldId'] ?? '';
        $meta->hideFieldFlag = $metaData['hideFieldFlag'] ?? '';
        $meta->createdTimestamp = $metaData['createdTimestamp'] ?? '';
        $meta->updatedTimestamp = $metaData['updatedTimestamp'] ?? '';

        return $meta;
    }

    public static function createFromString(string $metaData): self
    {
        $contactObject = json_decode($metaData, true);
        return self::create($contactObject['dealCustomFieldMeta']);
    }
}
