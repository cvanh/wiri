<?php

use App\Models\Product;
use App\Models\ProductMeta;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductGetTest extends TestCase
{
    use RefreshDatabase;

    public function test_get_products(): void
    {
        $user = User::factory()->create();
        Product::factory()->hasProductMeta(3)->count(5)->create();

        $response = $this->actingAs($user)->get('/api/product');

        $response->assertStatus(200);
        $response->assertJsonCount(5);
    }

    public function test_get_single_product(): void
    {
        $user = User::factory()->create();
        $product = Product::factory()->hasProductMeta(3)->create();

        $response = $this->actingAs($user)->get("/api/product/{$product->getAttribute('id')}");

        $response->assertStatus(200);
        $response->assertJsonFragment(["id" => $product->id]);
        // $response->assertJsonStructure([
        //     "id",
        //     "meta"
        // ]);
    }
}