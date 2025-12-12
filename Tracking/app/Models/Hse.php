<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hse extends Model
{
    protected $table = 'hse';

    protected $fillable = [
        'tanggal',
        'waktu',
        'nama_petugas',
        'lokasi',
        'kondisi_apd',
        'temuan',
        'tindak_lanjut',
        'penanggung_jawab',
    ];

    protected $casts = [
        'tanggal' => 'date',
        'waktu' => 'datetime',
    ];
}
