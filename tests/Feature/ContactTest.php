<?php

namespace Tests\Feature;

use App\Models\ContactRequest;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ContactTest extends TestCase
{
    use RefreshDatabase;

    public function test_contact_page_returns_successful_response(): void
    {
        $response = $this->get(route('contact'));

        $response->assertStatus(200);
        $response->assertInertia(fn ($page) => $page->component('Contact'));
    }

    public function test_contact_form_requires_valid_data(): void
    {
        $response = $this->post(route('contact.store'), [
            'name' => '',
            'email' => 'not-an-email',
            'subject' => 'general',
            'message' => 'Hi',
        ]);

        $response->assertSessionHasErrors(['name', 'email']);
    }

    public function test_contact_form_accepts_valid_submission(): void
    {
        $response = $this->post(route('contact.store'), [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'company' => 'Acme Ltd',
            'subject' => 'general',
            'message' => 'Hello, I would like to know more.',
        ]);

        $response->assertRedirect(route('contact'));
        $response->assertSessionHas('success', true);

        $this->assertDatabaseHas('contact_requests', [
            'email' => 'test@example.com',
            'name' => 'Test User',
            'subject' => 'general',
        ]);
    }
}
