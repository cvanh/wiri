<?php

namespace Tests\Feature\products;

use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class ProductsCreateTest extends TestCase
{
    use RefreshDatabase;

    public function test_products_are_listed_authenticated(): void
    {
        $user = User::factory()->create();
        Product::factory()->count(4)->create();

        $response = $this->actingAs($user)->get('/api/product');

        // were there errors?
        $response->assertStatus(200);

        // we just created 4 products so we are expecting 4 producers
        $response->assertJsonCount(4);
    }

    public function test_products_are_listed_unauthenticated(): void
    {
        Product::factory()->count(4)->create();

        $response = $this->get('/api/product');

        // make shure we arent logedin
        $this->assertGuest();

        // we arent loged in so we should expect an redirect
        $response->assertRedirect("/login");
    }

    public function test_show_product_authenticated(): void
    {
        $user = User::factory()->create();
        Product::factory()->create([
            "id" => "19E1612B7-48D6-4A0F-A0E6-A133FC88AC4023"
        ]);

        $response = $this->actingAs($user)->getJson("/api/product/19E1612B7-48D6-4A0F-A0E6-A133FC88AC4023");

        // where there errors
        $response->assertStatus(200);

        // check if we got an object of the product which we requested
        $response->assertJson(
            fn (AssertableJson $json) =>
            $json
                ->where("id", "19E1612B7-48D6-4A0F-A0E6-A133FC88AC4023")
                ->etc()
        );
    }

    public function test_show_product_unauthenticated(): void
    {
        Product::factory()->create([
            "id" => "19E1612B7-48D6-4A0F-A0E6-A133FC88AC4023"
        ]);

        $response = $this->get("/api/product/19E1612B7-48D6-4A0F-A0E6-A133FC88AC4023");

        // make shure we arent logedin
        $this->assertGuest();

        // we arent loged in so we should expect an redirect
        $response->assertRedirect("/login");
    }

    public function test_user_owns_product(): void
    {
        $user = User::factory()->create();
        $reqBody = [
            "name" => fake()->name(),
            "description" => fake()->paragraph(),
            "producer_id" => fake()->uuid()
        ];

        $response = $this->actingAs($user)->postJson('/api/product/create', $reqBody);

        $response->assertCreated();
        dump($response->dump());

        $this->assertDatabaseHas("products", $reqBody);
    }
}