<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Doctor;
use App\Models\Patient;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserCrudTest extends TestCase
{
    use RefreshDatabase;

    /** @group user */
    public function test_a_patient_can_be_created()
    {
        $this->withoutExceptionHandling();

        $patientData = Patient::factory()->make()->toArray();

        $patient = Patient::create($patientData);

        $userData = array_merge(User::factory()->make()->toArray(), ['password' => bcrypt('pa$$word')]);

        $patient->user()->create($userData);

        $this->assertTrue(User::where('email', $userData['email'])->exists());
        $this->assertTrue(User::where('phone', $userData['phone'])->exists());

        $this->assertNotNull(Patient::first()->user);

    }

    /** @group user */
    public function test_a_doctor_can_be_create()
    {
        $this->withoutExceptionHandling();

        $doctorData = Doctor::factory()->make()->toArray();

        $doctor = Doctor::create($doctorData);

        $userData = array_merge(User::factory()->make()->toArray(), ['password' => bcrypt('pa$$word')]);

        $doctor->user()->create($userData);

        $this->assertTrue(Doctor::where('speciality', $doctorData['speciality'])->exists());

        $this->assertNotNull(Doctor::first()->user);
        
    }


}
