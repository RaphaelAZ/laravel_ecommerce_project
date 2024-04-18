<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            CategorieSeeder::class,
            EtatCommandeSeeder::class,
            MarqueSeeder::class,
            MateriauSeeder::class,
            UserSeeder::class,
            ProduitSeeder::class,
            CommandeSeeder::class,
        ]);
    }
}
