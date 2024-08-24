<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\Product;
use App\Models\Reviews;
use Illuminate\Database\Seeder;

class ReviewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::all()->take(10)->each(function (Product $product) {
            $reviews = Reviews::factory()->count(10);
            $product->reviews()->saveMany($reviews);
        });

        Company::all()->take(10)->each(function (Company $company) {
            $reviews = Reviews::factory()->count(10);
            $company->reviews()->saveMany($reviews);
        });
    }
}
