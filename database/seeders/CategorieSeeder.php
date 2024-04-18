<?php

namespace Database\Seeders;

use App\Models\Categorie;
use Database\Factories\CategorieFactory;
use Illuminate\Database\Seeder;

class CategorieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Categorie::factory(25)->create();
        //
    }
}
