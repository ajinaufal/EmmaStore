<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class online_payment_items extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = "online_payment_items";
    protected $fillable = [
        'online_payment_items_id',
        'online_payment_transaction_id',
        'product_id',
        'qty',
        'price',
    ];
}
