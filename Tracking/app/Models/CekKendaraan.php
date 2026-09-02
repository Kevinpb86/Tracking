<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class CekKendaraan extends Model
{
    use HasFactory;

    /**
     * Nama tabel
     */
    protected $table = 'cek_kendaraan';

    /**
     * Kolom yang dapat diisi
     */
    protected $fillable = [
        'tanggal',
        'waktu_masuk',
        'waktu_keluar',
        'nomor_polisi',
        'jenis_kendaraan',
        'nama_driver',
        'perusahaan',

        'surat_jalan',
        'stnk_valid',
        'sim_valid',
        'kir_valid',
        'kondisi_ban',
        'kondisi_lampu',
        'kondisi_rem',
        'kondisi_lampu_sen',
        'kaca_spion_lengkap',
        'hasil_pemeriksaan',
        'catatan',
        'nama_petugas',
    ];

    /**
     * Cast tipe data
     */
    protected $casts = [
        'tanggal' => 'date',
        'waktu_masuk' => 'datetime:H:i',
        'waktu_keluar' => 'datetime:H:i',
        'surat_jalan' => 'boolean',
        'stnk_valid' => 'boolean',
        'sim_valid' => 'boolean',
        'kir_valid' => 'boolean',
        'kaca_spion_lengkap' => 'boolean',
    ];

    /**
     * Scope: Pemeriksaan hari ini
     */
    public function scopeHariIni($query)
    {
        return $query->whereDate('tanggal', Carbon::today());
    }

    /**
     * Scope: Kendaraan yang lolos
     */
    public function scopeLolos($query)
    {
        return $query->where('hasil_pemeriksaan', 'Lolos');
    }

    /**
     * Scope: Kendaraan yang tidak lolos
     */
    public function scopeTidakLolos($query)
    {
        return $query->where('hasil_pemeriksaan', 'Tidak Lolos');
    }

    /**
     * Accessor: Cek apakah semua dokumen lengkap
     */
    public function getDokumenLengkapAttribute()
    {
        return $this->surat_jalan && $this->stnk_valid && $this->sim_valid;
    }

    /**
     * Accessor: Warna badge hasil pemeriksaan
     */
    public function getHasilBadgeColorAttribute()
    {
        return match ($this->hasil_pemeriksaan) {
            'Lolos' => 'green',
            'Lolos Bersyarat' => 'yellow',
            'Tidak Lolos' => 'red',
            default => 'gray'
        };
    }

    /**
     * Method: Hitung durasi pemeriksaan
     */
    public function getDurasiPemeriksaan()
    {
        if ($this->waktu_masuk && $this->waktu_keluar) {
            $masuk = Carbon::parse($this->waktu_masuk);
            $keluar = Carbon::parse($this->waktu_keluar);
            return $keluar->diffInMinutes($masuk);
        }
        return null;
    }
}
