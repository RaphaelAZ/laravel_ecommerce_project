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
                if(isset($pannierItem) && ($pannierItem->produit->id === $target->id)) {
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

        if($qty > 0) {
            $push = new stdClass();
            $push->produit = $produit;
            $push->quantite = $qty;

            session()->push('pannier', $push);
        }
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

        $after = array_values(array_filter($after));

        session()->put('pannier', $after);
    }

    /**
     * Retourne l'item s'il existe
     * @param Produit $target
     * @return stdClass
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public static function getItem(Produit $target): stdClass
    {
        if(Pannier::exists() && Pannier::inPannier($target)) {
            $produits = session()->get('pannier');
            return array_values(array_filter($produits, function ($item) use ($target) {
                return $item->produit->id == $target->id;
            }))[0];
        } else {
            return new stdClass();
        }
    }

    /**
     * Créer le pannier
     * @return void
     */
    public static function createPannier(): void
    {
        if(!Pannier::exists()) {
            session()->put('pannier', array());
        }
    }

    /**
     * Retourne le nombre d'items différents dans le pannier
     * @return int
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public static function numberOfItems(): int
    {
        if(Pannier::exists()) {
            return sizeof(Pannier::getAll());
        } else {
            Pannier::createPannier();
            return 0;
        }
    }

    /**
     * Retourne tout le pannier
     * @return array
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public static function getAll(): array
    {
        return session()->get('pannier') ?? [];
    }

    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public static function getItemTotal(Produit $target): float
    {
        return round(
            $target->prix * Pannier::getItem($target)->quantite,
            2
        );
    }

    /**
     * Edite la quantité d'un item
     * @param Produit $target
     * @param int $newQte
     * @return void
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public static function editItem(Produit $target, int $newQte): void
    {
        if($newQte <= 0) {
            Pannier::removeItem($target);
        } else {
            //Prise de l'item
            $item = Pannier::getItem($target);
            //Modifier sa qte
            $item->quantite = $newQte;


            $after = array_map(function($val) use ($newQte, $target) {
                if($target->id === $val->produit->id) {
                    $val->quantite = $newQte;
                }

                return $val;
            }, Pannier::getAll());

            session()->put('pannier', $after);
        }
    }

    /**
     * Donne le total du pannier (string)
     * @return string
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public static function getTotal(): string
    {
        $total = array_reduce(Pannier::getAll(), function($carry, $item) {
            $carry += $item->quantite * $item->produit->prix;
            return $carry;
        }, 0);

        return str_replace(".",",",round($total, 2));
    }
}
