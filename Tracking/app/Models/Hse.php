<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hse extends Model
{
    use HasFactory;

    protected $table = 'hse';

    protected $fillable = [
        'tanggal',
        'waktu',
        'nama_petugas',
        'nomor_polisi',
        'nama_driver',
        'perusahaan',
        'helm_safety',
        'sepatu_safety',
        'rompi_safety',
        'masker',
        'sarung_tangan',
        'kacamata_safety',
        'apar_tersedia',
        'kotak_p3k',
        'catatan_safety',
        'tindak_lanjut',
        'status',
    ];

    protected $casts = [
        'tanggal' => 'date',
        'waktu' => 'datetime:H:i',
        'helm_safety' => 'boolean',
        'sepatu_safety' => 'boolean',
        'rompi_safety' => 'boolean',
        'masker' => 'boolean',
        'sarung_tangan' => 'boolean',
        'kacamata_safety' => 'boolean',
        'apar_tersedia' => 'boolean',
        'kotak_p3k' => 'boolean',
    ];
}
