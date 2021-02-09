<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DoctorsManagementTest extends TestCase
{
    use RefreshDatabase;
    
    /** @group doctors */
    public function test_any_site_visitor_can_view_available_doctors()
    {
        $this->withoutExceptionHandling();

        $response = $this->get(route('doctors.index'));

        $response->assertOk();
    }
}
