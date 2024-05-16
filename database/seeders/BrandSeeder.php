<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Seeder;
use File;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $allData=json_decode(
            file_get_contents(base_path('database/brands.json')
        ),true);

        foreach ($allData as $brandJSON) {
            $brand = new Brand();
            $brand->wording = $brandJSON;
            $brand->save();
        }
    }
}
