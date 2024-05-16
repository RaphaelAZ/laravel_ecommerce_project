<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';

    protected $fillable = [
        "code",
        "expiration",
        "discount"
    ];

    protected $casts = [
        "expiration" => "datetime",
        "discount" => "float"
    ];
}
