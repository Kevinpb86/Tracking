<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Antrian extends Model
{
    protected $table = 'antrian';

    protected $fillable = [
        'nomor_polisi',
        'nama_driver',
        'perusahaan',
        'nomor_do',
        'jenis_muatan'
    ];
}
