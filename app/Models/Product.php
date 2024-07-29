<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    public function categories()
    {
        return $this->belongsToMany(ProductCategory::class);
    }
    public function colors()
    {
        return $this->belongsToMany(Color::class);
    }
    public function sizes()
    {
        return $this->belongsToMany(Size::class);
    }
    public function comments()
    {
        return $this->hasMany(ProductComment::class)->latest();
    }
    public function wishlists()
    {
        return $this->hasMany(Wishlist::class);
    }
    protected $fillable = ['name', 'slug', 'shortdesc',  'description', 'price', 'discount', 'pricesale', 'quantity', 'image', 'status', 'outstand'];
}
