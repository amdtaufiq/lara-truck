<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rental extends Model
{
    protected $fillable = [
        'nama_penyewa', 'nomor', 'truk_id', 'durasi'
    ];

    protected $casts = [
        'created_at' => 'datetime:d-m-Y',
    ];
}
