<?php

namespace Database\Seeders;

use App\Models\Post;
use Faker\Factory;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $arrayValues = ['published', 'drafted'];
        $arrayValues2 = ['1.jpg', '2.jpg', '3.jpg', '4.jpg', '5.jpg', '6.jpg', '7.jpg', '8.jpg', '9.jpg', '10.jpg', '11.jpg', '12.jpg', '13.jpg', '14.jpg', '15.jpg', '16.jpg'];
        $faker = Factory::create();
        
        for($i=1; $i<=50; $i++){
            Post::create([
                'title' => $faker->words(2, true),
                'author' => $faker->name(),
                'tags' => $faker->words(3, true),
                'image'=> $arrayValues2[rand(0,15)],
                'content' => $faker->text($maxNbChars = 500),
                'comment_counts' => 0,
                'date' => $faker->date($format = 'Y-m-d', $max = 'now'),
                'status' => $arrayValues[rand(0,1)],
                'user_id' => rand(1, 50),
                'views' => 0,
                'category_id' => rand(1, 50)
            ]);
        }
    }
}
