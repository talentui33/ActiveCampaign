<?php


namespace TalentuI33\ActiveCampaign;


use Exception;
use TalentuI33\ActiveCampaign\Models\UserModel;
use TalentuI33\ActiveCampaign\Services\HttpClient;

class User
{
    protected static $url = 'users';

    public static function findByEmail(string $email): ?UserModel
    {
        try {
            $client = new HttpClient();
            $response = $client->get(self::$url . "/email/$email");

            $responseData = json_decode($response->getBody(), true);
            if (isset($responseData) && count($responseData['user']) > 0) {
                return UserModel::create($responseData['user']);
            }
        } catch (Exception $exception) {
            throw $exception;
        }
        return null;
    }
}
