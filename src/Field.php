<?php


namespace TalentuI33\ActiveCampaign;


use TalentuI33\ActiveCampaign\Models\FieldModel;
use TalentuI33\ActiveCampaign\Providers\FieldProvider;
use TalentuI33\ActiveCampaign\Services\HttpClient;

class Field
{
    private static $url = 'fields';

    public static function getAll(): array
    {
        try {
            $client = new HttpClient();
            $response = $client->get(self::$url);
        } catch (\Exception $exception) {
            throw $exception;
        }

        return FieldProvider::createFromString($response->getBody());
    }

    public static function getByPerStag(string $perStag): ?FieldModel
    {
        $fields = self::getAll();

        $field = FieldProvider::filter('per_stag', $perStag, $fields);

        return $field;
    }
}
