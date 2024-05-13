<?php

namespace Database\Seeders;

use App\Models\Material;
use App\Models\Materiau;
use Illuminate\Database\Seeder;

class MaterialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Material::factory(50)->create();
    }
}
