<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderState extends Model
{
    use HasFactory;

    protected $primaryKey = "id";

    protected $visible = [
        "id",
        "state"
    ];

    protected $table = "orders_state";
}
