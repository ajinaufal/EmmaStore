<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cart extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $table="cart";
    protected $fillable = [
        'id',
        'variant_size',
        'variant_color',
        'user_id',
        'products_id',
        'total',
        'created_at',
        'updated_at',
    ];

    public function get_user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function get_product()
    {
        return $this->belongsTo(Products::class, 'products_id');
    }
}
