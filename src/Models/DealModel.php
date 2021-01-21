<?php


namespace TalentuI33\ActiveCampaign\Models;


class DealModel
{
    public $id;
    public $contact;
    public $description = null;
    public $currency = 'cop';
    public $group = null;
    public $owner = null;
    public $percent = null;
    public $stage = null;
    public $status = 0;
    public $title = null;
    public $value = 0;

    public static function create(array $metaData): self
    {
        $meta = new self();
        $meta->id = $metaData['id'] ?? null;
        $meta->contact = $metaData['contact'] ?? '';

        if(isset($metaData['description'])) {
            $meta->description = $metaData['description'];
        }

        if(isset($metaData['currency'])) {
            $meta->currency = $metaData['currency'];
        }

        if(isset($metaData['group'])){
            $meta->group = $metaData['group'];
        }

        $meta->owner = $metaData['owner'] ?? '';
        $meta->percent = $metaData['percent'] ?? '';
        $meta->stage = $metaData['stage'] ?? '';

        if(isset($metaData['status'])) {
            $meta->status = $metaData['status'];
        }

        $meta->title = $metaData['title'] ?? '';

        if(isset($metaData['value'])) {
            $meta->value = $metaData['value'];
        }

        return $meta;
    }

    public static function createFromString(string $metaData): self
    {
        $contactObject = json_decode($metaData, true);
        return self::create($contactObject['deal']);
    }
}
