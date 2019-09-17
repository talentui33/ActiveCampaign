<?php

namespace TalentuI33\ActiveCampaign;

use TalentuI33\ActiveCampaign\Services\HttpClient;

class Contact
{
    private static $url = 'contacts';
    private static $typeRequest = 'contact';

    public static function add(string $firstName, string $lastName, string $email, string $phone): string
    {

        $client = new HttpClient();
        $response = $client->postOrPut(static::$url, static::$typeRequest, [
            'email' => $email,
            'firstName' => $firstName,
            'lastName' => $lastName,
            'phone' => $phone
        ]);

        return $response->getBody();
    }

    public static function update(string $id, string $firstName = null, string $lastName = null, string $email = null, string $phone = null): string
    {
        $data = collect();

        if (!empty($firstName)) {
            $data->put('firstName', $firstName);
        }

        if (!empty($lastName)) {
            $data->put('lastName', $lastName);
        }

        if (!empty($email)) {
            $data->put('email', $email);
        }

        if (!empty($phone)) {
            $data->put('phone', $phone);
        }

        $client = new HttpClient();
        $response = $client->postOrPut(static::$url . "/{$id}", static::$typeRequest, $data->toArray(), 'put');

        return $response->getBody();
    }

    public static function delete(string $id): string
    {
        $client = new HttpClient();
        $response = $client->delete(static::$url . "/{$id}");

        return $response->getBody();
    }

    public
    static function getAll(): string
    {
        $client = new HttpClient();
        $response = $client->get(self::$url);

        return $response->getBody();
    }

    public
    static function findByEmail(string $email): string
    {
        $client = new HttpClient();
        $response = $client->get(static::$url, [
            'email' => $email
        ]);

        return $response->getBody();
    }
}
