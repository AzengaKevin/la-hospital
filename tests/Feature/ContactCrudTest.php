<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Contact;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ContactCrudTest extends TestCase
{
    use RefreshDatabase;
    
    /** @group contacts */
    public function test_contact_can_be_created()
    {
        //Arrange
        $this->withoutExceptionHandling();
        $contactData = Contact::factory()->make()->toArray();

        //Act
        Contact::create($contactData);


        //Assert
        $this->assertEquals(1, Contact::count());
    }
}
