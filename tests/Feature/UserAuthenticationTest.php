<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Doctor;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserAuthenticationTest extends TestCase
{
    use RefreshDatabase;

    /** @group users */
    public function test_guests_can_view_login_page()
    {
        $this->withoutExceptionHandling();

        $response = $this->get(route('login'));

        $response->assertOk();

        $response->assertViewIs('auth.login');
    }

    /** @group users */
    public function test_any_user_can_authenticate()
    {
        //Arrange
        $this->withoutExceptionHandling();

        $doctorData = Doctor::factory()->make()->toArray();

        $doctor = Doctor::create($doctorData);

        $userData = array_merge(User::factory()->make()->toArray(), ['password' => bcrypt('pa$$word')]);

        $doctor->user()->create($userData);

        //Act
        $response = $this->post(route('login'), [
            'email' => $userData['email'],
            'password' => 'pa$$word',
        ]);

        //Assertions
        $this->assertAuthenticated();

        $response->assertRedirect(route('home'));

        
    }
}