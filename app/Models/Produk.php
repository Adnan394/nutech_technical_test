<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Category_produk;

class Produk extends Model
{
    protected $guarded = ['id'];

    public function category()
    {
        return $this->belongsTo(Category_produk::class);
    }
}