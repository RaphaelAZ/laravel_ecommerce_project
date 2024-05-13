<?php

namespace Database\Factories;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Material;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
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
            'name' => $this->faker->words(random_int(1, 3), true),
            'description' => $this->faker->paragraph(),
            'price' => $this->faker->randomFloat(2, 5, 100),
            'image' => $this->faker->imageUrl(),
            'stock' => $this->faker->numberBetween(5, 150),
            'height' => $this->faker->numberBetween(5, 150) . " " . $units[array_rand($units)],
            'width' => $this->faker->numberBetween(5, 150) . " " . $units[array_rand($units)],
            'length' => $this->faker->numberBetween(5, 150) . " " . $units[array_rand($units)],
            'usage' => $this->faker->word(),
            'id_material' => Material::all()->random()->code,
            'id_brand' => Brand::all()->random()->code,
            'id_category' => Category::all()->random()->id,
        ];
    }
}
