<?php

namespace App\Http\Controllers;

use App\Models\Produit;
use App\Http\Requests\StoreProduitRequest;
use App\Http\Requests\UpdateProduitRequest;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Response;

class ProduitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $products = Produit::paginate(15);

        return view("produits.index", [
            "products" => $products,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProduitRequest  $request
     * @return Response
     */
    public function store(StoreProduitRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param Produit $produit
     * @return Application|Factory|View
     */
    public function show(Produit $produit)
    {
        return view("produits.show", [
            "produit" => $produit,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Produit $produit
     * @return Response
     */
    public function edit(Produit $produit)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProduitRequest  $request
     * @param Produit $produit
     * @return Response
     */
    public function update(UpdateProduitRequest $request, Produit $produit)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Produit $produit
     * @return Response
     */
    public function destroy(Produit $produit)
    {
        //
    }
}
