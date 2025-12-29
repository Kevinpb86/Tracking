<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hse extends Model
{
    use HasFactory;

    /**
     * Nama tabel
     */
    protected $table = 'hse';

    /**
     * Kolom yang dapat diisi
     */
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

    /**
     * Cast tipe data
     */
    protected $casts = [
        'tanggal' => 'date',
        'waktu' => 'datetime:H:i',
    ];
}
