<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderState;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderManagementController extends Controller
{
    public function index() {
        //All possible order states
        $final = array();
        foreach (OrderState::all() as $index => $st) {
            $final[$st->state] = Order::with('user')->where("state", $st->id)->get();
        }

        return view("admin.orders.index", [
            "orders" => $final
        ]);
    }

    public function single(int $id)
    {
        //the target order
        $order = Order::find($id);
        //number of goods inside the order
        $nbrProducts = sizeof($order->products);

        //calculating the total of the order using built-in laravel's reduce function
        $total = $order->products->reduce(function ($carry, $item) {
            $totalItem = $item->pivot->quantity * $item->price;
            return $carry + $totalItem;
        }, 0);

        //rounding up the total
        $total = round($total, 2);

        //getting all states and mapping them for the select component
        $states = array();
        foreach (OrderState::all() as $index => $st) {
            $states[$st->id] = $st->state;
        }

        return view('admin.orders.single',
            compact('order', 'nbrProducts', 'total', 'states')
        );
    }

    public function change(Request $request)
    {
        $data = $request->all();
        //all possible states
        $orderStates = OrderState::all();
        //rules for changing
        $rules = [
            "__order_id" => "required|numeric",
            "curr_state" => "required|numeric",
        ];
        //validation
        $request->validate($rules);
        //taking the id of the order as int
        $orderId = (int) $data["__order_id"];
        //editing the order state value
        $order = Order::find($orderId);
        $order->state = (int)$data["curr_state"];
        //save !
        $order->save();

        return redirect()->route('orders.admin.single', $orderId);
    }
}
