<?php

namespace App\Helpers;

use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
use stdClass;

class Basket
{
    /**
     * Check si le basket existe seulement si l'utilisateur est connecté
     * @return bool
     */
    public static function exists(): bool
    {
        if(Auth::check()) {
            return session()->has('basket');
        } else {
            return false;
        }
    }

    /**
     * Check si le product donné existe dans le basket
     * @param Product $target
     * @return bool
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public static function inBasket(Product $target): bool
    {
        if(!Basket::exists()) {
            return false;
        } else {
            $basket = session()->get('basket');

            foreach ($basket as $index => $basketItem) {
                if(isset($basketItem) && ($basketItem->product->id === $target->id)) {
                    return true;
                }
            }

            return false;
        }
    }

    /**
     * @param Product $product
     * @param int $qty
     * @return void
     */
    public static function addItem(Product $product, int $qty): void
    {
        if(!Basket::exists()) {
            session()->put('basket', array());
        }

        if($qty > 0) {
            $push = new stdClass();
            $push->product = $product;
            $push->quantite = $qty;

            session()->push('basket', $push);
        }
    }

    /**
     * Enlève l'item du basket
     * @param Product $product
     * @return void
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public static function removeItem(Product $product): void
    {
        $targetId = $product->id;

        $before = session()->get('basket');
        $after = array_filter($before, function($item) use ($targetId) {
            return $item->product->id != $targetId;
        });

        $after = array_values(array_filter($after));

        session()->put('basket', $after);
    }

    /**
     * Retourne l'item s'il existe
     * @param Product $target
     * @return stdClass
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public static function getItem(Product $target): stdClass
    {
        if(Basket::exists() && Basket::inBasket($target)) {
            $products = session()->get('basket');
            return array_values(array_filter($products, function ($item) use ($target) {
                return $item->product->id == $target->id;
            }))[0];
        } else {
            return new stdClass();
        }
    }

    /**
     * Créer le basket
     * @return void
     */
    public static function createBasket(): void
    {
        if(!Basket::exists()) {
            session()->put('basket', array());
        }
    }

    /**
     * Retourne le nombre d'items différents dans le basket
     * @return int
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public static function numberOfItems(): int
    {
        if(Basket::exists()) {
            return sizeof(Basket::getAll());
        } else {
            Basket::createBasket();
            return 0;
        }
    }

    /**
     * Retourne tout le basket
     * @return array
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public static function getAll(): array
    {
        return session()->get('basket') ?? [];
    }

    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public static function getItemTotal(Product $target): float
    {
        return round(
            $target->price * Basket::getItem($target)->quantite,
            2
        );
    }

    /**
     * Edite la quantité d'un item
     * @param Product $target
     * @param int $newQte
     * @return void
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public static function editItem(Product $target, int $newQte): void
    {
        if($newQte <= 0) {
            Basket::removeItem($target);
        } else {
            //Prise de l'item
            $item = Basket::getItem($target);
            //Modifier sa qte
            $item->quantite = $newQte;


            $after = array_map(function($val) use ($newQte, $target) {
                if($target->id === $val->product->id) {
                    $val->quantite = $newQte;
                }

                return $val;
            }, Basket::getAll());

            session()->put('basket', $after);
        }
    }

    /**
     * Donne le total du basket (string)
     * @param bool $returnNum Retourne le chiffre plutôt que le string formaté.
     * @return string|int
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public static function getSubTotal($returnNum = false)
    {
        $total = array_reduce(Basket::getAll(), function($carry, $item) {
            $carry += $item->quantite * $item->product->price;
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
        $final = round(Basket::getSubTotal(true) * 0.2,2);

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
        $tva = Basket::getTVA(true);
        $sub = Basket::getSubTotal(true);

        $final = round($sub + $tva + 9.99,2);

        if($returnNum) {
            return $final;
        } else {
            return str_replace(".", ",", (string)$final);
        }
    }

    /**
     * Reset entièrement le basket de l'utilisateur
     * @return void
     */
    public static function resetBasket(): void
    {
        session()->remove('basket');
        Basket::createBasket();
    }
}
