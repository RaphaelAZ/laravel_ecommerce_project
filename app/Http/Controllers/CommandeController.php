<?php

namespace App\Http\Controllers;

use App\Helpers\Pannier;
use App\Models\Commande;
use App\Http\Requests\StoreCommandeRequest;
use App\Http\Requests\UpdateCommandeRequest;
use App\Models\User;
use Exception;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Factory;
use Illuminate\View\View;

class CommandeController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     * @throws \Exception
     */
    public function index()
    {
        $model = new Commande();
        $commandes = $model->getFromUser(Auth::user());

        return view('commandes.index', [
            "commandes" => $commandes
        ]);
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
     * @param StoreCommandeRequest $request
     */
    public function store(StoreCommandeRequest $request)
    {
        try {
            //La requêtte passe, donc on la persiste.
            $commande = new Commande();
            $codeCommande = $commande->insertCommande();

            if(isset($codeCommande) && is_numeric($codeCommande)){
                $commande->insertDetails($codeCommande, Pannier::getAll());

                Pannier::resetPannier();

                return redirect()->route('commandes.index')
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
     * @param  \App\Models\Commande  $commande
     * @return \Illuminate\Http\Response
     */
    public function show(Commande $commande)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Commande  $commande
     * @return \Illuminate\Http\Response
     */
    public function edit(Commande $commande)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCommandeRequest  $request
     * @param  \App\Models\Commande  $commande
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCommandeRequest $request, Commande $commande)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Commande  $commande
     * @return \Illuminate\Http\Response
     */
    public function destroy(Commande $commande)
    {
        //
    }
}
