<?php


namespace Tests\Unit;


use Illuminate\Http\Response;
use TalentuI33\ActiveCampaign\User;
use Tests\TestCase;

class UserTest extends TestCase
{
    public function testGetUserByEmail(): void
    {
        $user = User::findByEmail($this->userEmail);

        $this->assertJson($user);
    }
}
