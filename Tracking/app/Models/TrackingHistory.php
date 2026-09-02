<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TrackingHistory extends Model
{
    protected $table = 'tracking_histories';

    protected $fillable = [
        'tracking_id',
        'tracking_number',
        'action_type',
        'action_name',
        'description',
        'old_data',
        'new_data',
        'petugas',
        'lokasi'
    ];

    protected $casts = [
        'old_data' => 'array',
        'new_data' => 'array',
    ];

    public function tracking()
    {
        return $this->belongsTo(Tracking::class, 'tracking_id');
    }

    public static function logActivity($trackingId, $trackingNumber, $type, $name, $description = null, $oldData = null, $newData = null, $petugas = null, $lokasi = null)
    {
        return self::create([
            'tracking_id' => $trackingId,
            'tracking_number' => $trackingNumber,
            'action_type' => $type,
            'action_name' => $name,
            'description' => $description,
            'old_data' => $oldData,
            'new_data' => $newData,
            'petugas' => $petugas,
            'lokasi' => $lokasi
        ]);
    }
}
