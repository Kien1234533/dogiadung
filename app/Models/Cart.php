<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'product_id',
        'code',
        'name',
        'price',
        'pricesale',
        'image',
        'color',
        'size',
        'quantity',
        'applied_voucher',
        'discount_amount',
        'coin'
    ];
}
