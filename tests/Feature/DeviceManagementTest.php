<?php

namespace Tests\Feature;

use App\Models\Device;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DeviceManagementTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_create_device(): void
    {
        $response = $this->postJson('/api/device', [
            'title' => 'Light',
        ]);

        $response->assertCreated();
        $this->assertDatabaseHas('devices', ['title' => 'Light']);
    }

    public function test_user_can_view_devices(): void
    {
        Device::factory()->count(2)->create();

        $response = $this->getJson('/api/device');

        $response->assertOk()
                 ->assertJsonCount(2);
    }

    public function test_user_can_update_device(): void
    {
        $device = Device::factory()->create(['title' => 'Old']);

        $response = $this->putJson('/api/device/' . $device->id, [
            'title' => 'New',
        ]);

        $response->assertOk();
        $this->assertDatabaseHas('devices', ['id' => $device->id, 'title' => 'New']);
    }

    public function test_user_can_delete_device(): void
    {
        $device = Device::factory()->create();

        $response = $this->deleteJson('/api/device/' . $device->id);

        $response->assertNoContent();
        $this->assertDatabaseMissing('devices', ['id' => $device->id]);
    }
}
