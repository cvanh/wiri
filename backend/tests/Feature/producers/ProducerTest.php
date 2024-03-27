<?php

namespace Tests\Feature\Producers;

use App\Models\Producer;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class ProducerTest extends TestCase
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

        $response = $this->actingAs($user)->postJson('/producer', $data);

        // where there errors?
        $response->assertStatus(200);

        // check if it got inserted
        $this->assertDatabaseHas(config("constants.TABLE.PRODUCER_TABLE"), [
            "name" => "wietje"
        ]);
    }

    public function test_producers_are_listed_authenticated(): void
    {
        $user = User::factory()->create();
        Producer::factory()->count(4)->create();

        $response = $this->actingAs($user)->get('/producer');

        // where there errors?
        $response->assertStatus(200);

        // we just created 4 producers so we are expecting 4 producers
        $response->assertJsonCount(4);
    }

    public function test_producers_are_listed_unauthenticated(): void
    {
        Producer::factory()->count(4)->create();

        $response = $this->get('/producer');

        // make shure we arent logedin
        $this->assertGuest();

        // we arent loged in so we should expect an redirect
        $response->assertRedirect("/login");
    }

    public function test_show_producer_authenticated(): void
    {
        $user = User::factory()->create();
        Producer::factory()->create([
            "id" => "19E1612B7-48D6-4A0F-A0E6-A133FC88AC4023"
        ]);

        $response = $this->actingAs($user)->getJson("/producer/19E1612B7-48D6-4A0F-A0E6-A133FC88AC4023");

        // where there errors
        $response->assertStatus(200);

        // check if we got an object of the producer which we requested
        $response->assertJson(
            fn (AssertableJson $json) =>
            $json
                ->where("id", "19E1612B7-48D6-4A0F-A0E6-A133FC88AC4023")
                ->etc()
        );
    }

    public function test_show_producer_unauthenticated(): void
    {
        Producer::factory()->create([
            "id" => "19E1612B7-48D6-4A0F-A0E6-A133FC88AC4023"
        ]);

        $response = $this->get("/producer/19E1612B7-48D6-4A0F-A0E6-A133FC88AC4023");

        // make shure we arent logedin
        $this->assertGuest();

        // we arent loged in so we should expect an redirect
        $response->assertRedirect("/login");
    }
}