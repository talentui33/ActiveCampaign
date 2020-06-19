<?php


namespace TalentuI33\ActiveCampaign\Models;


class TagModel
{
    public $id = null;
    public $tag = null;
    public $description = null;
    public $tagType = null;
    public $cDate = null;
    public $links = null;

    public static function create(array $metaData): self
    {
        $meta = new self();

        $meta->id = $metaData['id'] ?? null;
        $meta->tag = $metaData['tag'] ?? null;
        $meta->description = $metaData['description'] ?? null;
        $meta->tagType = $metaData['tagType'] ?? null;
        $meta->cDate = $metaData['cdate'] ?? null;
        $meta->links = $metaData['links'] ?? null;

        return $meta;
    }

    public static function createFromString(string $metaData): self
    {
        $tagObject = json_decode($metaData, true);
        return self::create($tagObject['tags']);
    }

    public function validate(Validator)
    {

    }
}
