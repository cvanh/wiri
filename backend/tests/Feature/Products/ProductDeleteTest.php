<?php

use App\Models\Company;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductDeleteTest extends TestCase
{
    use RefreshDatabase;

    public function test_owner_can_delete_product(): void
    {
        $product = Product::factory()->hasProductMeta(10)->create();

        // login as the product author
        $user = $product->get_author();
        

        $response = $this->actingAs($user)->delete("/api/product/{$product->getAttribute("id")}");

        $response->assertSuccessful();
        $this->assertSoftDeleted($product);

        // meta data related to the product should be marked for removal
        $this->assertSoftDeleted("product_meta", ["product_id" => $product->id]);
    }

    public function test_non_owner_cant_delete_product(): void
    {
        $user = User::factory()->create();
        $product = Product::factory()->hasProductMeta(10)->create();

        $response = $this->actingAs($user)->delete("/api/product/{$product->getAttribute("id")}");

        $response->assertForbidden();
        $this->assertModelExists($product);

        // check if the the mete data related to the product where not deleted
        $this->assertDatabaseHas("product_meta", ["product_id" => $product->id]);
    }
}