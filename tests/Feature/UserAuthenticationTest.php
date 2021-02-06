<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserAuthenticationTest extends TestCase
{

    /** @group users */
    public function test_guests_can_view_login_page()
    {
        $this->withoutExceptionHandling();

        $response = $this->get(route('login'));

        $response->assertOk();

        $response->assertViewIs('auth.login');
    }
}
