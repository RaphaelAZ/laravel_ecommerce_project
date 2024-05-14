<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "name" => User::all()->random()->name,
            "email" => User::all()->random()->email,
            "comment" => $this->faker->text(),
        ];
    }
}
