<?php

namespace Database\Seeders;

use App\Models\Material;
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
        $allData=json_decode(
            file_get_contents(base_path('database/material.json')
        ),true);

        foreach ($allData as $materialJSON) {
            $brand = new Material();
            $brand->wording = $materialJSON;
            $brand->save();
        }
    }
}
