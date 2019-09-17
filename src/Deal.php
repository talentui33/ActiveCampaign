<?php

namespace TalentuI33\ActiveCampaign;


use TalentuI33\ActiveCampaign\Services\HttpClient;

class Deal
{
    protected static $url = 'deals';

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
    ): string
    {
        $client = new HttpClient();
        $response = $client->postOrPut(static::$url, 'deal', [
            'contact' => $contactId,
            'description' => $description,
            'currency' => strtolower($currency),
            'owner' => $ownerId,
            'percent' => $percent,
            'stage' => $stageId,
            'status' => $status,
            'title' => $title,
            'value' => $value
        ]);

        return $response->getBody();
    }

    public static function getAll(): string
    {

        $client = new HttpClient();
        $response = $client->get(self::$url);

        return $response->getBody();
    }
}
