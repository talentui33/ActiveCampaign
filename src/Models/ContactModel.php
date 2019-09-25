<?php


namespace TalentuI33\ActiveCampaign\Models;


class ContactModel
{
    public $id;
    public $firstName;
    public $lastName;
    public $email;
    public $phone;
    private $cdate;

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
        return self::create($contactObject['contact']);
    }
}
