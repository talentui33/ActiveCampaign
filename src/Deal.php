<?php

namespace TalentuI33\ActiveCampaign;


use TalentuI33\ActiveCampaign\Models\DealModel;
use TalentuI33\ActiveCampaign\Providers\DealProvider;
use TalentuI33\ActiveCampaign\Services\HttpClient;

class Deal
{
    protected static $url = 'deals';

    public static function add(DealModel $deal): DealModel
    {
        $client = new HttpClient();
        $response = $client->postOrPut(static::$url, 'deal', [
            'contact' => $deal->contact,
            'description' => $deal->description,
            'currency' => strtolower($deal->currency),
            'owner' => $deal->owner,
            'percent' => $deal->percent,
            'stage' => $deal->stage,
            'status' => $deal->status,
            'title' => $deal->title,
            'value' => $deal->value
        ]);

        return DealModel::createFromString($response->getBody());
    }

    public static function getAll(): array
    {

        $client = new HttpClient();
        $response = $client->get(self::$url);

        return DealProvider::createFromString($response->getBody());
    }

    public static function findById(string $id): ?DealModel
    {
        $client = new HttpClient();
        $response = $client->get(self::$url."/$id");

        $responseData = json_decode($response->getBody(), true);
        if (!isset($responseData['deal'])) {
            return null;
        }

        return DealModel::create($responseData['deal']);
    }
}
