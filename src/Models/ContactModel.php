<?php


namespace TalentuI33\ActiveCampaign\Models;


class ContactModel
{
    /**
     * @var string
     */
    public $id;

    /**
     * @var string
     */
    public $firstName;

    /**
     * @var string
     */
    public $lastName;

    /**
     * @var string
     */
    public $email;

    /**
     * @var string
     */
    public $phone;

    /**
     * @var string
     */
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
