<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Contact;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ContactsManagmentTest extends TestCase
{
    use RefreshDatabase;

    /** @group contacts */
    public function test_a_guest_or_user_can_contact()
    {
        $this->withoutExceptionHandling();

        $contactData = Contact::factory()->make()->toArray();

        $response = $this->post(route('contacts.store'), $contactData);

        $response->assertRedirect(route('contact'));
    }
}
