<?php

namespace Database\Seeders;

use App\Models\Materiau;
use Illuminate\Database\Seeder;

class MateriauSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Materiau::factory(50)->create();
    }
}
