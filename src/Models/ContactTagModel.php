<?php


namespace TalentuI33\ActiveCampaign\Models;


class ContactTagModel
{
    public $contact = null;
    public $tag = null;
    public $cdate = null;
    public $created_timestamp = null;
    public $updated_timestamp = null;
    public $created_by = null;
    public $updated_by = null;

    public static function create(array $metaData): self
    {
        $meta = new self();

        $meta->contact = $metaData['contact'] ?? null;
        $meta->tag = $metaData['tag'] ?? null;
        $meta->cdate = $metaData['cdate'] ?? null;
        $meta->created_timestamp = $metaData['created_timestamp'] ?? null;
        $meta->updated_timestamp = $metaData['updated_timestamp'] ?? null;
        $meta->created_by = $metaData['created_by'] ?? null;
        $meta->updated_by = $metaData['updated_by'] ?? null;

        return $meta;
    }

    public static function createFromString(string $metaData): self
    {
        $contactTagObject = json_decode($metaData, true);
        return self::create($contactTagObject['contactTag']);
    }
}
