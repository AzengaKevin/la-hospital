<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Doctor;
use App\Models\Patient;
use App\Models\Response;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ResponsesManagementTest extends TestCase
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

    /** @group responses */
    public function test_admin_can_view_responses_page()
    {
        //Arrange 
        $this->withoutExceptionHandling();

        //Create user and the request
        $patientData = Patient::factory()->make()->toArray();
        $patient = Patient::create($patientData);
        $userData = array_merge(User::factory()->make()->toArray(), ['password' => bcrypt('pa$$word')]);
        $patient->user()->create($userData);

        //Create the request
        $request = $patient->user->requests()->create([
            'doctor_id' => $this->doctor->id,
            'description' => 'Some Illness description'
        ]);

        $request->response()->create([
            'type' => Response::types()[random_int(0,1)],
            'description' => 'Something about the upatients condition',
            'appointment' => [
                'address' => 'St. Bourneventure San Jose Hospital',
                'date' => '15/02/2021',
                'time' => '10:00 AM',
                'subject' => 'What is the appointent for',
                'cost' => 1500
            ]
        ]);

        //Act
        $response = $this->get(route('doctor.requests.responses.index', $request));

        //Assert
        $response->assertOk();

        $response->assertViewIs('doctor.responses.index');

        $response->assertViewHas('request');

    }

    /** @group responses */
    public function test_doctor_can_create_response()
    {
        //Arrange 
        $this->withoutExceptionHandling();

        //Create user and the request
        $patientData = Patient::factory()->make()->toArray();
        $patient = Patient::create($patientData);
        $userData = array_merge(User::factory()->make()->toArray(), ['password' => bcrypt('pa$$word')]);
        $patient->user()->create($userData);

        //Create the request
        $request = $patient->user->requests()->create([
            'doctor_id' => $this->doctor->id,
            'description' => 'Some Illness description'
        ]);

        //Act
        $response = $this->post(route('doctor.requests.responses.store', $request), [
            'type' => 'Appointment',
            'description' => 'Something about the user condition',
            'appointment' => [
                'address' => 'St. Bourneventure San Jose Hospital',
                'date' => '15/02/2021',
                'time' => '10:00 AM',
                'subject' => 'What is the appointent for',
                'cost' => 1500
            ]
        ]);

        //Assert
        $this->assertEquals(1, $request->response()->count());

        $response->assertRedirect(route('doctor.requests.responses.index', $request));
        
    }

    /** @group responses */
    public function test_a_doctor_can_delete_a_response()
    {
        //Arrange 
        $this->withoutExceptionHandling();

        //Create user and the request
        $patientData = Patient::factory()->make()->toArray();
        $patient = Patient::create($patientData);
        $userData = array_merge(User::factory()->make()->toArray(), ['password' => bcrypt('pa$$word')]);
        $patient->user()->create($userData);

        //Create the request
        $request = $patient->user->requests()->create([
            'doctor_id' => $this->doctor->id,
            'description' => 'Some Illness description'
        ]);

        $res = $request->response()->create([
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

        //Act
        $response = $this->delete(route('doctor.requests.responses.destroy', ['request' => $request, 'response' => $res]));

        //Assert
        $this->assertEquals(0, $request->response()->count());

        $response->assertRedirect(route('doctor.requests.responses.index', $request));        
    }
}
