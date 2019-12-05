<?php


namespace TalentuI33\ActiveCampaign\Providers;


use TalentuI33\ActiveCampaign\Models\TagModel;

class TagProvider
{
    public static function createFromString(string $metaData): array
    {
        $tags = array();
        $tagObject = json_decode($metaData, true);
        foreach ($tagObject['tags'] as $tag) {
            array(array_push($tags, TagModel::create($tag)));
        }

        return $tags;
    }
}
