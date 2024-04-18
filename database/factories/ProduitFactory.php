<?php

namespace Database\Factories;

use App\Models\Categorie;
use App\Models\Marque;
use App\Models\Materiau;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProduitFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $units = [
            "mm","cm","dm","m",
        ];

        return [
            'nom' => $this->faker->words(random_int(1, 3), true),
            'description' => $this->faker->paragraph(),
            'prix' => $this->faker->randomFloat(2, 5, 100),
            'image' => $this->faker->imageUrl(),
            'stock' => $this->faker->numberBetween(5, 150),
            'hauteur' => $this->faker->numberBetween(5, 150) . " " . $units[array_rand($units)],
            'largeur' => $this->faker->numberBetween(5, 150) . " " . $units[array_rand($units)],
            'longueur' => $this->faker->numberBetween(5, 150) . " " . $units[array_rand($units)],
            'usage' => $this->faker->word(),
            'id_materiau' => Materiau::all()->random()->code,
            'id_marque' => Marque::all()->random()->code,
            'id_categorie' => Categorie::all()->random()->id,
        ];
    }
}
