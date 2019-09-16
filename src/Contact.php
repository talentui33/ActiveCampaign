<?php

namespace TalentuI33\ActiveCampaign;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Psr7\Response;

class Contact extends ActiveCampaign
{
    protected static $url = 'contacts';

    public function __construct()
    {
        parent::__construct();
    }

    private function init(): void
    {
        parent::__construct();
    }

    public static function add(string $firstName, string $lastName, string $email, string $phone): Response
    {
        $response = null;
        try {
            if (!self::$client instanceof Client) {
                (new Contact)->init();
            }

            $response = self::$client->request('POST', static::$url, [
                'json' => [
                    "contact" => [
                        "email" => $email,
                        "firstName" => $firstName,
                        "lastName" => $lastName,
                        "phone" => $phone
                    ]
                ]
            ]);
        } catch (GuzzleException $e) {
            abort($e->getCode(), $e->getMessage());
        }

        return $response;
    }

    public static function update(string $id, string $firstName = null, string $lastName = null, string $email = null, string $phone = null): Response
    {
        $response = null;

        try {
            if (!self::$client instanceof Client) {
                (new Contact)->init();
            }

            $data = collect();

            if (!empty($firstName)) {
                $data->put("firstName", $firstName);
            }

            if (!empty($lastName)) {
                $data->put("lastName", $lastName);
            }

            if (!empty($email)) {
                $data->put("email", $email);
            }

            if (!empty($phone)) {
                $data->put("phone", $phone);
            }

            $jsonData = ['contact' => $data->toArray()];

            $response = self::$client->request('PUT', static::$url . "/{$id}", [
                'json' => $jsonData
            ]);
        } catch (GuzzleException $e) {
            abort($e->getCode(), $e->getMessage());
        }

        return $response;
    }

    public static function delete(string $id): Response
    {
        $response = null;
        try {
            if (!self::$client instanceof Client) {
                (new Contact)->init();
            }

            $response = self::$client->request('DELETE', static::$url . "/{$id}");
        } catch (GuzzleException $e) {
            abort($e->getCode(), $e->getMessage());
        }

        return $response;
    }

    public static function getAll(): Response
    {
        $response = null;

        try {
            if (!self::$client instanceof Client) {
                (new Contact)->init();
            }

            $response = self::$client->request('GET', static::$url);
        } catch (GuzzleException $e) {
            abort($e->getCode(), $e->getMessage());
        }

        return $response;
    }

    public static function getByEmail(string $email): Response
    {
        $response = null;
        try {
            if (!self::$client instanceof Client) {
                (new Contact)->init();
            }

            $response = self::$client->request('GET', static::$url . "?email={$email}");
        } catch (GuzzleException $e) {
            abort($e->getCode(), $e->getMessage());
        }

        return $response;
    }
}
