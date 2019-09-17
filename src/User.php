<?php


namespace TalentuI33\ActiveCampaign;


use TalentuI33\ActiveCampaign\Services\HttpClient;

class User
{
    protected static $url = 'users';

    public static function findByEmail(string $email): string
    {
        $client = new HttpClient();
        $response = $client->get(self::$url . "/email/$email");

        return $response->getBody();
    }
}
