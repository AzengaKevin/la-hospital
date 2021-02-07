<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Doctor;
use App\Models\Patient;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserRegisterationTest extends TestCase
{
    use RefreshDatabase;

    /** @group registration */
    public function test_guests_can_view_registration_page()
    {
        $this->withoutExceptionHandling();

        $response = $this->get(route('register'));

        $response->assertOk();

        $response->assertViewIs('auth.register');
    }

    /** @group registration */
    public function test_a_doctor_can_successfully_register()
    {
        $this->withoutExceptionHandling();

        // Arrange
        $userData = User::factory()->make()->toArray();
        unset($userData['email_verified_at']);
        array_values($userData);
        $userData['password'] = bcrypt('pa$$word');

        $doctorData = Doctor::factory()->make()->toArray();

        //Act
        $response = $this->post(route('register'), [
            'user' => $userData,
            'doctor' => $doctorData,
            'type' => 'doctor'
        ]);

        $this->assertEquals(1, Doctor::count());

        $this->assertNotNull(Doctor::first()->user);

        //Assert
        $this->assertAuthenticated();
        $response->assertRedirect(route('home'));
        
    }

    public function test_a_patient_can_register_successfully()
    {
        $this->withoutExceptionHandling();

        // Arrange
        $userData = User::factory()->make()->toArray();
        unset($userData['email_verified_at']);
        array_values($userData);
        $userData['password'] = bcrypt('pa$$word');

        $patientData = Patient::factory()->make()->toArray();

        //Act
        $response = $this->post(route('register'), [
            'user' => $userData,
            'patient' => $patientData,
            'type' => 'patient'
        ]);

        $this->assertEquals(1, Patient::count());

        $this->assertNotNull(Patient::first()->user);

        //Assert
        $this->assertAuthenticated();
        $response->assertRedirect(route('home'));
    }

}
