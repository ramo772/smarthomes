<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class GuestApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_crud()
    {
        // Create
        $response = $this->postJson('/api/guests', ['name' => 'Alice']);
        $response->assertStatus(201)->assertJson(['name' => 'Alice']);
        $guestId = $response->json('id');

        // Read
        $this->getJson("/api/guests/{$guestId}")
            ->assertStatus(200)
            ->assertJson(['id' => $guestId, 'name' => 'Alice']);

        // Update
        $this->putJson("/api/guests/{$guestId}", ['name' => 'Bob'])
            ->assertStatus(200)
            ->assertJson(['id' => $guestId, 'name' => 'Bob']);

        // Index
        $this->getJson('/api/guests')
            ->assertStatus(200)
            ->assertJsonFragment(['name' => 'Bob']);

        // Delete
        $this->deleteJson("/api/guests/{$guestId}")
            ->assertStatus(204);

        $this->assertDatabaseMissing('guests', ['id' => $guestId]);
    }
}
