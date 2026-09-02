<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CekBarang extends Model
{
    protected $table = 'cek_barang';

    protected $fillable = [
        'tanggal',
        'waktu',
        'nama_pemeriksa',
        'nomor_polisi',
        'nama_pengemudi',
        'nomor_do',
        'jenis_barang',
        'jumlah_barang',
        'satuan',
        'kondisi_kemasan',
        'kesesuaian_jumlah',
        'kelengkapan_dokumen',
        'jenis_kendaraan',
        'kebocoran_tangki',
        'kondisi_seal_tangki',
        'lokasi_kebocoran',
        'catatan',
        'status_akhir',
    ];

    protected $casts = [
        'tanggal' => 'date',
        'jumlah_barang' => 'integer',
    ];
}
