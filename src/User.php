<?php


namespace TalentuI33\ActiveCampaign;


use TalentuI33\ActiveCampaign\Models\UserModel;
use TalentuI33\ActiveCampaign\Services\HttpClient;

class User
{
    protected static $url = 'users';

    public static function findByEmail(string $email): ?UserModel
    {
        $client = new HttpClient();
        $response = $client->get(self::$url . "/email/$email");

        $responseData = json_decode($response->getBody(), true);
        if (isset($responseData) && count($responseData['user']) > 0) {
            return UserModel::create($responseData['user']);
        }

        return null;
    }
}
