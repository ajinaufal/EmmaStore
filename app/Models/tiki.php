<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tiki extends Model
{
    use HasFactory;
    protected $table="tiki";
    protected $fillable = [
        'tiki_id',
        'kode_kota',
        'nama_kota',
        'reg_rate',
        'reg_est',
        'ons_rate',
        'ons_est',
    ];
}
