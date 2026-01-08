<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Tracking extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'tracking';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        // Tracking Number
        'tracking_number',

        // Informasi Dasar Kendaraan
        'nomor_polisi',
        'nama_driver',
        'perusahaan',
        'jenis_kendaraan',

        // Informasi Waktu & Lokasi
        'tanggal',
        'waktu_masuk',
        'waktu_keluar',
        'durasi_menit',
        'lokasi',
        'lokasi_terakhir',

        // Referensi ke Tabel Lain
        'antrian_id',
        'cek_kendaraan_id',
        'hse_id',
        'do_item_id',
        'cek_barang_id',

        // Status & Progress
        'status_keseluruhan',
        'sudah_antrian',
        'sudah_cek_kendaraan',
        'sudah_hse',
        'sudah_cek_do',
        'sudah_cek_barang',

        // Informasi Muatan
        'jenis_muatan',
        'nomor_do',
        'nomor_surat_jalan',
        'jenis_antrian',
        'tujuan',

        // Hasil Pemeriksaan
        'status_antrian',
        'status_cek_kendaraan',
        'status_hse',
        'status_cek_do',
        'status_cek_barang',

        // Catatan
        'catatan_umum',
        'catatan_antrian',
        'catatan_kendaraan',
        'catatan_hse',
        'catatan_do',
        'catatan_barang',
        'alasan_penolakan',
        'tindak_lanjut',

        // Petugas
        'petugas_pos1',
        'petugas_pos2',

        // Metadata
        'waktu_antrian',
        'waktu_cek_kendaraan',
        'waktu_hse',
        'waktu_cek_do',
        'waktu_cek_barang',
        'waktu_selesai',
        'ip_address',
        'user_agent',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'tanggal' => 'date',
        'waktu_masuk' => 'datetime:H:i',
        'waktu_keluar' => 'datetime:H:i',
        'sudah_antrian' => 'boolean',
        'sudah_cek_kendaraan' => 'boolean',
        'sudah_hse' => 'boolean',
        'sudah_cek_do' => 'boolean',
        'sudah_cek_barang' => 'boolean',
        'waktu_antrian' => 'datetime',
        'waktu_cek_kendaraan' => 'datetime',
        'waktu_hse' => 'datetime',
        'waktu_cek_do' => 'datetime',
        'waktu_cek_barang' => 'datetime',
        'waktu_selesai' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($tracking) {
            if (empty($tracking->tracking_number)) {
                $tracking->tracking_number = self::generateTrackingNumber();
            }

            // Auto-set IP address dan user agent
            if (empty($tracking->ip_address)) {
                $tracking->ip_address = request()->ip();
            }

            if (empty($tracking->user_agent)) {
                $tracking->user_agent = request()->userAgent();
            }
        });

        static::created(function ($tracking) {
            // Log activity: tracking created
            TrackingHistory::logActivity(
                $tracking->id,
                $tracking->tracking_number,
                'created',
                'Tracking Dibuat',
                "Tracking baru dibuat untuk kendaraan {$tracking->nomor_polisi}",
                null,
                $tracking->toArray(),
                $tracking->petugas_pos1,
                $tracking->lokasi_terakhir
            );
        });

        static::updating(function ($tracking) {
            // Hitung durasi jika waktu masuk dan keluar sudah ada
            if ($tracking->waktu_masuk && $tracking->waktu_keluar) {
                $masuk = \Carbon\Carbon::parse($tracking->waktu_masuk);
                $keluar = \Carbon\Carbon::parse($tracking->waktu_keluar);
                $tracking->durasi_menit = $keluar->diffInMinutes($masuk);
            }
        });

        static::updated(function ($tracking) {
            $original = $tracking->getOriginal();
            $changes = $tracking->getChanges();

            // Log status change
            if (isset($changes['status_keseluruhan'])) {
                TrackingHistory::logActivity(
                    $tracking->id,
                    $tracking->tracking_number,
                    'status_changed',
                    'Status Berubah',
                    "Status berubah dari {$original['status_keseluruhan']} menjadi {$tracking->status_keseluruhan}",
                    ['status' => $original['status_keseluruhan']],
                    ['status' => $tracking->status_keseluruhan],
                    null,
                    $tracking->lokasi_terakhir
                );
            }

            // Log location change
            if (isset($changes['lokasi_terakhir'])) {
                TrackingHistory::logActivity(
                    $tracking->id,
                    $tracking->tracking_number,
                    'location_changed',
                    'Lokasi Berubah',
                    "Lokasi berubah dari {$original['lokasi_terakhir']} ke {$tracking->lokasi_terakhir}",
                    ['lokasi' => $original['lokasi_terakhir']],
                    ['lokasi' => $tracking->lokasi_terakhir],
                    null,
                    $tracking->lokasi_terakhir
                );
            }

            // Log completion
            if (isset($changes['status_keseluruhan']) && $tracking->status_keseluruhan === 'Selesai') {
                TrackingHistory::logActivity(
                    $tracking->id,
                    $tracking->tracking_number,
                    'completed',
                    'Tracking Selesai',
                    "Tracking selesai untuk kendaraan {$tracking->nomor_polisi}",
                    null,
                    ['waktu_selesai' => $tracking->waktu_selesai],
                    null,
                    'Keluar'
                );
            }

            // Log rejection
            if (isset($changes['status_keseluruhan']) && $tracking->status_keseluruhan === 'Ditolak') {
                TrackingHistory::logActivity(
                    $tracking->id,
                    $tracking->tracking_number,
                    'rejected',
                    'Tracking Ditolak',
                    "Tracking ditolak: {$tracking->alasan_penolakan}",
                    null,
                    ['alasan' => $tracking->alasan_penolakan],
                    null,
                    $tracking->lokasi_terakhir
                );
            }
        });
    }

    public static function generateTrackingNumber()
    {
        $date = now()->format('Ymd');
        $random = strtoupper(Str::random(5));
        $trackingNumber = "TRK-{$date}-{$random}";

        // Pastikan unique
        while (self::where('tracking_number', $trackingNumber)->exists()) {
            $random = strtoupper(Str::random(5));
            $trackingNumber = "TRK-{$date}-{$random}";
        }

        return $trackingNumber;
    }

    /**
     * Relasi ke tabel antrian_pos1
     */
    public function antrian()
    {
        return $this->belongsTo(AntrianPos1::class, 'antrian_id');
    }

    /**
     * Relasi ke tabel cek_kendaraan
     */
    public function cekKendaraan()
    {
        return $this->belongsTo(CekKendaraan::class, 'cek_kendaraan_id');
    }

    /**
     * Relasi ke tabel hse
     */
    public function hse()
    {
        return $this->belongsTo(Hse::class, 'hse_id');
    }

    /**
     * Relasi ke tabel do_items
     */
    public function doItem()
    {
        return $this->belongsTo(DoItem::class, 'do_item_id');
    }

    /**
     * Relasi ke tabel cek_barang
     */
    public function cekBarang()
    {
        return $this->belongsTo(CekBarang::class, 'cek_barang_id');
    }

    /**
     * Relasi ke tracking history
     */
    public function history()
    {
        return $this->hasMany(TrackingHistory::class, 'tracking_id')->orderBy('created_at', 'desc');
    }

    /**
     * Scope untuk filter berdasarkan status
     */
    public function scopeByStatus($query, $status)
    {
        return $query->where('status_keseluruhan', $status);
    }

    /**
     * Scope untuk filter berdasarkan lokasi
     */
    public function scopeByLokasi($query, $lokasi)
    {
        return $query->where('lokasi_terakhir', $lokasi);
    }

    /**
     * Scope untuk filter berdasarkan tanggal
     */
    public function scopeByTanggal($query, $tanggal)
    {
        return $query->whereDate('tanggal', $tanggal);
    }

    /**
     * Scope untuk tracking yang masih aktif (belum selesai)
     */
    public function scopeAktif($query)
    {
        return $query->whereNotIn('status_keseluruhan', ['Selesai', 'Ditolak']);
    }

    /**
     * Scope untuk tracking hari ini
     */
    public function scopeHariIni($query)
    {
        return $query->whereDate('tanggal', today());
    }

    /**
     * Get progress percentage
     */
    public function getProgressPercentageAttribute()
    {
        $total = 5; // Total tahapan: antrian, cek kendaraan, hse, cek do, cek barang
        $completed = 0;

        if ($this->sudah_antrian)
            $completed++;
        if ($this->sudah_cek_kendaraan)
            $completed++;
        if ($this->sudah_hse)
            $completed++;
        if ($this->sudah_cek_do)
            $completed++;
        if ($this->sudah_cek_barang)
            $completed++;

        return round(($completed / $total) * 100);
    }

    /**
     * Get status badge color
     */
    public function getStatusColorAttribute()
    {
        return match ($this->status_keseluruhan) {
            'Menunggu' => 'amber',
            'Dalam Pemeriksaan' => 'blue',
            'Lolos' => 'emerald',
            'Lolos Bersyarat' => 'indigo',
            'Ditahan' => 'orange',
            'Ditolak' => 'rose',
            'Selesai' => 'slate',
            default => 'slate',
        };
    }

    /**
     * Get lokasi badge color
     */
    public function getLokasiColorAttribute()
    {
        return match ($this->lokasi_terakhir) {
            'Pos 1 - Antrian' => 'blue',
            'Pos 1 - Cek Kendaraan' => 'indigo',
            'Pos 1 - HSE' => 'amber',
            'Pos 2 - Cek DO' => 'emerald',
            'Pos 2 - Cek Barang' => 'emerald',
            'Area Bongkar Muat' => 'slate',
            'Keluar' => 'slate',
            'Ditolak' => 'rose',
            default => 'slate',
        };
    }

    /**
     * Helper methods for UI (compatible with calls like getStatusColor())
     */
    public function getStatusColor()
    {
        return $this->status_color;
    }

    public function getLokasiColor()
    {
        return $this->lokasi_color;
    }

    /**
     * Update lokasi dan status
     */
    public function updateLokasi($lokasi, $status = null)
    {
        $this->lokasi_terakhir = $lokasi;

        if ($status) {
            $this->status_keseluruhan = $status;
        }

        $this->save();
    }

    /**
     * Mark tahapan sebagai selesai
     */
    public function markTahapanSelesai($tahapan, $relatedId = null)
    {
        switch ($tahapan) {
            case 'antrian':
                $this->sudah_antrian = true;
                $this->waktu_antrian = now();
                if ($relatedId)
                    $this->antrian_id = $relatedId;
                break;
            case 'cek_kendaraan':
                $this->sudah_cek_kendaraan = true;
                $this->waktu_cek_kendaraan = now();
                if ($relatedId)
                    $this->cek_kendaraan_id = $relatedId;
                break;
            case 'hse':
                $this->sudah_hse = true;
                $this->waktu_hse = now();
                if ($relatedId)
                    $this->hse_id = $relatedId;
                break;
            case 'cek_do':
                $this->sudah_cek_do = true;
                $this->waktu_cek_do = now();
                if ($relatedId)
                    $this->do_item_id = $relatedId;
                break;
            case 'cek_barang':
                $this->sudah_cek_barang = true;
                $this->waktu_cek_barang = now();
                if ($relatedId)
                    $this->cek_barang_id = $relatedId;
                break;
        }

        $this->save();
    }
}
