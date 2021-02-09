<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PagesTest extends TestCase
{
    /** @group pages */
    public function test_about_page_can_be_visited()
    {
        $this->withoutExceptionHandling();

        $response = $this->get(route('about'));

        $response->assertOk();

        $response->assertViewIs('pages.about');
    }

    /** @group pages */
    public function test_contact_page_can_be_visited()
    {
        
        $this->withoutExceptionHandling();

        $response = $this->get(route('contact'));

        $response->assertOk();

        $response->assertViewIs('pages.contact');
    }
}
