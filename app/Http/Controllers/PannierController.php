<?php

namespace App\Http\Controllers;

use App\Helpers\Pannier;
use App\Models\Produit;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Throwable;

class PannierController extends Controller
{
    public function index(): View
    {
        return view("pannier.index");
    }

    /**
     * Ajoute un item dans le pannier.
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
            //Si le pannier n'existe pas, le créer
            if(!Pannier::exists()) {
                session()->put('pannier', array());
            }
            //Si l'article n'est pas dans le pannier, alors l'ajouter
            if(!Pannier::inPannier($target)) {
                Pannier::addItem($target, $request->quantite);
            }
        } catch (Exception|Throwable $e) {} finally {
            //Dans tous les cas rediriger vers la route du produit.
            return redirect()->back();
        }
    }

    /**
     * Supprime un item dans le pannier
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
            //Si le pannier existe, supprimer l'item
            if(Pannier::exists()) {
                Pannier::removeItem($target);
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
            //Si le pannier existe, supprimer l'item
            if(Pannier::exists()) {
                Pannier::editItem($target, $request->get('quantite'));
            }
        } catch (Exception|Throwable $e) {} finally {
            //Dans tous les cas rediriger vers la route du produit.
            return redirect()->back();
        }
    }
}
