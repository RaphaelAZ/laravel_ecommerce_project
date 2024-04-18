<?php

namespace Database\Seeders;

use App\Models\Etat_commande;
use Illuminate\Database\Seeder;

class EtatCommandeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $etats = [
            "en attente",
            "en traitement",
            "en livraison",
            "livree"
        ];

        foreach ($etats as $etat) {
            Etat_commande::create([
                'etat' => "$etat",
            ]);
        }
    }
}
