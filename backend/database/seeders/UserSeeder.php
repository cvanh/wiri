<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // create 10 sample users
        User::factory(10)->create();

        // create admin user for dev environment
        User::firstOrCreate(["name" => "Test admin"], [
            'name' => 'Test admin',
            'email' => 'admin@admin.test',
            'password' => bcrypt("adminadmin")
        ]);
    }
}
