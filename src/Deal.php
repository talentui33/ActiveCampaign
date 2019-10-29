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
        try {
            $client = new HttpClient();
            $response = $client->postOrPut(static::$url, 'deal', self::makeDealData($deal));
        } catch (\Exception $exception) {
            throw new $exception;
        }
        return DealModel::createFromString($response->getBody());
    }

    public static function getAll(): array
    {
        try {
            $client = new HttpClient();
            $response = $client->get(self::$url);
        } catch (\Exception $exception) {
            throw new $exception;
        }

        return DealProvider::createFromString($response->getBody());
    }

    public static function findById(string $id): ?DealModel
    {
        try {
            $client = new HttpClient();
            $response = $client->get(self::$url . "/{$id}");

            $responseData = json_decode($response->getBody(), true);
            if (!isset($responseData['deal'])) {
                return null;
            }
        }catch (\Exception $exception){
            throw new $exception;
        }
        return DealModel::create($responseData['deal']);
    }

    public static function updateDeal(DealModel $deal): ?DealModel
    {
        try {
            $client = new HttpClient();
            $response = $client->postOrPut(
                self::$url . "/{$deal->id}",
                'deal',
                self::makeDealData($deal),
                'PUT'
            );
        } catch (\Exception $exception) {
            throw new $exception;
        }

        return DealModel::createFromString($response->getBody());
    }

    private static function makeDealData(DealModel $deal): array
    {
        return [
            'contact' => $deal->contact,
            'description' => $deal->description,
            'currency' => strtolower($deal->currency),
            'owner' => $deal->owner,
            'percent' => $deal->percent,
            'stage' => $deal->stage,
            'status' => $deal->status,
            'title' => $deal->title,
            'value' => $deal->value
        ];
    }
}
