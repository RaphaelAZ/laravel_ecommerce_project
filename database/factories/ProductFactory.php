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
        return [
            'name' => $this->faker->words(random_int(1, 3), true),
            'description' => $this->faker->paragraph(),
            'price' => $this->faker->randomFloat(2, 5, 100),
            'image' => $this->faker->imageUrl(),
            'stock' => $this->faker->numberBetween(5, 150),
            'height' => $this->faker->numberBetween(5, 150),
            'width' => $this->faker->numberBetween(5, 150),
            'length' => $this->faker->numberBetween(5, 150),
            'usage' => $this->faker->word(),
            'id_material' => Material::all()->random()->code,
            'id_brand' => Brand::all()->random()->code,
            'id_category' => Category::all()->random()->id,
        ];
    }
}
