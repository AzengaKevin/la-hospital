<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Doctor;
use App\Models\Patient;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RequestManagementTest extends TestCase
{
    use RefreshDatabase;

    public function setUp() : void
    {
        parent::setUp();

        $patientData = Patient::factory()->make()->toArray();

        $patient = Patient::create($patientData);

        $userData = array_merge(User::factory()->make()->toArray(), ['password' => bcrypt('pa$$word')]);

        $patient->user()->create($userData);

        $this->actingAs(Patient::first()->user);
    }
    
    /** @group patient-requests */
    public function test_a_patient_can_view_all_own_requests()
    {
        $this->withoutExceptionHandling();

        $response = $this->get(route('requests.index'));

        $response->assertOk();

        $response->assertViewIs('requests.index');

        $response->assertViewHas('requests');
    }

    /** @group patient-requests */
    public function test_a_user_can_view_create_request_page()
    {
        $this->withoutExceptionHandling();

        $response = $this->get(route('requests.create'));

        $response->assertOk();

        $response->assertViewIs('requests.create');

        $response->assertViewHas('doctors');
    }

    /** @group patient-requests */
    public function test_a_user_can_create_a_request()
    {
        $this->withoutExceptionHandling();

        $doctorData = Doctor::factory()->make()->toArray();
        $doctor = Doctor::create($doctorData);
        $userData = array_merge(User::factory()->make()->toArray(), ['password' => bcrypt('pa$$word')]);
        $doctor->user()->create($userData);

        $response = $this->post(route('requests.store'), [
            'doctor_id' => $doctor->id,
            'description' => 'Stomach Ache'
        ]);

        $this->assertEquals(1, \App\Models\Request::count());

        $response->assertRedirect(route('requests.index'));
    }
}
