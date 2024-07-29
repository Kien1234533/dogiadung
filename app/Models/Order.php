<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'ordercode',
        'user_id',
        'name',
        'phone',
        'email',
        'address',
        'cartlist',
        'total',
        'status',
        'note',
        'payment_method',
        'is_processed'
    ];
}
