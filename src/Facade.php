<?php


namespace talentui33\ActiveCampaign;

class Facade extends \Illuminate\Support\Facades\Facade
{
    protected static function getFacadeAccessor(): string
    {
        return ActiveCampaign::class;
    }
}
