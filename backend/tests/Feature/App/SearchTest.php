<?php

declare(strict_types=1);

use App\Models\Company;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

final class SearchTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_search_company(): void
    {
        $user = User::factory()->create();
        $product = Product::factory()->hasProductMeta(10)->create();
        $company = Company::factory()->createMany(10);

        $to_search = $company->first()->name;

        $response = $this->actingAs($user)->get("/api/app/search?s={$to_search}");

        $response->assertSuccessful();
        $response->assertJsonFragment(['name' => $to_search]);
    }

    public function test_user_can_search_product(): void
    {
        $user = User::factory()->create();
        $product = Product::factory()->hasProductMeta(10)->create();
        $company = Company::factory()->createMany(10);

        $to_search = $product->first()->name;

        $response = $this->actingAs($user)->get("/api/app/search?s={$to_search}");

        $response->assertSuccessful();
        $response->assertJsonFragment(['name' => $to_search]);
    }

    public function test_search_json_structure(): void
    {
        $user = User::factory()->create();
        Product::factory()->hasProductMeta(10)->create();
        Company::factory()->createMany(10);

        // look up everything so we can test the product and company structure
        $response = $this->actingAs($user)->get("/api/app/search?s=");

        $response->assertSuccessful();
        $response->assertJsonStructure([
            'companies' => [
                [
                    'id',
                    'type',
                    'name',
                    'about',
                    'updated_at',
                    'created_at',
                    'author_id',
                    'latitude',
                    'longitude',
                ]
            ],
            'products' => [[
                'id',
                'name',
                'updated_at',
                'created_at',
                'producer_id',
            ]],
            'search_key',
        ]);
    }

    public function test_unauthenticated_user_cant_search(): void
    {
        $response = $this->get("/api/app/search?s=asd");

        $response->assertRedirectToRoute("login");
    }
}
