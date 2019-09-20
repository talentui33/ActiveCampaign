<?php


namespace TalentuI33\ActiveCampaign\Models;


class DealModel
{
    public $contact;
    public $description = '';
    public $currency = 'cop';
    public $owner;
    public $percent = null;
    public $stage;
    public $status = 0;
    public $title;
    public $value = 0;

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
        return self::create($contactObject['deal']);
    }
}
