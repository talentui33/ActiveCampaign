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

    public static function create(array $metaData)
    {
        $meta = new self();
        foreach ($metaData as $key => $value) {
            $meta->$key = $value;
        }

        return $meta;
    }

    public static function createFromString(string $metaData)
    {
        $contactObject = json_decode($metaData, true);
        return self::create($contactObject['dealCustomFieldDatum']);
    }
}
