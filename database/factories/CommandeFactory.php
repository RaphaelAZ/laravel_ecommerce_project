<?php

namespace Database\Factories;

use App\Models\Etat_commande;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommandeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "id_user" => User::all()->random()->id,
            "etat" => Etat_commande::all()->random()->id,
            "date" => $this->faker->date(),
            "total" => $this->faker->randomFloat(2, 5, 250),
        ];
    }
}
