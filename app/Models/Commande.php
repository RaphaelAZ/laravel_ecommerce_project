<?php

namespace App\Models;

use App\Helpers\Pannier;
use DateTimeImmutable;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

class Commande extends Model
{
    use HasFactory;

    public function getFromUser($user): Collection
    {
        if(isset($user->id))
        {
            $id = $user->id;

            return $this
                ->where('id_user', $id)
                ->orderBy('commandes.id', 'DESC')
                ->get();
        } else {
            throw new \Exception("User is not defined");
        }
    }

    public function etat(): HasOne
    {
        return $this->hasOne(
            Etat_commande::class,
            'id'
        );
    }

    public function produits(): BelongsToMany
    {
        //Many to Many
        return $this->belongsToMany(
            Produit::class,
            'detail_commande',
        )->withPivot(['quantite', "produit_id"]);
        //avec la colone quantite, sans commande_id

    }

    /**
     * Insère une commande
     * @return int|null ID de la commande
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function insertCommande(): int
    {
        $now = new DateTimeImmutable("now");

        $toInsert = [
            "id_user" => Auth::user()->id,
            "etat" => 1,
            "date" => $now->format("Y-m-d"),
            "total" => Pannier::getTotal(true),
            "created_at" => $now->format("Y-m-d H:i:s"),
            "updated_at" => $now->format("Y-m-d H:i:s")
        ];


        return $this->insertGetId($toInsert);
    }

    /**
     * Insère les produits dans la BDD
     * @return void
     *
     */
    public function insertDetails(int $codeCommande, array $pannierItems = [])
    {
        $now = new DateTimeImmutable("now");

        foreach ($pannierItems as $index => $item) {
            $toInsert = [
                "commande_id" => $codeCommande,
                "produit_id" => $item->produit->id,
                "quantite" => $item->quantite,
                "created_at" => $now->format("Y-m-d H:i:s"),
                "updated_at" => $now->format("Y-m-d H:i:s"),
            ];

            DB::table('detail_commande')->insert($toInsert);
        }
    }
}
