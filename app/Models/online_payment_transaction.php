<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class online_payment_transaction extends Model
{
    public $timestamps = false;
    use HasFactory;
    protected $table = "online_payment_transaction";
    protected $fillable = [
        'online_payment_transaction_id',
        'transaction_no',
        'metode_pembayaran',
        'firstname',
        'lastname',
        'email',
        'hp',
        'address',
        'postal_code',
        'kabupaten_kotamadya',
        'kecamatan',
        'recipient_firstname',
        'recipient_lastname',
        'recipient_email',
        'recipient_hp',
        'recipient_address',
        'recipient_postal_code',
        'recipient_kabupaten_kotamadya',
        'recipient_kecamatan',
        'layanan',
        'weight',
        'delivery_charges',
        'administration_fee',
        'price',
        'checkout_date',
        'counter',
        'payment_status',
        'payment_id',
    ];
}
