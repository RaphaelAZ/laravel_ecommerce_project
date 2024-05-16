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
            $final[$st->state] = Order::where("state", $st->id)->get();
        }

        return view("admin.orders.index", [
            "orders" => $final
        ]);
    }

    public function single(int $id)
    {
        return view('admin.orders.single', [
            "order" => Order::find($id),
        ]);
    }

    public function change(Request $request)
    {
        $data = $request->all();
        $targetID = $data["id"];

        $product = Product::find($targetID);
        dd($product);
    }
}
