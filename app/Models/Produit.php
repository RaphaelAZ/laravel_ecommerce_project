<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Http\Request;

class Produit extends Model
{
    use HasFactory;

    protected $primaryKey = "id";

    public function marque(): BelongsTo
    {
        return $this->belongsTo(Marque::class, 'id_marque');
    }

    public function categorie(): BelongsTo
    {
        return $this->belongsTo(Categorie::class, 'id_categorie');
    }

    public function materiau(): BelongsTo
    {
        return $this->belongsTo(Materiau::class, 'id_materiau');
    }

    public function commande(): BelongsToMany
    {
        return $this->belongsToMany(
            Commande::class,
            'detail_commande',
        )->withPivot(['quantite', "produit_id"]);
        //avec la colone quantite, sans commande_id
    }
}
