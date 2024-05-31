<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductMeta;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::factory()->count(10)->hasProductMeta(10)->count(10)->create();
    }
}