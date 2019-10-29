<?php


namespace TalentuI33\ActiveCampaign;


use TalentuI33\ActiveCampaign\Models\DealCustomFieldDatumModel;
use TalentuI33\ActiveCampaign\Models\DealCustomFieldModel;
use TalentuI33\ActiveCampaign\Models\DealModel;
use TalentuI33\ActiveCampaign\Providers\DealCustomFieldDatumProvider;
use TalentuI33\ActiveCampaign\Providers\DealCustomFieldProvider;
use TalentuI33\ActiveCampaign\Services\HttpClient;

class DealCustomField
{
    protected static $url = 'dealCustomFieldMeta';
    protected static $customFieldDataUrl = 'dealCustomFieldData';

    public static function getAll(): array
    {
        try {
            $client = new HttpClient();
            $response = $client->get(self::$url);
        } catch (\Exception $exception) {
            throw new $exception;
        }

        return DealCustomFieldProvider::createFromString($response->getBody());
    }

    public static function findByPersonalization(string $personalization): ?DealCustomFieldModel
    {
        try {
            $client = new HttpClient();
            $response = $client->get(static::$url, [
                'filters[personalization]' => $personalization
            ]);

            $responseData = json_decode($response->getBody(), true);
            if (isset($responseData['dealCustomFieldMeta']) && count($responseData['dealCustomFieldMeta']) > 0) {
                return DealCustomFieldModel::create($responseData['dealCustomFieldMeta'][0]);
            }
        } catch (\Exception $exception) {
            throw new $exception;
        }

        return null;
    }

    public static function createCustomFiledValue(DealModel $dealModel, DealCustomFieldModel $customFieldModel, string $fieldValue): DealCustomFieldDatumModel
    {
        try {
            $client = new HttpClient();
            $response = $client->postOrPut(static::$customFieldDataUrl, 'dealCustomFieldDatum', [
                'dealId' => $dealModel->id,
                "customFieldId" => $customFieldModel->id,
                "fieldValue" => $fieldValue,
            ]);
        } catch (\Exception $exception) {
            throw new $exception;
        }

        return DealCustomFieldDatumModel::createFromString($response->getBody());
    }

    public static function createBulkCustomFieldValue(array $customFieldModels): ?bool
    {
        try {
            $client = new HttpClient();
            $client->postOrPut(
                static::$customFieldDataUrl . '/bulkCreate',
                null, $customFieldModels
            );
        } catch (\Exception $exception) {
            throw new $exception;
        }

        return true;
    }

    public static function getCustomFieldDataByDeal(DealModel $deal): array
    {
        try {
            $client = new HttpClient();
            $response = $client->get("deals/{$deal->id}/dealCustomFieldData");
        } catch (\Exception $exception) {
            throw new $exception;
        }

        return DealCustomFieldDatumProvider::createFromString($response->getBody());
    }

    public static function updateBulkCustomFieldValue(array $customFieldModels): bool
    {
        try {
            $client = new HttpClient();
            $client->postOrPut(
                static::$customFieldDataUrl . '/bulkUpdate',
                null, $customFieldModels, 'PATCH'
            );
        } catch (\Exception $exception) {
            throw new $exception;
        }

        return true;
    }
}
