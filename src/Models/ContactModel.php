<?php


namespace TalentuI33\ActiveCampaign\Models;


class ContactModel
{
    public $id;
    public $firstName;
    public $lastName;
    public $email;
    public $phone;

    public static function create(array $metaData): self
    {
        $meta = new self();

        $meta->id = $metaData['id'] ?? null;
        $meta->firstName = $metaData['firstName'] ?? '';
        $meta->lastName = $metaData['lastName'] ?? '';
        $meta->email = $metaData['email'] ?? '';
        $meta->phone = $metaData['phone'] ?? '';

        return $meta;
    }

    public static function createFromString(string $metaData): self
    {
        $contactObject = json_decode($metaData, true);
        return self::create($contactObject['contact']);
    }
}
