<?php

namespace Database\Seeders;

use App\Models\Commande;
use App\Models\Produit;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DetailCommandeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     * @throws RandomException
     */
    public function run()
    {
        $allCommandes = Commande::all();

        foreach ($allCommandes as $commande) {
            $total = 0;

            for ($i = 0; $i < random_int(1, 5); $i++) {
                $produit = Produit::all()->random();
                $quantite = random_int(1, 10);

                DB::table('detail_commande')->insert([
                    "commande_id" => $commande->id,
                    "produit_id" => $produit->id,
                    "quantite" => $quantite,
                    "created_at" => now(),
                    "updated_at" => now(),
                ]);

                $total += $quantite * $produit->prix;
            }

            $commande->update([
                "total" => $total,
            ]);

            $commande->save();
        }
    }
}
