<?php

namespace Database\Seeders;

use App\Models\OrderState;
use Illuminate\Database\Seeder;

class OrdersStateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $etats = [
            "En attente",
            "En traitement",
            "En livraison",
            "Livrée"
        ];

        foreach ($etats as $etat) {
            OrderState::create([
                'state' => "$etat",
            ]);
        }
    }
}
