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
        $client = new HttpClient();
        $response = $client->get(self::$url);

        return DealCustomFieldProvider::createFromString($response->getBody());
    }

    public static function findByPersonalization(string $personalization): ?DealCustomFieldModel
    {
        $client = new HttpClient();
        $response = $client->get(static::$url, [
            'filters[personalization]' => $personalization
        ]);

        $responseData = json_decode($response->getBody(), true);
        if (isset($responseData['dealCustomFieldMeta']) && count($responseData['dealCustomFieldMeta']) > 0) {
            return DealCustomFieldModel::create($responseData['dealCustomFieldMeta'][0]);
        }
        return null;
    }

    public static function createCustomFiledValue(DealModel $dealModel, DealCustomFieldModel $customFieldModel, string $fieldValue): DealCustomFieldDatumModel
    {
        $client = new HttpClient();
        $response = $client->postOrPut(static::$customFieldDataUrl, 'dealCustomFieldDatum', [
            'dealId' => $dealModel->id,
            "customFieldId" => $customFieldModel->id,
            "fieldValue" => $fieldValue,
        ]);

        return DealCustomFieldDatumModel::createFromString($response->getBody());
    }

    public static function createBulkCustomFieldValue(array $customFieldModels): ?bool
    {
        $client = new HttpClient();
        $client->postOrPut(
            static::$customFieldDataUrl . '/bulkCreate',
            null, $customFieldModels
        );

        return true;
    }

    public static function getCustomFieldDataByDeal(DealModel $deal): array
    {
        $client = new HttpClient();
        $response = $client->get("deals/{$deal->id}/dealCustomFieldData");

        return DealCustomFieldDatumProvider::createFromString($response->getBody());
    }

    public static function updateBulkCustomFieldValue(array $customFieldModels): bool
    {
        $client = new HttpClient();
        $client->postOrPut(
            static::$customFieldDataUrl . '/bulkUpdate',
            null, $customFieldModels,'PATCH'
        );

        return true;
    }
}
