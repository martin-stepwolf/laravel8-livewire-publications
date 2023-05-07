<?php

namespace Database\Factories;

use App\Models\Comment;
use App\States\Comment\Approved;
use App\States\Comment\Pending;
use App\States\Comment\Rejected;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Model;

/**
 * @extends Factory<Comment>
 * @method Comment create($attributes = [], ?Model $parent = null)
 */
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
            'user_id' => random_int(2, 30),
            'publication_id' => random_int(2, 50),
            'state' => Pending::$name,
            'content' => $this->faker->text(300),
            'created_at' => $date,
            'updated_at' => $date,
        ];
    }

    public function approved(): self
    {
        return $this->state([
            'state' => Approved::$name,
        ]);
    }

    public function rejected(): self
    {
        return $this->state([
            'state' => Rejected::$name,
        ]);
    }
}
