<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     * @throws RandomException
     */
    public function run()
    {
        $allOrders = Order::all();

        foreach ($allOrders as $commande) {
            $total = 0;

            for ($i = 0; $i < random_int(1, 5); $i++) {
                $product = Product::all()->random();
                $quantite = random_int(1, 10);

                DB::table('order_detail')->insert([
                    "order_id" => $commande->id,
                    "product_id" => $product->id,
                    "quantity" => $quantite,
                    "created_at" => now(),
                    "updated_at" => now(),
                ]);

                $total += $quantite * $product->price;
            }

            $commande->update([
                "total" => $total,
            ]);

            $commande->save();
        }
    }
}
