<?php


namespace TalentuI33\ActiveCampaign;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class ActiveCampaign
{
    private $url;
    private $api_key;
    public static $client;

    public function __construct()
    {
        $this->url = config('activecampaign.api_url');
        $this->api_key = config('activecampaign.api_key');
        self::$client = new Client([
            'base_uri' => $this->url,
            'headers' => ['Api-Token' => $this->api_key]
        ]);
    }

    public function testConnection(): bool
    {
        try {
            $response = self::$client->request('GET', '');
            if ($response->getStatusCode() !== 200) {
                return false;
            }
        } catch (GuzzleException $e) {
            abort($e->getCode(), $e->getMessage());
        }

        return true;
    }
}
