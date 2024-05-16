<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CouponFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "code" => $this->faker->regexify('[A-Z0-9]{10}'),
            "discount" => $this->faker->randomFloat(2, 5, 100),
            "expiration" => $this->faker->dateTimeBetween('-1 week', '+1 week'),
        ];
    }
}
