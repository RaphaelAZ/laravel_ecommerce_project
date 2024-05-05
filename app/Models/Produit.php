<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Produit extends Model
{
    use HasFactory;

    public function marque(): HasOne
    {
        return $this->hasOne(Marque::class, 'code');
    }

    public function categorie(): HasOne
    {
        return $this->hasOne(Categorie::class, 'id');
    }

    public function materiau(): HasOne
    {
        return $this->hasOne(Materiau::class, 'code');
    }
}
