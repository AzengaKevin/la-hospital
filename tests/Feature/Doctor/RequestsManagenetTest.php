<?php

namespace Tests\Feature\Doctor;

use Tests\TestCase;
use App\Models\User;
use App\Models\Doctor;
use App\Models\Patient;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RequestsManagenetTest extends TestCase
{
    use RefreshDatabase;

    private $doctor;

    public function setUp() : void
    {
        parent::setUp();

        $doctorData = Doctor::factory()->make()->toArray();
        $this->doctor = Doctor::create($doctorData);
        $userData = array_merge(User::factory()->make()->toArray(), ['password' => bcrypt('pa$$word')]);
        $this->doctor->user()->create($userData);

        $this->be($this->doctor->user);
    }
    
    /** @group doctors */
    public function test_a_dotor_can_view_all_requests_sent_to_them()
    {
        $this->withoutExceptionHandling();

        $response = $this->get(route('doctor.requests.index'));

        $response->assertOk();

        $response->assertViewIs('doctor.requests.index');
        
        $response->assertViewHas('requests');
    }

    /** @group doctors */
    public function test_a_doctor_can_view_detailed_view_of_requests_sent_to_them()
    {
        $this->withoutExceptionHandling();

        $patientData = Patient::factory()->make()->toArray();
        $patient = Patient::create($patientData);
        $userData = array_merge(User::factory()->make()->toArray(), ['password' => bcrypt('pa$$word')]);
        $patient->user()->create($userData);

        $request = $patient->user->requests()->create([
            'doctor_id' => $this->doctor->id,
            'description' => 'Some unwell condition description'
        ]);

        $response = $this->get(route('doctor.requests.show', $request));

        $response->assertOk();

        $response->assertViewIs('doctor.requests.show');

        $response->assertViewHas('request');
    }
}
