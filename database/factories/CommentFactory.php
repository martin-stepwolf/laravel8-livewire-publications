<?php

namespace Database\Factories;

use App\Models\Comment;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Comment::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $date = $this->faker->dateTimeThisMonth($max = 'now', $timezone = null);
        return [
            'user_id' => rand(2, 30),
            'publication_id' => rand(2, 50),
            'comment_state_id' => rand(1, 3),
            'content' => $this->faker->text(300),
            'created_at' => $date,
            'updated_at' => $date
        ];
    }
}
