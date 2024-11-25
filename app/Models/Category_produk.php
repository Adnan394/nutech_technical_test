<?php

namespace App\Models;

use App\Models\Produk;
use Illuminate\Database\Eloquent\Model;

class Category_produk extends Model
{
    protected $gurded = ['id'];

    public function produk()
    {
        return $this->hasMany(Produk::class);
    }
}