<?php

namespace Tests\Feature\Auth;

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
        var_dump($response->getContent());

        // where there errors?
        $response->assertStatus(200);

        $response->assertJsonCount(4);

        // check if we got the same result we have put in the db
        // $response->assertJson(
        //     fn (AssertableJson $json) =>
        //     $json->where("name", "wietje")->etc()
        // );
    }
}
