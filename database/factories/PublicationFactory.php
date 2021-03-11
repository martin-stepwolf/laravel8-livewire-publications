<?php

namespace Database\Factories;

use App\Models\Publication;
use Illuminate\Database\Eloquent\Factories\Factory;

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
            'user_id' => rand(2, 30),
            'title' => $this->faker->text(50),
            'content' => $this->faker->text(1200),
            'created_at' => $date,
            'updated_at' => $date
        ];
    }
}
