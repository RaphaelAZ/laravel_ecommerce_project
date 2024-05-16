<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Helpers\Basket;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Throwable;

class BasketController extends Controller
{
    public function index(): View
    {
        return view("basket.index");
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
            $target = Product::find($request->get('id'));
            //Si le panier n'existe pas, le créer
            if(!Basket::exists()) {
                session()->put('basket', array());
            }
            //Si l'article n'est pas dans le panier, alors l'ajouter
            if(!Basket::inBasket($target)) {
                Basket::addItem($target, $request->quantity);
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
            $target = Product::find($request->get('id'));
            //Si le panier existe, supprimer l'item
            if(Basket::exists()) {
                Basket::removeItem($target);
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
            $target = Product::find($request->get('id'));
            //Si le panier existe, supprimer l'item
            if(Basket::exists()) {
                Basket::editItem($target, $request->get('quantity'));
            }
        } catch (Exception|Throwable $e) {} finally {
            //Dans tous les cas rediriger vers la route du produit.
            return redirect()->back();
        }
    }
}
