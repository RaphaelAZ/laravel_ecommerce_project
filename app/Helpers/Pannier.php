<?php

namespace App\Helpers;

use App\Models\Produit;
use Illuminate\Support\Facades\Auth;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
use stdClass;

class Pannier
{
    /**
     * Check si le pannier existe seulement si l'utilisateur est connecté
     * @return bool
     */
    public static function exists(): bool
    {
        if(Auth::check()) {
            return session()->has('pannier');
        } else {
            return false;
        }
    }

    /**
     * Check si le produit donné existe dans le pannier
     * @param Produit $target
     * @return bool
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public static function inPannier(Produit $target): bool
    {
        if(!Pannier::exists()) {
            return false;
        } else {
            $pannier = session()->get('pannier');

            foreach ($pannier as $index => $pannierItem) {
                if($pannierItem->produit->id === $target->id) {
                    return true;
                }
            }

            return false;
        }
    }

    /**
     * @param Produit $produit
     * @param int $qty
     * @return void
     */
    public static function addItem(Produit $produit, int $qty): void
    {
        if(!Pannier::exists()) {
            session()->put('pannier', array());
        }

        $push = new stdClass();
        $push->produit = $produit;
        $push->quantite = $qty;

        session()->push('pannier', $push);
    }

    /**
     * Enlève l'item du pannier
     * @param Produit $produit
     * @return void
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public static function removeItem(Produit $produit): void
    {
        $targetId = $produit->id;

        $before = session()->get('pannier');
        $after = array_filter($before, function($item) use ($targetId) {
            return $item->produit->id != $targetId;
        });

        session()->put('pannier', $after);
    }

    public static function getItem(Produit $target): stdClass
    {
        if(Pannier::exists() && Pannier::inPannier($target)) {
            $produits = session()->get('pannier');
            return array_filter($produits, function ($item) use ($target) {
                return $item->produit->id == $target->id;
            })[0];
        } else {
            return new stdClass();
        }
    }
}
