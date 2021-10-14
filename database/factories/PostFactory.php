<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Post;
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
        $arrayValues = ['published', 'drafted'];
        $cats = Category::pluck('id')->toArray();

        return [
            'title' => $this->faker->words(7, true),
            'author' => $this->faker->name(),
            'tags' => $this->faker->words(3, true),
            'image'=>'https://source.unsplash.com/random',
            'content' => $this->faker->text($maxNbChars = 500),
            'comment_counts' => $this->faker->randomDigit(),
            'date' => $this->faker->date($format = 'Y-m-d', $max = 'now'),
            'status' => $arrayValues[rand(0,2)],
            'category_id' => $this->faker->randomElement($cats)

        ];
    }
}
