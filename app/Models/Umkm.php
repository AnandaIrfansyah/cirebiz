<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Umkm extends Model
{
    protected $table = 'umkms';
    protected $fillable = ['umkm_id','nama_toko','alamat','no_telp','logo','status','deskripsi'];

    public function userUmkm()
    {
        return $this->belongsTo(User::class, 'umkm_id', 'id');
    }
}
