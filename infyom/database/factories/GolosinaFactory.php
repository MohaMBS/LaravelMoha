<?php

namespace Database\Factories;

use App\Models\Golosina;
use Illuminate\Database\Eloquent\Factories\Factory;

class GolosinaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Golosina::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'sabor' => $this->faker->word,
        'calorias' => $this->faker->word,
        'precio' => $this->faker->word,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s'),
        'deleted_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
