<?php

namespace Tests\Feature\Admin;

use Tests\TestCase;
use App\Models\User;
use App\Models\Admin;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DashboardTest extends TestCase
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
    
    /** @group dashboard */
    public function test_admin_can_visit_dashboard()
    {
        $this->withoutExceptionHandling();

        $response = $this->get(route('admin.dashboard'));

        $response->assertOk();
    }
}
