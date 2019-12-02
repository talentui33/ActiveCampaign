<?php


namespace TalentuI33\ActiveCampaign\Models;


use phpDocumentor\Reflection\Types\Self_;

class FieldValueModel
{
    public $contact = null;
    public $field = null;
    public $value = null;
    public $c_date = null;
    public $u_date = null;
    public $links = null;
    public $id = null;
    public $owner = null;

    public static function create(array $metaData): self
    {
        $fieldValue = new self();

        $fieldValue->contact = $metaData['contact'] ?? null;
        $fieldValue->field = $metaData['field'] ?? null;
        $fieldValue->value = $metaData['value'] ?? null;
        $fieldValue->c_date = $metaData['cdate'] ?? null;
        $fieldValue->u_date = $metaData['udate'] ?? null;
        $fieldValue->links = $metaData['links'] ?? null;
        $fieldValue->id = $metaData['id'] ?? null;
        $fieldValue->owner = $metaData['owner'] ?? null;

        return $fieldValue;
    }

    public static function createFromString(string $metaData): self
    {
        $fieldValueObject = json_decode($metaData, true);
        return self::create($fieldValueObject['fieldValue']);
    }
}
