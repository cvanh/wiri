<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // create 10 sample users
        User::factory(10)->create();

        // create admin user for dev environment
        if (app()->environment('local')) {
            User::factory()->create([
                'name' => 'Test admin',
                'email' => 'admin@admin.test',
                'password' => bcrypt("admin")
            ]);
        }
    }
}