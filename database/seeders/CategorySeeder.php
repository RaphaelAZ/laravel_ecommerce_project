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
        Category::factory(5)->create();
        //
    }
}
