<?php

namespace App\Http\Controllers;

use App\Helpers\Basket;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Models\Order;
use App\Models\User;
use Exception;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Factory;
use Illuminate\View\View;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     * @throws \Exception
     */
    public function index()
    {
        $model = new Order();
        $orders = $model->getFromUser(Auth::user());

        return view('orders.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreOrderRequest $request
     */
    public function store(StoreOrderRequest $request)
    {
        try {
            //La requêtte passe, donc on la persiste.
            $order = new Order();
            $codeCommande = $order->insertCommande();

            if(isset($codeCommande) && is_numeric($codeCommande)){
                $order->insertDetails($codeCommande, Basket::getAll());

                Basket::resetBasket();
                Basket::resetCode();

                return redirect()->route('orders.index')
                    ->with("message", "Votre commande a bien été enregistrée");
            } else {
                throw new Exception("Cock");
            }

        } catch (Exception $e) {
            return redirect()->back()
                ->withErrors([
                    "Une erreur inconnue s'est produite, veuillez réessayer."
                ]);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateOrderRequest  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateOrderRequest $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }
}
