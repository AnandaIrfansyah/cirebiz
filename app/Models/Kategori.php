<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    protected $table = 'kategoris';
    protected $fillable = ['kategori','foto_kategori'];

    public function kategori()
    {
        return $this->hasMany(Product::class);
    }
}
