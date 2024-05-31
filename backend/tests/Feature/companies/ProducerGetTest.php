<?php declare(strict_types=1);

namespace Tests\Feature\Companies;

use App\Models\Company;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

final class ProducerGetTest extends TestCase
{
    use RefreshDatabase;

    public function test_producers_are_listed_authenticated(): void
    {
        $user = User::factory()->create();
        Company::factory()->count(4)->create();

        $response = $this->actingAs($user)->get('/api/company');

        // were there errors?
        $response->assertStatus(200);

        // we just created 4 companies so we are expecting 4 companies
        $response->assertJsonCount(4);
    }

    public function test_producers_are_listed_unauthenticated(): void
    {
        Company::factory()->count(4)->create();

        $response = $this->get('/api/company');

        // make shure we arent logedin
        $this->assertGuest();

        // we arent loged in so we should expect an redirect
        $response->assertRedirect('/login');
    }

    public function test_show_producer_authenticated(): void
    {
        $user = User::factory()->create();
        Company::factory()->create([
            'id' => '19E1612B7-48D6-4A0F-A0E6-A133FC88AC4023',
        ]);

        $response = $this->actingAs($user)->getJson('/api/company/19E1612B7-48D6-4A0F-A0E6-A133FC88AC4023');

        // where there errors
        $response->assertStatus(200);

        // check if we got an object of the company which we requested
        $response->assertJson(
            static fn (AssertableJson $json) => $json
                ->where('id', '19E1612B7-48D6-4A0F-A0E6-A133FC88AC4023')
                ->etc()
        );
    }

    public function test_show_producer_unauthenticated(): void
    {
        Company::factory()->create([
            'id' => '19E1612B7-48D6-4A0F-A0E6-A133FC88AC4023',
        ]);

        $response = $this->get('/api/company/19E1612B7-48D6-4A0F-A0E6-A133FC88AC4023');

        // make shure we arent logedin
        $this->assertGuest();

        // we arent loged in so we should expect an redirect
        $response->assertRedirect('/login');
    }

    public function test_user_owns_producer(): void
    {
        $user = User::factory()->create();
        Company::factory()->create(['author_id' => $user->id]);

        $response = $this->actingAs($user)->getJson('/api/company');

        $response->assertStatus(200);

        $response->assertJsonFragment(['author_id' => $user->id]);
    }
}
