<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PropertyTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_access_create_property_page(): void
    {
        \Spatie\Permission\Models\Role::firstOrCreate(['name' => 'admin']);
        $admin = User::factory()->create(['type' => 'admin']);
        $admin->assignRole('admin');

        $response = $this->actingAs($admin)->get(route('admin.properties.create'));

        $response->assertStatus(200);
        $response->assertSee('Amenities');
        $response->assertSee('Parking');
    }

    public function test_admin_can_store_property(): void
    {
        \Spatie\Permission\Models\Role::firstOrCreate(['name' => 'admin']);
        $admin = User::factory()->create(['type' => 'admin']);
        $admin->assignRole('admin');

        $response = $this->actingAs($admin)
            ->post(route('admin.properties.store'), [
                'title' => 'Test Property Admin',
                'type' => 'Apartment',
                'price' => 1000,
                'city' => 'Nairobi',
                'address' => '123 Street',
                'description' => 'Test Description',
                'status' => 'available',
                'image' => \Illuminate\Http\UploadedFile::fake()->create('property.jpg', 100, 'image/jpeg'),
                'bedroom' => 2,
                'bathroom' => 1,
                'amenities' => ['Parking', 'Pool']
            ]);

        $response->assertRedirect(route('admin.properties.index'));
        $this->assertDatabaseHas('properties', ['title' => 'Test Property Admin']);
    }

    public function test_agent_can_store_property(): void
    {
        \Spatie\Permission\Models\Role::firstOrCreate(['name' => 'staff']);
        $agent = User::factory()->create(['type' => 'staff']);
        $agent->assignRole('staff');

        $response = $this->actingAs($agent)
            ->post(route('agent.properties.store'), [
                'title' => 'Test Property Agent',
                'type' => 'House',
                'price' => 2000,
                'city' => 'Mombasa',
                'address' => '456 Avenue',
                'description' => 'Agent Description',
                'status' => 'available',
                'image' => \Illuminate\Http\UploadedFile::fake()->create('agent_prop.jpg', 100, 'image/jpeg'),
                'bedroom' => 3,
                'bathroom' => 2,
                'amenities' => ['Garden', 'Security']
            ]);

        $response->assertRedirect(route('agent.properties.index'));
        $this->assertDatabaseHas('properties', ['title' => 'Test Property Agent']);
    }
}
