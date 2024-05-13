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
            CategorySeeder::class,
            OrdersStateSeeder::class,
            BrandSeeder::class,
            MaterialSeeder::class,
            UserSeeder::class,
            ProductSeeder::class,
            OrdersSeeder::class,
            OrderDetailSeeder::class
        ]);
    }
}
