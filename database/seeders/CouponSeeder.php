<?php

namespace Database\Seeders;

use App\Models\Coupon;
use App\Models\Order;
use Illuminate\Database\Seeder;

class CouponSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Coupon::factory(10)->create();

        //random number of orders that have coupons
        $numberOrders = sizeof(Order::all());
        $targetNumber = random_int(1, $numberOrders);

        //looping in the number of selected orders
        for ($i = 1; $i <= $targetNumber; $i++) {
            //random order that doesn't have a coupon yet
            $order = Order::whereNull('coupon_id')->inRandomOrder()->first();

            if ($order) {
                $coupon = Coupon::all()->random(1)->first(); // Retrieve a single random coupon
                //target percentage between 0 and 1 to apply the code
                $targetPercent = (1 - ($coupon->discount / 100));
                // Assign coupon ID to the target order
                $order->coupon_id = $coupon->id;
                $order->total = round($order->total * $targetPercent, 2);
                // Save the order !
                $order->save();
            } else {
                // No more orders without coupons, exit the loop
                break;
            }
        }
    }
}
