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

        $meta->id = $metaData['id'] ?? null;
        $meta->username = $metaData['username'] ?? null;
        $meta->firstName = $metaData['firstName'] ?? null;
        $meta->lastName = $metaData['lastName'] ?? null;
        $meta->email = $metaData['email'] ?? null;
        $meta->phone = $metaData['phone'] ?? null;
        $meta->signature = $metaData['signature'] ?? null;
        $meta->localZoneid = $metaData['localZoneid'] ?? null;
        $meta->password_updated_utc_timestamp = $metaData['password_updated_utc_timestamp'] ?? null;
        $meta->udate = $metaData['udate'] ?? null;
        $meta->mfaEnabled = $metaData['mfaEnabled'] ?? null;

        return $meta;
    }

    public static function createFromString(string $metaData): self
    {
        $contactObject = json_decode($metaData, true);
        return self::create($contactObject['user']);
    }
}
