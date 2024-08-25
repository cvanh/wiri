<?php

use App\Models\Company;
use App\Models\Product;
use App\Models\Reviews;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * ReviewsGetTest
 * @group Comments
 */
class ReviewsGetTest extends TestCase
{
    use RefreshDatabase;
    /** @test */
    public function test_list_comments_product(): void
    {
        $user = User::factory()->create();
        $product = Product::factory()->hasProductMeta(3)->hasReviews(10)->create();


        $response = $this->actingAs($user)->get("/api/product/{$product->id}/comment");
        $response->assertStatus(200);

        // check if review is linked to the product parent
        $review = $response->decodeResponseJson()[0];
        $review_product_parent = Product::with('reviews')->find($review["id"]);

        $this->assertEquals($review_product_parent->id, $product->id);
    }

    public function test_list_comments_company(): void
    {
        $user = User::factory()->create();
        $company = Company::factory()->hasReviews(10)->create();

        $response = $this->actingAs($user)->get("/api/company/{$company->id}/comment");
        $response->assertStatus(200);

        // check if review is linked to the company 
        $review = $response->decodeResponseJson()[0];
        $review_company_parent = Company::with('reviews')->find($review["id"]);

        $this->assertEquals($review_company_parent->id, $company->id);
    }

    public function test_list_comments_format(): void
    {
        $user = User::factory()->create();
        $product = Company::factory()->hasReviews(10)->create();


        $response = $this->actingAs($user)->get("/api/product/{$product->id}/comment");
        $response->assertStatus(200);
    }

    public function test_list_handles_non_existant_models(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get("/api/kaas/fakeid/comment");
        $response->assertStatus(404);
    }
}
