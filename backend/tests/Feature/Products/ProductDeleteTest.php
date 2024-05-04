<?php

use App\Models\Producer;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductDeleteTest extends TestCase
{
    use RefreshDatabase;

    public function test_owner_can_delete_product(): void
    {
        $product = Product::factory()->create();

        // login as the product author
        $user = $product->get_author();
        

        $response = $this->actingAs($user)->delete("/api/product/{$product->getAttribute("id")}");

        $response->assertStatus(200);
        $this->assertSoftDeleted($product);
    }

    public function test_non_owner_cant_delete_product(): void
    {
        $user = User::factory()->create();
        $product = Product::factory()->create();

        $response = $this->actingAs($user)->delete("/api/product/{$product->getAttribute("id")}");

        $response->assertStatus(204);
        $this->assertModelExists($product);
    }
}