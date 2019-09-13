<?php

namespace talentui33\ActiveCampaign;


use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class Contact extends ActiveCampaign
{
    public function __construct()
    {
        parent::__construct();
    }

    private function init(): void
    {
        parent::__construct();
    }

    public static function getAll(): string
    {
        $response = null;

        try {
            if (!self::$client instanceof Client) {
                (new Contact)->init();
            }
            $response = self::$client->request('GET', 'contacts');
        } catch (GuzzleException $e) {
            abort($e->getCode(), $e->getMessage());
        }

        return (string)$response->getBody();
    }
}
