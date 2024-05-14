<?php

namespace App\Http\Controllers;


use App\Models\Category;
use App\Models\Product;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Random\RandomException;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     * @return Renderable
     * @throws RandomException
     */
    public function index()
    {
        //category of target offer
        $catId = Product::all()->random()->category->id;
        $category = Category::find($catId);

        //all products of target category
        $products = Product::where("id_category", $catId)->get();
        //random products of target category: between 1 and a random number depending on how many items they are.
        $productsAll = $products->random(random_int(1, count($products)));

        $final = array();
        foreach ($productsAll as $product) {
            //offer between 5% ~ 65%;
            $offerOG = (mt_rand(5 * 2, 65 * 2) / 2);
            //Now reducing it for an applicable percentage
            $offer = (1 - ($offerOG / 100));

            $final[] = [
                "product" => $product,
                //The offer in percentage
                "offer" => $offerOG,
                //the after price
                "afterPrice" => ($product->prix * $offer)
            ];
        }

        return view('home', [
            "offers" => $final,
            "category" => $category
        ]);
    }
}
