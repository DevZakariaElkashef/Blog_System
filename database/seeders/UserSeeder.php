<?php

namespace Database\Seeders;

use App\Models\User;
use Faker\Factory;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();

        $arrayValues = ['owner', 'admin', 'bloger'];

        for($i=1; $i<=50; $i++){
            User::create([
            'first_name' => $faker->name(),
            'last_name' => $faker->name(),
            'user_name' => $faker->name(),
            'email' => $faker->unique()->safeEmail(),
            'role' =>  $arrayValues[rand(0,1)],
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            ]);
        }
    }
}
