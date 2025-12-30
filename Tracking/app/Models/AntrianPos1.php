<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AntrianPos1 extends Model
{
    use HasFactory;

    protected $table = 'antrian_pos1';

    protected $fillable = [
        'no_antrian',
        'nomor_polisi',
        'nama_driver',
        'jenis_antrian',
        'tujuan',
        'emr',
        'tgl_antrian',
        'jam_diizinkan_masuk',
        'status',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'tgl_antrian' => 'date',
        'waktu_masuk_plant' => 'datetime',
        'waktu_keluar_plant' => 'datetime',
    ];
}
