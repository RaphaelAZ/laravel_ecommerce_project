<?php

namespace App\Helpers;

use App\Models\Produit;
use Illuminate\Support\Facades\Auth;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
use stdClass;

class Panier
{
    /**
     * Check si le panier existe seulement si l'utilisateur est connecté
     * @return bool
     */
    public static function exists(): bool
    {
        if(Auth::check()) {
            return session()->has('panier');
        } else {
            return false;
        }
    }

    /**
     * Check si le produit donné existe dans le panier
     * @param Produit $target
     * @return bool
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public static function inPanier(Produit $target): bool
    {
        if(!Panier::exists()) {
            return false;
        } else {
            $panier = session()->get('panier');

            foreach ($panier as $index => $panierItem) {
                if(isset($panierItem) && ($panierItem->produit->id === $target->id)) {
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
        if(!Panier::exists()) {
            session()->put('panier', array());
        }

        if($qty > 0) {
            $push = new stdClass();
            $push->produit = $produit;
            $push->quantite = $qty;

            session()->push('panier', $push);
        }
    }

    /**
     * Enlève l'item du panier
     * @param Produit $produit
     * @return void
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public static function removeItem(Produit $produit): void
    {
        $targetId = $produit->id;

        $before = session()->get('panier');
        $after = array_filter($before, function($item) use ($targetId) {
            return $item->produit->id != $targetId;
        });

        $after = array_values(array_filter($after));

        session()->put('panier', $after);
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
        if(Panier::exists() && Panier::inPanier($target)) {
            $produits = session()->get('panier');
            return array_values(array_filter($produits, function ($item) use ($target) {
                return $item->produit->id == $target->id;
            }))[0];
        } else {
            return new stdClass();
        }
    }

    /**
     * Créer le panier
     * @return void
     */
    public static function createPanier(): void
    {
        if(!Panier::exists()) {
            session()->put('panier', array());
        }
    }

    /**
     * Retourne le nombre d'items différents dans le panier
     * @return int
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public static function numberOfItems(): int
    {
        if(Panier::exists()) {
            return sizeof(Panier::getAll());
        } else {
            Panier::createPanier();
            return 0;
        }
    }

    /**
     * Retourne tout le panier
     * @return array
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public static function getAll(): array
    {
        return session()->get('panier') ?? [];
    }

    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public static function getItemTotal(Produit $target): float
    {
        return round(
            $target->prix * Panier::getItem($target)->quantite,
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
            Panier::removeItem($target);
        } else {
            //Prise de l'item
            $item = Panier::getItem($target);
            //Modifier sa qte
            $item->quantite = $newQte;


            $after = array_map(function($val) use ($newQte, $target) {
                if($target->id === $val->produit->id) {
                    $val->quantite = $newQte;
                }

                return $val;
            }, Panier::getAll());

            session()->put('panier', $after);
        }
    }

    /**
     * Donne le total du panier (string)
     * @param bool $returnNum Retourne le chiffre plutôt que le string formaté.
     * @return string|int
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public static function getSubTotal($returnNum = false)
    {
        $total = array_reduce(Panier::getAll(), function($carry, $item) {
            $carry += $item->quantite * $item->produit->prix;
            return $carry;
        }, 0);

        if(!$returnNum) {
            return str_replace(".",",",round($total, 2));
        } else {
            return $total;
        }
    }

    /**
     * Redonne le prix TVA
     * @param $returnNum bool Retourne un numéro au lieu d'un string.
     * @return array|float|string|string[]
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public static function getTVA($returnNum = false)
    {
        $final = round(Panier::getSubTotal(true) * 0.2,2);

        if($returnNum) {
            return $final;
        } else {
            return str_replace(".", ",", (string)$final);
        }
    }

    /**
     * Retourne le vrai total (sous-total+tva)
     * @param bool $returnNum
     * @return array|float|string|string[]
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     * TODO: Code de réduction.
     */
    public static function getTotal(bool $returnNum = false)
    {
        $tva = Panier::getTVA(true);
        $sub = Panier::getSubTotal(true);

        $final = round($sub + $tva + 9.99,2);

        if($returnNum) {
            return $final;
        } else {
            return str_replace(".", ",", (string)$final);
        }
    }

    /**
     * Reset entièrement le panier de l'utilisateur
     * @return void
     */
    public static function resetPanier(): void
    {
        session()->remove('panier');
        Panier::createPanier();
    }
}
