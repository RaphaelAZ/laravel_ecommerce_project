<?php

namespace App\Http\Controllers;

use App\Models\Etat_commande;
use App\Http\Requests\StoreEtat_commandeRequest;
use App\Http\Requests\UpdateEtat_commandeRequest;

class EtatCommandeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\Http\Requests\StoreEtat_commandeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEtat_commandeRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Etat_commande  $etat_commande
     * @return \Illuminate\Http\Response
     */
    public function show(Etat_commande $etat_commande)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Etat_commande  $etat_commande
     * @return \Illuminate\Http\Response
     */
    public function edit(Etat_commande $etat_commande)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateEtat_commandeRequest  $request
     * @param  \App\Models\Etat_commande  $etat_commande
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateEtat_commandeRequest $request, Etat_commande $etat_commande)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Etat_commande  $etat_commande
     * @return \Illuminate\Http\Response
     */
    public function destroy(Etat_commande $etat_commande)
    {
        //
    }
}
