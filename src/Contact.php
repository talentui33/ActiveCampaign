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
        try {
            $client = new HttpClient();
            $response = $client->postOrPut(static::$url, static::$typeRequest, [
                'email' => $contact->email,
                'firstName' => $contact->firstName,
                'lastName' => $contact->lastName,
                'phone' => $contact->phone
            ]);
        } catch (\Exception $exception) {
            throw new $exception;
        }

        return ContactModel::createFromString($response->getBody());
    }

    public static function update(ContactModel $contact): ContactModel
    {
        try {
            $client = new HttpClient();
            $response = $client->postOrPut(static::$url . "/{$contact->id}", static::$typeRequest, [
                'email' => $contact->email,
                'firstName' => $contact->firstName,
                'lastName' => $contact->lastName,
                'phone' => $contact->phone
            ], 'put');
        } catch (\Exception $exception) {
            throw new $exception;
        }

        return ContactModel::createFromString($response->getBody());
    }

    public static function delete(string $id): string
    {
        try {
            $client = new HttpClient();
            $response = $client->delete(static::$url . "/{$id}");
        } catch (\Exception $exception) {
            throw new $exception;
        }
        return $response->getBody();
    }

    public static function getAll(): array
    {
        try {
            $client = new HttpClient();
            $response = $client->get(self::$url);
        } catch (\Exception $exception) {
            throw new $exception;
        }

        return ContactProvider::createFromString($response->getBody());
    }

    public static function findByEmail(string $email): ?ContactModel
    {
        try {
            $client = new HttpClient();
            $response = $client->get(static::$url, [
                'email' => $email
            ]);
            $responseData = json_decode($response->getBody(), true);
            if (isset($responseData['contacts']) && count($responseData['contacts']) > 0) {
                return ContactModel::create($responseData['contacts'][0]);
            }
        } catch (\Exception $exception) {
            throw new $exception;
        }

        return null;
    }

    public static function findById(string $id): ?ContactModel
    {
        try {
            $client = new HttpClient();
            $response = $client->get(static::$url . "/$id");
            $responseData = json_decode($response->getBody(), true);
            if (!isset($responseData['contact'])) {
                return null;
            }
        } catch (\Exception $exception) {
            throw new $exception;
        }

        return ContactModel::create($responseData['contact']);
    }
}
