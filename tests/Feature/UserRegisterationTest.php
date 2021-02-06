<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserRegisterationTest extends TestCase
{

    /** @group users */
    public function test_guests_can_view_registration_page()
    {
        $this->withoutExceptionHandling();

        $response = $this->get(route('register'));

        $response->assertOk();

        $response->assertViewIs('auth.register');
    }

}
