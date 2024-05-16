<?php

namespace App\Models;

use App\Helpers\Basket;
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

class Order extends Model
{
    use HasFactory;

    protected $primaryKey = "id";

    protected $fillable = [
        "state",
        "date",
        "total",
        "coupon_id",
    ];

    public function getFromUser($user): Collection
    {
        $id = null;

        if(isset($user->id))
        {
            $id = $user->id;
        } else if(gettype($user) === 'integer') {
            $id = $user;
        }
        else {
            throw new \Exception("User is not defined");
        }

        return $this
            ->where('id_user', $id)
            ->orderBy('orders.id', 'DESC')
            ->get();
    }

    public function etat(): HasOne
    {
        return $this->hasOne(
            OrderState::class,
            'id'
        );
    }

    public function user(): HasOne
    {
        return $this->hasOne(
            User::class,
            'id'
        );
    }

    public function products(): BelongsToMany
    {
        //Many to Many
        return $this->belongsToMany(
            Product::class,
            'order_detail',
        )->withPivot(['quantity', "product_id"]);
        //avec la colone quantity, sans commande_id
    }

    public function coupon(): HasOne
    {
        return $this->hasOne(Coupon::class, 'id');
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
            "state" => 1,
            "date" => $now->format("Y-m-d"),
            "total" => Basket::getTotal(true),
            "created_at" => $now->format("Y-m-d H:i:s"),
            "updated_at" => $now->format("Y-m-d H:i:s")
        ];

        if(Basket::codeApplied())
        {
            $code = Coupon::where('code', session('discount_code'))
                ->orderBy('updated_at', 'DESC')
                ->first();

            $toInsert["coupon_id"] = $code->id;
        }


        return $this->insertGetId($toInsert);
    }

    /**
     * Insère les products dans la BDD
     * @return void
     *
     */
    public function insertDetails(int $codeCommande, array $basketItems = [])
    {
        $now = new DateTimeImmutable("now");

        foreach ($basketItems as $index => $item) {
            $toInsert = [
                "order_id" => $codeCommande,
                "product_id" => $item->product->id,
                "quantity" => $item->quantity,
                "created_at" => $now->format("Y-m-d H:i:s"),
                "updated_at" => $now->format("Y-m-d H:i:s"),
            ];

            DB::table('order_detail')->insert($toInsert);
        }
    }
}
