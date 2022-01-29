<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ProductVarian extends Model
{
    public $incrementing = false;
    protected $table="product_varian";
    protected $fillable = [
        'varian_id',
        'product_id',
        'id',
        'jenis',
        'nama',
        'harga',
        'status',
        'stok',
        'onsale',
        'newstuff',
    ];
  
}
