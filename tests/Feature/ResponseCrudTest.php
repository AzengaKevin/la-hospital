<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Doctor;
use App\Models\Patient;
use App\Models\Response;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ResponseCrudTest extends TestCase
{
    use RefreshDatabase;

    /** @group response */
    public function test_reponse_can_be_create()
    {
        $this->withoutExceptionHandling();

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

        //Create the request
        $request = $patient->user->requests()->create([
            'doctor_id' => $doctor->id,
            'description' => 'Some Illness description'
        ]);

        $request->response()->create([
            'type' => Response::types()[random_int(0,1)],
            'description' => 'Something about the upatients condition',
            'appointment' => [
                'venue' => 'St. Bourneventure San Jose Hospital',
                'date' => '15/02/2021',
                'time' => '10:00 AM',
                'subject' => 'What is the appointent for',
                'cost' => 1500
            ]
        ]);

        $this->assertEquals(1, $request->response()->count());

    }
}
