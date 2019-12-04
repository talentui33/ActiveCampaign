<?php
/** @noinspection PhpUnhandledExceptionInspection */


namespace TalentuI33\ActiveCampaign;


use TalentuI33\ActiveCampaign\Models\ContactModel;
use TalentuI33\ActiveCampaign\Models\FieldModel;
use TalentuI33\ActiveCampaign\Models\FieldValueModel;
use TalentuI33\ActiveCampaign\Providers\FieldProvider;
use TalentuI33\ActiveCampaign\Providers\FieldValeProvider;
use TalentuI33\ActiveCampaign\Services\HttpClient;

class Field
{
    private static $url = 'fields';
    private static $fieldValuesUrl = 'fieldValues';
    private static $fieldValueTypeRequest = 'fieldValue';

    public static function getAll(): array
    {
        try {
            $client = new HttpClient();
            $response = $client->get(self::$url, ['limit' => 100]);
        } catch (\Exception $exception) {
            throw $exception;
        }

        return FieldProvider::createFromString($response->getBody());
    }

    public static function getByPerStag(string $perStag): ?FieldModel
    {
        $fields = self::getAll();
        return FieldProvider::filter('per_stag', $perStag, $fields);
    }

    public static function getAllFieldValues(): array
    {
        try {
            $client = new HttpClient();
            $response = $client->get(self::$fieldValuesUrl, [
                'limit' => 100,
            ]);
        } catch (\Exception $exception) {
            throw $exception;
        }

        return FieldValeProvider::createFromString($response->getBody());
    }

    public static function updateOrCreateFieldValue(
        ContactModel $contact,
        FieldValueModel $fieldValue,
        string $action = 'POST'
    ): ?bool
    {
        $url = strtoupper($action) === 'POST'
            ? self::$fieldValuesUrl
            : self::$fieldValuesUrl . "/{$fieldValue->id}";
        
        try {
            $client = new HttpClient();
            $client->postOrPut($url,
                self::$fieldValueTypeRequest, [
                    "contact" => $contact->id,
                    "field" => $fieldValue->field,
                    "value" => $fieldValue->value
                ],
                strtoupper($action)
            );
        } catch (\Exception $exception) {
            throw $exception;
        }

        return true;
    }
}
