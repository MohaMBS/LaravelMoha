<?php

namespace Database\Factories;

use App\Models\Poblacion;
use Illuminate\Database\Eloquent\Factories\Factory;

class PoblacionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Poblacion::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'ciudad' => $this->faker->word,
        'poblacion' => $this->faker->randomDigitNotNull,
        'cp' => $this->faker->word
        ];
    }
}
