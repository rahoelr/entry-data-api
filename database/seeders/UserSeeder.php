<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Faker\Factory as Faker;

class UserSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();
        foreach (range(1, 50) as $index) {
            User::create([
                'name' => $faker->name,
                'username' => $faker->userName,
                'email' => $faker->unique()->safeEmail,
                'password' => bcrypt('password'),
                'role' => $faker->randomElement(['data_entry', 'user_kementerian', 'manager']),
                'status' => $faker->randomElement(['active', 'inactive']),
            ]);
        }
    }
}

