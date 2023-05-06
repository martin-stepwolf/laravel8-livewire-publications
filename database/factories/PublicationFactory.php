<?php

namespace Database\Factories;

use App\Models\Publication;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Model;

/**
 * @extends Factory<Publication>
 * @method Publication create($attributes = [], ?Model $parent = null)
 */
class PublicationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Publication::class;

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
            'title' => $this->faker->text(50),
            'content' => $this->faker->text(1200),
            'created_at' => $date,
            'updated_at' => $date,
        ];
    }

    public function user(User $user): self
    {
        return $this->state([
            'user_id' => $user->getKey(),
        ]);
    }
}
