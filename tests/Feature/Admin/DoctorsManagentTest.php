<?php

namespace Tests\Feature\Admin;

use Tests\TestCase;
use App\Models\User;
use App\Models\Admin;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DoctorsManagentTest extends TestCase
{
    use RefreshDatabase;

    public function setUp() : void
    {
        parent::setUp();

        $admin = Admin::create(['role' => Admin::roles()[random_int(0,1)]]);
        $userData = array_merge(User::factory()->make()->toArray(), ['password' => bcrypt('password')]);
        $user = $admin->user()->create($userData); 
        
        $this->actingAs($user);
    }

    /** @group doctors */
    public function test_admin_can_view_all_doctors()
    {
        $this->withoutExceptionHandling();

        $response = $this->get(route('admin.doctors.index'));

        $response->assertOk();

        $response->assertViewIs('admin.doctors.index');

        $response->assertViewHas('doctors');

    }
}
