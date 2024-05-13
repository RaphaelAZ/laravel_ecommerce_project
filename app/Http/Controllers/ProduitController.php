<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use App\Models\Marque;
use App\Models\Materiau;
use App\Models\Produit;
use App\Http\Requests\StoreProduitRequest;
use App\Http\Requests\UpdateProduitRequest;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Response;
use Illuminate\Http\Request;

class ProduitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index(Request $request)
    {
        $q = Produit::query();



        $marques = Marque::all()->pluck('libelle', 'code');
        $materials = Materiau::all()->pluck('libelle', 'code');
        $categories = Categorie::all()->pluck('nom', 'id');

        //dd($marques, $materials, $categories);

        $q->with(['marque','materiau','categorie']);

        $products = $q->paginate(15);

        return view("produits.index", [
            "marques" => $marques,
            "materials" => $materials,
            "categories" => $categories,
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

    public function filters(Request $request)
    {
        //$q = Produit::query();

        $filters = array_filter($request->all(), function($val) {
            return (
                $val !== null &&
                $val !== '__none__' &&
                (int) $val !== 0
            );
        });

        $q = Produit::with(['marque','materiau','categorie']);

        if(isset($filters["nom-prod"])) {
            $q->where("nom", "like", "%".$filters['nom-prod']."%");
        }

        if(isset($filters["marque-libelle"])) {
            $q->where("id_marque", "=", $filters["marque-libelle"]);
        }

        if(isset($filters["materiau-libelle"])) {
            $q->where("id_materiau", "=", (int) $filters["materiau-libelle"]);
        }

        if(isset($filters["categorie-libelle"])) {
            $q->where("id_categorie", "=", $filters["categorie-libelle"]);
        }

        if(isset($filters["input-min"]) || isset($filters["input-max"])) {
            $q->whereBetween("prix", [
                (int)($filters["input-min"] ?? 0),
                (int)($filters["input-max"] ?? PHP_INT_MAX),
            ]);
        }

        return view("produits.results", [
            "products" => $q->get(),
            "filters" => $filters,
        ]);
    }
}
