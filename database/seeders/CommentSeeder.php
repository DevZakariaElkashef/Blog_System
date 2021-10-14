<?php

namespace Database\Seeders;

use App\Models\comment;
use App\Models\User;
use Faker\Factory;
use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $arrayValues = ['approved', 'unapproved'];
        $faker = Factory::create();
        for($i=1; $i<=50; $i++){
            comment::create([
                'post_id' => rand(1,50),
                'user_id' => rand(1,50),
                'author' => $faker->name(),
                'email' => $faker->email(),
                'status' => 'unapproved',
                'content' => $faker->text($maxNbChars = 1000),
                'date' => $faker->DateTime()
            ]);
        }
    }
}
