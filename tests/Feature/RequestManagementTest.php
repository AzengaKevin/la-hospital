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

    private $user;

    public function setUp() : void
    {
        parent::setUp();

        $patientData = Patient::factory()->make()->toArray();

        $patient = Patient::create($patientData);

        $userData = array_merge(User::factory()->make()->toArray(), ['password' => bcrypt('pa$$word')]);

        $this->user = $patient->user()->create($userData);

        $this->actingAs($this->user);
    }
    
    /** @group requests */
    public function test_a_patient_can_view_all_own_requests()
    {
        $this->withoutExceptionHandling();

        $response = $this->get(route('requests.index'));

        $response->assertOk();

        $response->assertViewIs('requests.index');

        $response->assertViewHas('requests');
    }

    /** @group requests */
    public function test_a_user_can_view_create_request_page()
    {
        $this->withoutExceptionHandling();

        $response = $this->get(route('requests.create'));

        $response->assertOk();

        $response->assertViewIs('requests.create');

        $response->assertViewHas('doctors');
    }

    /** @group requests */
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

    /** @group requests */
    public function test_a_user_can_view_existing_request_for_responses()
    {
        $this->withoutExceptionHandling();

        $doctorData = Doctor::factory()->make()->toArray();
        $doctor = Doctor::create($doctorData);
        $userData = array_merge(User::factory()->make()->toArray(), ['password' => bcrypt('pa$$word')]);
        $doctor->user()->create($userData);

        $request = $this->user->requests()->create([
            'doctor_id' => $doctor->id,
            'description' => 'Some Illness description'
        ]);

        $this->assertEquals(1, \App\Models\Request::count());
        
        $response = $this->get(route('requests.show', $request));

        $response->assertOk();

        $response->assertViewIs('requests.show');

        $response->assertViewHas('request');
    }

    /** @group requests */
    public function test_a_user_can_visit_edit_request_page()
    {
        $this->withoutExceptionHandling();

        $doctorData = Doctor::factory()->make()->toArray();
        $doctor = Doctor::create($doctorData);
        $userData = array_merge(User::factory()->make()->toArray(), ['password' => bcrypt('pa$$word')]);
        $doctor->user()->create($userData);

        $request = $this->user->requests()->create([
            'doctor_id' => $doctor->id,
            'description' => 'Some Illness description'
        ]);

        $this->assertEquals(1, \App\Models\Request::count());
        
        $response = $this->get(route('requests.edit', $request));

        $response->assertOk();

        $response->assertViewIs('requests.edit');

        $response->assertViewHasAll(['request', 'doctors']);        
    }

    /** @group requests */
    public function test_a_user_can_update_own_request()
    {
        $this->withoutExceptionHandling();

        $doctorData = Doctor::factory()->make()->toArray();
        $doctor = Doctor::create($doctorData);
        $userData = array_merge(User::factory()->make()->toArray(), ['password' => bcrypt('pa$$word')]);
        $doctor->user()->create($userData);

        $request = $this->user->requests()->create([
            'doctor_id' => $doctor->id,
            'description' => 'Some Illness description'
        ]);

        $this->assertEquals(1, \App\Models\Request::count());
        
        $response = $this->patch(route('requests.update', $request), [
            'doctor_id' => $doctor->id,
            'description' => 'Updated description'
        ]);

        $this->assertEquals('Updated description', $request->fresh()->description);

        $response->assertRedirect(route('requests.show', $request->fresh()));
        
    }

    /** @group requests */
    public function test_a_user_can_delete_own_request()
    {
        $this->withoutExceptionHandling();

        $doctorData = Doctor::factory()->make()->toArray();
        $doctor = Doctor::create($doctorData);
        $userData = array_merge(User::factory()->make()->toArray(), ['password' => bcrypt('pa$$word')]);
        $doctor->user()->create($userData);

        $request = $this->user->requests()->create([
            'doctor_id' => $doctor->id,
            'description' => 'Some Illness description'
        ]);

        $this->assertEquals(1, \App\Models\Request::count());
        
        $response = $this->delete(route('requests.destroy', $request));

        $this->assertEquals(0, \App\Models\Request::count());

        $response->assertRedirect(route('requests.index'));        
    }
}
