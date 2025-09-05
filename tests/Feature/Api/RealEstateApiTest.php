<?php

namespace Tests\Feature\Api;

use App\Models\RealEstate;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test; 
use Tests\TestCase;

class RealEstateApiTest extends TestCase
{
    use RefreshDatabase;

    #[Test] 
    public function it_can_list_real_estates(): void
    {
        RealEstate::factory(5)->create();

        $response = $this->getJson('/api/v1/real-estates');

        $response->assertStatus(200)
            ->assertJsonStructure(['data' => ['*' => ['id', 'name', 'type', 'city', 'country']]])
            ->assertJsonCount(5, 'data');
    }

    #[Test]  
    public function it_can_create_a_real_estate(): void
    {
        $data = RealEstate::factory()->make()->toArray();

        $response = $this->postJson('/api/v1/real-estates', $data);

        $response->assertStatus(201)
            ->assertJsonFragment(['name' => $data['name']]);

        $this->assertDatabaseHas('real_estates', ['name' => $data['name']]);
    }

    #[Test]  
    public function it_can_show_a_real_estate(): void
    {
        $realEstate = RealEstate::factory()->create();

        $response = $this->getJson("/api/v1/real-estates/{$realEstate->id}");

        $response->assertStatus(200)
            ->assertJsonFragment(['id' => $realEstate->id]);
    }

    #[Test]  
    public function it_can_update_a_real_estate(): void
    {
        $realEstate = RealEstate::factory()->create();
        $updateData = ['name' => 'Updated Awesome House'];

        $response = $this->putJson("/api/v1/real-estates/{$realEstate->id}", $updateData);

        $response->assertStatus(200)
            ->assertJsonFragment(['name' => 'Updated Awesome House']);

        $this->assertDatabaseHas('real_estates', ['id' => $realEstate->id, 'name' => 'Updated Awesome House']);
    }

    #[Test]  
    public function it_can_soft_delete_a_real_estate(): void
    {
        $realEstate = RealEstate::factory()->create();

        $response = $this->deleteJson("/api/v1/real-estates/{$realEstate->id}");

        $response->assertStatus(200);

        $this->assertSoftDeleted('real_estates', ['id' => $realEstate->id]);
    }
}