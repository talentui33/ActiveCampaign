<?php


namespace TalentuI33\ActiveCampaign\Models;


class UserModel
{
    public $id;
    public $username;
    public $firstName;
    public $lastName;
    public $email;
    public $phone;
    public $signature;
    public $localZoneid;
    public $password_updated_utc_timestamp;
    public $udate;
    public $mfaEnabled;

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
        return self::create($contactObject['user']);
    }
}
