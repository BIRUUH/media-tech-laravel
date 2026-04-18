<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name', 'details', 'price', 'image_01', 'image_02', 'image_03'
    ];

    public function carts()
    {
        return $this->hasMany(Cart::class, 'pid');
    }

    public function wishlists()
    {
        return $this->hasMany(Wishlist::class, 'pid');
    }
}