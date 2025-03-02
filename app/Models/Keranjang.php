<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Keranjang extends Model
{
    protected $table = 'keranjangs';
    protected $fillable = ['user_id', 'product_id', 'qty', 'total'];

    public function userCart()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function productCart()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
}
