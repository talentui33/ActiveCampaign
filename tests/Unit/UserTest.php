<?php


namespace Tests\Unit;


use TalentuI33\ActiveCampaign\Models\UserModel;
use TalentuI33\ActiveCampaign\User;
use Tests\TestCase;

class UserTest extends TestCase
{
    public function testGetUserByEmail(): void
    {
        $user = User::findByEmail($this->userEmail);

        $this->assertTrue($user instanceof UserModel || $user === null);
    }
}
