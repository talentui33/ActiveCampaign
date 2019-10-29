<?php


namespace TalentuI33\ActiveCampaign\Services;


use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Psr7\Response;

class HttpClient
{
    private $client = null;

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => config('activecampaign.api_url'),
            'headers' => ['Api-Token' => config('activecampaign.api_key')]
        ]);
    }

    public function get(string $uri, array $params = []): Response
    {
        try {
            return $this->client->request('GET', $uri, [
                'query' => $params
            ]);
        } catch (GuzzleException $e) {
            return abort($e->getCode(), $e->getMessage());
        }
    }

    public function postOrPut(string $uri, string $type = null, array $params = [], string $action = 'POST', string $requestOption = 'json'): Response
    {
        try {
            if (isset($type)) {
                $data = ["{$type}" => $params];
            } else {
                $data = $params;
            }

            return $this->client->request(strtoupper($action), $uri, [
                "{$requestOption}" => $data
            ]);
        } catch (GuzzleException $e) {
            throw new $e;
        }
    }

    public function delete(string $uri): Response
    {
        try {
            return $this->client->request('DELETE', $uri);
        } catch (GuzzleException $e) {
            throw new $e;
        }
    }
}
