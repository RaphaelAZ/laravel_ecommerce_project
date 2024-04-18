<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Random;

class MateriauFactory extends Factory
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
            "libelle" => $this->faker->word(),
        ];
    }
}
