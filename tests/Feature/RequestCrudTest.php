<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Doctor;
use App\Models\Patient;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RequestCrudTest extends TestCase
{
    use RefreshDatabase;
    
    /** @group requests */
    public function test_a_request_can_be_created()
    {
        //Create the Doctor
        $doctorData = Doctor::factory()->make()->toArray();
        $doctor = Doctor::create($doctorData);
        $doctorUserData = array_merge(User::factory()->make()->toArray(), ['password' => bcrypt('pa$$word')]);
        $doctor->user()->create($doctorUserData);

        //Create user and the request
        $patientData = Patient::factory()->make()->toArray();
        $patient = Patient::create($patientData);
        $userData = array_merge(User::factory()->make()->toArray(), ['password' => bcrypt('pa$$word')]);
        $patient->user()->create($userData);

        $patient->user->requests()->create([
            'doctor_id' => $doctor->id,
            'description' => 'Some Illness description'
        ]);

        $this->assertEquals(1, $patient->user->requests()->count());
    }
}
