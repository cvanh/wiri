<?php

namespace Tests\Feature\Producers;

use App\Models\Producer;
use App\Models\User;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\URL;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class ProducerTest extends TestCase
{
    use RefreshDatabase;

    public function test_producers_are_listed(): void
    {
        $user = User::factory()->create();
        Producer::factory()->count(4)->create();

        $response = $this->actingAs($user)->get('/producer');

        // where there errors?
        $response->assertStatus(200);
        
        // we just created 4 producers so we are expecting 4 producers
        $response->assertJsonCount(4);
    }

    public function test_show_producer(): void
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
}