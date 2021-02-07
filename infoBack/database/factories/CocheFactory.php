<?php

namespace Database\Factories;

use App\Models\Coche;
use Illuminate\Database\Eloquent\Factories\Factory;

class CocheFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Coche::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'marca' => $this->faker->text,
        'modelo' => $this->faker->text,
        'fecha' => $this->faker->word
        ];
    }
}
