<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Products extends Model
{
    public $timestamps = false;
    public $incrementing = false;
    protected $table = "products";
    protected $fillable = [
        'product_id',
        'nama',
        'harga',
        'deskripsi',
        'etalase',
        'status',
        'berat',
        'stok',
        'onsale',
        'newstuff',
        'gambar1',
        'gambar2',
        'gambar3',
        'gambar4',
        'gambar5',
    ];

    public function get_cart()
    {
        return $this->hasMany(cart::class,'product_id');
    }
}
