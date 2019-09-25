<?php


namespace TalentuI33\ActiveCampaign;


use TalentuI33\ActiveCampaign\Models\DealCustomFieldModel;
use TalentuI33\ActiveCampaign\Providers\DealCustomFieldProvider;
use TalentuI33\ActiveCampaign\Services\HttpClient;

class DealCustomField
{
    protected static $url = 'dealCustomFieldMeta';

    public static function getAll(): array
    {
        $client = new HttpClient();
        $response = $client->get(self::$url);

        return DealCustomFieldProvider::createFromString($response->getBody());
    }
}
