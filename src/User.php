<?php


namespace TalentuI33\ActiveCampaign;


use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Psr7\Response;

class User extends ActiveCampaign
{
    protected static $url = 'users';

    public function __construct()
    {
        parent::__construct();
    }

    private function init(): void
    {
        parent::__construct();
    }

    public static function getByEmail(string $email): Response
    {
        $response = null;
        try {
            if (!self::$client instanceof Client) {
                (new User())->init();
            }

            $response = self::$client->request('GET', self::$url . "/email/$email");
        } catch (GuzzleException $e) {
            abort($e->getCode(), $e->getMessage());
        }

        return $response;
    }
}
