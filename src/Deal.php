<?php

namespace TalentuI33\ActiveCampaign;


use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Psr7\Response;

class Deal extends ActiveCampaign
{
    protected static $url = 'deals';

    public function __construct()
    {
        parent::__construct();
    }

    private function init(): void
    {
        parent::__construct();
    }

    public static function add(
        string $contactId,
        string $ownerId,
        string $stageId,
        string $title,
        string $description = '',
        int $value = 0,
        string $currency = 'cop',
        int $status = 0,
        int $percent = null
    ): Response
    {
        $response = null;
        try {
            if (!self::$client instanceof Client) {
                (new Deal)->init();
            }

            $response = self::$client->request('POST', static::$url, [
                'json' => [
                    "deal" => [
                        "contact" => $contactId,
                        "description" => $description,
                        "currency" => strtolower($currency),
                        "owner" => $ownerId,
                        "percent" => $percent,
                        "stage" => $stageId,
                        "status" => $status,
                        "title" => $title,
                        "value" => $value
                    ]
                ]
            ]);
        } catch
        (GuzzleException $e) {
            abort($e->getCode(), $e->getMessage());
        }

        return $response;
    }

    public static function getAll(): Response
    {
        $response = null;

        try {
            if (!self::$client instanceof Client) {
                (new Deal())->init();
            }

            $response = self::$client->request('GET', static::$url);
        } catch (GuzzleException $e) {
            abort($e->getCode(), $e->getMessage());
        }

        return $response;
    }
}
