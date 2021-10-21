<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Faker\Factory as FakerFactory;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Post::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $tags    = ['nature', 'travel', 'ocean', 'night', 'relax'];
        $tags    = implode(',', $tags);
        $imgs    = ['1.jpg', '2.jpg', '3.jpg', '4.jpg', '5.jpg', '6.jpg', '7.jpg', '8.jpg', '9.jpg', '10.jpg', '11.jpg', '12.jpg', '13.jpg', '14.jpg', '15.jpg', '16.jpg'];
        $status  = ['published', 'drafted'];

        return [
            'title'        => $this->faker->words(2, true),
            'author'       => $this->faker->name(),
            'tags'         => $tags,
            'image'        => $imgs[rand(0,15)],
            'content'      => $this->faker->words(500, true),
            'date'         => $this->faker->date($format = 'Y-m-d', $max = 'now'),
            'status'       => $status[rand(0,1)],
            'category_id'  => function () {
                return Category::factory()->create()->id;
            },
            'user_id'  => function () {
                return User::factory()->create()->id;
            },
            

        ];
    }
}
