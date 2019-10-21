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

        $meta->id = $metaData['id'] ?? '';
        $meta->dealCustomFieldMetumId =  $metaData['dealCustomFieldMetumId'] ?? '';
        $meta->dealId = $metaData['dealId'] ?? '';
        $meta->customFieldId = $metaData['customFieldId'] ?? '';
        $meta->createdTimestamp = $metaData['createdTimestamp'] ?? '';
        $meta->updatedTimestamp = $metaData['updatedTimestamp'] ?? '';
        $meta->fieldValue = $metaData['fieldValue'] ?? '';

        return $meta;
    }

    public static function createFromString(string $metaData): self
    {
        $contactObject = json_decode($metaData, true);
        return self::create($contactObject['dealCustomFieldDatum']);
    }
}
