<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Material;
use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $allData=json_decode(
            file_get_contents(base_path('database/products.json')
        ),true);

        foreach($allData as $index => $properties) {
            $product=new Product();

            //random material, brand & category
            $product->id_material = Material::all()->random()->code;
            $product->id_brand = Brand::all()->random()->code;
            $product->id_category = Category::all()->random()->id;

            //iterating throught the values of the JSON
            foreach ($properties as $key => $value) {
                $product->$key = $value;
            }

            $product->save();
        }
    }
}
