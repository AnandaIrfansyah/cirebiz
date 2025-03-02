<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';
    protected $fillable = ['umkm_id', 'user_id', 'nama_product', 'kategori_id', 'deskripsi', 'harga', 'foto_product', 'status'];

    public function profilUmkm()
    {
        return $this->belongsTo(Umkm::class, 'umkm_id', 'id');
    }
    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id', 'id');
    }
    public function userProduct()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function cart()
    {
        return $this->hasMany(Keranjang::class);
    }
}
