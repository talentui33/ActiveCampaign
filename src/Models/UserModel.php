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

        $meta->id = isset($metaData['id']) ? $metaData['id'] : null;
        $meta->username = isset($metaData['username']) ? $metaData['username'] : null;
        $meta->firstName = isset($metaData['firstName']) ? $metaData['firstName'] : null;
        $meta->lastName = isset($metaData['lastName']) ? $metaData['lastName'] : null;
        $meta->email = isset($metaData['email']) ? $metaData['email'] : null;
        $meta->phone = isset($metaData['phone']) ? $metaData['phone'] : null;
        $meta->signature = isset($metaData['signature']) ? $metaData['signature'] : null;
        $meta->localZoneid = isset($metaData['localZoneid']) ? $metaData['localZoneid'] : null;
        $meta->password_updated_utc_timestamp = isset($metaData['password_updated_utc_timestamp'])
            ? $metaData['password_updated_utc_timestamp'] : null;
        $meta->udate = isset($metaData['udate']) ? $metaData['udate'] : null;
        $meta->mfaEnabled = isset($metaData['mfaEnabled']) ? $metaData['mfaEnabled'] : null;

        return $meta;
    }

    public static function createFromString(string $metaData): self
    {
        $contactObject = json_decode($metaData, true);
        return self::create($contactObject['user']);
    }
}
