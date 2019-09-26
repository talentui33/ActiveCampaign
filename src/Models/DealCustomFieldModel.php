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

        $meta->id = isset($metaData['id']) ? $metaData['id'] : '';
        $meta->fieldLabel = isset($metaData['fieldLabel']) ? $metaData['fieldLabel'] : '';
        $meta->fieldType = isset($metaData['fieldType']) ? $metaData['fieldType'] : '';
        $meta->fieldOptions = isset($metaData['fieldOptions']) ? $metaData['fieldOptions'] : '';
        $meta->fieldDefault = isset($metaData['fieldDefault']) ? $metaData['fieldDefault'] : '';
        $meta->fieldDefaultCurrency = isset($metaData['fieldDefaultCurrency']) ? $metaData['fieldDefaultCurrency'] : '';
        $meta->isFormVisible = isset($metaData['isFormVisible']) ? $metaData['isFormVisible'] : '';
        $meta->isRequired = isset($metaData['isRequired']) ? $metaData['isRequired'] : '';
        $meta->displayOrder = isset($metaData['displayOrder']) ? $metaData['displayOrder'] : '';
        $meta->personalization = isset($metaData['personalization']) ? $metaData['personalization'] : '';
        $meta->knownFieldId = isset($metaData['knownFieldId']) ? $metaData['knownFieldId'] : '';
        $meta->hideFieldFlag = isset($metaData['hideFieldFlag']) ? $metaData['hideFieldFlag'] : '';
        $meta->createdTimestamp = isset($metaData['createdTimestamp']) ? $metaData['createdTimestamp'] : '';
        $meta->updatedTimestamp = isset($metaData['updatedTimestamp']) ? $metaData['updatedTimestamp'] : '';

        return $meta;
    }

    public static function createFromString(string $metaData): self
    {
        $contactObject = json_decode($metaData, true);
        return self::create($contactObject['dealCustomFieldMeta']);
    }
}
