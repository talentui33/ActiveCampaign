<?php

namespace TalentuI33\ActiveCampaign;

use TalentuI33\ActiveCampaign\Models\ContactModel;
use TalentuI33\ActiveCampaign\Providers\ContactProvider;
use TalentuI33\ActiveCampaign\Services\HttpClient;

class Contact
{
    private static $url = 'contacts';
    private static $typeRequest = 'contact';

    public static function add(ContactModel $contact): ContactModel
    {

        $client = new HttpClient();
        $response = $client->postOrPut(static::$url, static::$typeRequest, [
            'email' => $contact->email,
            'firstName' => $contact->firstName,
            'lastName' => $contact->lastName,
            'phone' => $contact->phone
        ]);

        return ContactModel::createFromString($response->getBody());
    }

    public static function update(ContactModel $contact): ContactModel
    {
        $client = new HttpClient();
        $response = $client->postOrPut(static::$url . "/{$contact->id}", static::$typeRequest, [
            'email' => $contact->email,
            'firstName' => $contact->firstName,
            'lastName' => $contact->lastName,
            'phone' => $contact->phone
        ], 'put');

        return ContactModel::createFromString($response->getBody());
    }

    public static function delete(string $id): string
    {
        $client = new HttpClient();
        $response = $client->delete(static::$url . "/{$id}");

        return $response->getBody();
    }

    public static function getAll(): array
    {
        $client = new HttpClient();
        $response = $client->get(self::$url);

        return ContactProvider::createFromString($response->getBody());
    }

    public
    static function findByEmail(string $email): ?ContactModel
    {
        $client = new HttpClient();
        $response = $client->get(static::$url, [
            'email' => $email
        ]);
        $responseData = json_decode($response->getBody(), true);
        if (isset($responseData['contacts']) && count($responseData['contacts']) > 0) {
            return ContactModel::create($responseData['contacts'][0]);
        }

        return null;
    }
}
