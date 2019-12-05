<?php /** @noinspection PhpUnhandledExceptionInspection */


namespace TalentuI33\ActiveCampaign;


use TalentuI33\ActiveCampaign\Models\TagModel;
use TalentuI33\ActiveCampaign\Providers\FieldProvider;
use TalentuI33\ActiveCampaign\Providers\TagProvider;
use TalentuI33\ActiveCampaign\Services\HttpClient;

class Tag
{
    private static $url = 'tags';

    public static function getAll(string $tagName = null)
    {
        try {
            $client = new HttpClient();
            $response = $client->get(self::$url,
                [
                    'limit' => 100,
                    'search' => $tagName
                ]
            );
        } catch (\Exception $exception) {
            throw $exception;
        }

        return TagProvider::createFromString($response->getBody());
    }

    public static function getTagById(string $id): ?TagModel
    {
        try {
            $client = new HttpClient();
            $response = $client->get(static::$url . "/$id");
            $responseData = json_decode($response->getBody(), true);
            if (!isset($responseData['tag'])) {
                return null;
            }

            return TagModel::create($responseData['tag']);
        } catch (\Exception $exception) {
            throw $exception;
        }
    }
}
