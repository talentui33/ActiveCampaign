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

        $meta->id = isset($metaData['id']) ? $metaData['id'] : null;
        $meta->firstName = isset($metaData['firstName']) ? $metaData['firstName'] : '';
        $meta->lastName = isset($metaData['lastName']) ? $metaData['lastName'] : '';
        $meta->email = isset($metaData['email']) ? $metaData['email'] : '';
        $meta->phone = isset($metaData['phone']) ? $metaData['phone'] : '';

        return $meta;
    }

    public static function createFromString(string $metaData): self
    {
        $contactObject = json_decode($metaData, true);
        return self::create($contactObject['contact']);
    }
}
