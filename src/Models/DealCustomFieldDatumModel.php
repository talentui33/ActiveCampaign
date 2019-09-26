<?php


namespace TalentuI33\ActiveCampaign\Models;


class DealCustomFieldDatumModel
{
    public $id;
    public $dealCustomFieldMetumId;
    public $dealId;
    public $customFieldId;
    public $createdTimestamp;
    public $updatedTimestamp;
    public $fieldValue;

    public static function create(array $metaData): self
    {
        $meta = new self();

        $meta->id = isset($metaData['id']) ? $metaData['id'] : '';
        $meta->dealCustomFieldMetumId = isset($metaData['dealCustomFieldMetumId']) ? $metaData['dealCustomFieldMetumId'] : '';
        $meta->dealId = isset($metaData['dealId']) ? $metaData['dealId'] : '';
        $meta->customFieldId = isset($metaData['customFieldId']) ? $metaData['customFieldId'] : '';
        $meta->createdTimestamp = isset($metaData['createdTimestamp']) ? $metaData['createdTimestamp'] : '';
        $meta->updatedTimestamp = isset($metaData['updatedTimestamp']) ? $metaData['updatedTimestamp'] : '';
        $meta->fieldValue = isset($metaData['fieldValue']) ? $metaData['fieldValue'] : '';

        return $meta;
    }

    public static function createFromString(string $metaData): self
    {
        $contactObject = json_decode($metaData, true);
        return self::create($contactObject['dealCustomFieldDatum']);
    }
}
