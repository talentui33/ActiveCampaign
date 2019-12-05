<?php /** @noinspection PhpUnhandledExceptionInspection */

namespace TalentuI33\ActiveCampaign;

use TalentuI33\ActiveCampaign\Models\ContactModel;
use TalentuI33\ActiveCampaign\Models\ContactTagModel;
use TalentuI33\ActiveCampaign\Providers\ContactProvider;
use TalentuI33\ActiveCampaign\Providers\FieldValeProvider;
use TalentuI33\ActiveCampaign\Services\HttpClient;

class Contact
{
    private static $url = 'contacts';
    private static $typeRequest = 'contact';
    private static $fieldValuesUrl = 'fieldValues';
    private static $contactTagUrl = 'contactTags';

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
            throw $exception;
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
            throw $exception;
        }

        return ContactModel::createFromString($response->getBody());
    }

    public static function delete(string $id): string
    {
        try {
            $client = new HttpClient();
            $response = $client->delete(static::$url . "/{$id}");
        } catch (\Exception $exception) {
            throw $exception;
        }
        return $response->getBody();
    }

    public static function getAll(): array
    {
        try {
            $client = new HttpClient();
            $response = $client->get(self::$url);
        } catch (\Exception $exception) {
            throw $exception;
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
            throw $exception;
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
            throw $exception;
        }

        return ContactModel::create($responseData['contact']);
    }

    public static function getFieldValues(ContactModel $contact)
    {
        try {
            $client = new HttpClient();
            $response = $client->get(self::$url . "/{$contact->id}" . self::$fieldValuesUrl, [
                'limit' => 100,
            ]);
        } catch (\Exception $exception) {
            throw $exception;
        }

        return FieldValeProvider::createFromString($response->getBody());
    }

    public static function addTagToContact(ContactModel $contact, string $tagId): ?ContactTagModel
    {
        try {
            $client = new HttpClient();
            $response = $client->postOrPut(self::$contactTagUrl, 'contactTag', [
                "contact" => $contact->id,
                "tag" => $tagId
            ]);
        } catch (\Exception $exception) {
            throw $exception;
        }

        return ContactTagModel::createFromString($response->getBody());
    }

    public static function removeTagToContact(string $contactTagId): bool
    {
        try {
            $client = new HttpClient();
            $response = $client->delete(self::$contactTagUrl . "/$contactTagId");
            return $response->getStatusCode() === 200;
        } catch (\Exception $exception) {
            throw $exception;
        }
    }
}
