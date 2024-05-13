<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Random;

class MaterialFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     * @throws Random\RandomException
     */
    public function definition(): array
    {
        return [
            "wording" => $this->faker->word(),
        ];
    }
}
