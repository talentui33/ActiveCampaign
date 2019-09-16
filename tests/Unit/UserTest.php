<?php


namespace Tests\Unit;


use Illuminate\Http\Response;
use TalentuI33\ActiveCampaign\User;
use Tests\TestCase;

class UserTest extends TestCase
{
    public function testGetUserByEmail(): void
    {
        $response = User::getByEmail($this->userEmail);

        $this->assertTrue($response->getStatusCode() === Response::HTTP_OK);
    }
}
