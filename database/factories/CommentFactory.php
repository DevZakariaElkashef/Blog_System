<?php

namespace Database\Factories;

use App\Models\comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = comment::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id'  => function () {
                return User::factory()->create()->id;
            },
            'post_id'  => function () {
                return Post::factory()->create()->id;
            },
            'author'  => function () {
                return User::factory()->create()->user_name;
            },
            'email'  => function () {
                return User::factory()->create()->email;
            },
            'status'    => 'unapproved',
            'content'  => $this->faker->words(500, true),
            'date'     => $this->faker->date($format = 'Y-m-d', $max = 'now')

        ];
    }
}
