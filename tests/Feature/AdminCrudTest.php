<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Admin;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AdminCrudTest extends TestCase
{
    use RefreshDatabase;

    /** @group admin */
    public function test_admin_can_be_created()
    {
        
        $this->withoutExceptionHandling();

        $admin = Admin::create(['role' => Admin::roles()[random_int(0,1)]]);

        $userData = array_merge(User::factory()->make()->toArray(), ['password' => bcrypt('password')]);

        $admin->user()->create($userData);

        $this->assertEquals(1, Admin::count());

        $this->assertNotNull($admin->user);
    }
}
