<?php

namespace App\Http\Controllers;

use App\Helpers\Panier;
use App\Models\Produit;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Throwable;

class PanierController extends Controller
{
    public function index(): View
    {
        return view("panier.index");
    }

    /**
     * Ajoute un item dans le panier.
     * @param Request $request
     * @return RedirectResponse
     */
    public function add(Request $request): RedirectResponse
    {
        try {
            //Si la req n'est pas POST
            throw_if(!$request->isMethod('POST'));
            //Le produit
            $target = Produit::find($request->get('id'));
            //Si le panier n'existe pas, le créer
            if(!Panier::exists()) {
                session()->put('panier', array());
            }
            //Si l'article n'est pas dans le panier, alors l'ajouter
            if(!Panier::inPanier($target)) {
                Panier::addItem($target, $request->quantite);
            }
        } catch (Exception|Throwable $e) {} finally {
            //Dans tous les cas rediriger vers la route du produit.
            return redirect()->back();
        }
    }

    /**
     * Supprime un item dans le panier
     * @param Request $request
     * @return RedirectResponse
     */
    public function remove(Request $request): RedirectResponse
    {
        try {
            //Si la req n'est pas POST
            throw_if(!$request->isMethod('POST'));
            //Le produit
            $target = Produit::find($request->get('id'));
            //Si le panier existe, supprimer l'item
            if(Panier::exists()) {
                Panier::removeItem($target);
            }
        } catch (Exception|Throwable $e) {} finally {
            //Dans tous les cas rediriger vers la route du produit.
            return redirect()->back();
        }
    }

    public function update(Request $request): RedirectResponse
    {
        try {
            //Si la req n'est pas POST
            throw_if(!$request->isMethod('POST'));
            //Le produit
            $target = Produit::find($request->get('id'));
            //Si le panier existe, supprimer l'item
            if(Panier::exists()) {
                Panier::editItem($target, $request->get('quantite'));
            }
        } catch (Exception|Throwable $e) {} finally {
            //Dans tous les cas rediriger vers la route du produit.
            return redirect()->back();
        }
    }
}
