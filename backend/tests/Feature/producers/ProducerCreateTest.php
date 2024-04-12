<?php

namespace Tests\Feature\Producers;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProducerCreateTest extends TestCase
{
    use RefreshDatabase;

    public function test_create_new_producer_authenticated(): void
    {
        $user = User::factory()->create();

        $data = [
            "name" => "wietje",
            "type" => "store",
            "about" => "about"
        ];

        $response = $this->actingAs($user)->postJson('/api/producer/create', $data);

        // where there errors? and did it create a new producer
        $response->assertStatus(201);

        // check if it got inserted and it is linked to the user who owns the producer
        $this->assertDatabaseHas(config("constants.TABLE.PRODUCER_TABLE"), [
            "name" => "wietje",
            "author_id" => $user->id,
        ]);
    }

    public function test_create_new_producer_unauthenticated(): void
    {
        $data = [
            "name" => "wietje",
            "type" => "store",
            "about" => "about"
        ];

        $response = $this->postJson('/api/producer/create', $data);


        // check to make shure the api refuses unauthenticated users
        $response->assertStatus(401);

        // makeshure it didnt got inserted
        $this->assertDatabaseMissing(config("constants.TABLE.PRODUCER_TABLE"), [
            "name" => "wietje"
        ]);
    }
}
