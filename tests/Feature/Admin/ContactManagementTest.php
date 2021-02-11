<?php

namespace Tests\Feature\Admin;

use Tests\TestCase;
use App\Models\User;
use App\Models\Admin;
use App\Models\Contact;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ContactManagementTest extends TestCase
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
    
    /** @group contacts */
    public function test_admin_can_view_all_contacts()
    {
        $this->withoutExceptionHandling();

        $response = $this->get(route('admin.contacts.index'));

        $response->assertOk();

        $response->assertViewIs('admin.contacts.index');

        $response->assertViewHas('contacts');

    }

    /** @group contacts */
    public function test_admin_can_view_a_single_contact_page()
    {
        //Arrange
        $this->withoutExceptionHandling();

        $contact = Contact::factory()->create();

        //Act
        $response = $this->get(route('admin.contacts.show', $contact));
        //Assert

        $response->assertOk();
        $response->assertViewIs('admin.contacts.show');
        $response->assertViewHas('contact');
        
    }

    /** @group contacts */
    public function test_admin_can_delete()
    {
        //Arrange
        $this->withoutExceptionHandling();

        $contact = Contact::factory()->create();

        $this->assertEquals(1, Contact::count());

        //Act
        $response = $this->delete(route('admin.contacts.destroy', $contact));

        $this->assertEquals(0, Contact::count());

        //Assert
        $response->assertRedirect(route('admin.contacts.index'));
        
    }
}
