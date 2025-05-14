<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Umkm extends Model
{
    protected $table = 'umkms';
    protected $fillable = ['user_id', 'nama_toko', 'alamat', 'no_telp', 'logo', 'status', 'deskripsi'];

    public function userUmkm()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function products()
    {
        return $this->hasMany(Product::class, 'umkm_id', 'id');
    }
}
