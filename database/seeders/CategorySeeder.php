<?php

namespace Database\Seeders;

use App\Models\Categorie;
use App\Models\Category;
use Database\Factories\CategorieFactory;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $allData=json_decode(
            file_get_contents(base_path('database/category.json')
        ),true);

        foreach ($allData as $categoryJSON) {
            $brand = new Category();
            $brand->name = $categoryJSON;
            $brand->save();
        }
    }
}
