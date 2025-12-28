<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Hse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class HseController extends Controller
{
    /**
     * Get list of HSE records
     */
    public function index()
    {
        $hse = Hse::orderBy('created_at', 'desc')->get();
        return response()->json([
            'success' => true,
            'data' => $hse
        ], 200);
    }

    /**
     * Store new HSE record
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'tanggal' => 'required|date',
            'waktu' => 'required',
            'nama_petugas' => 'required|string',
            'lokasi' => 'required|string',
            'kondisi_apd' => 'required|string|in:Lengkap,Tidak Lengkap,Tidak Ada',
            'temuan' => 'nullable|string',
            'tindak_lanjut' => 'nullable|string',
            'penanggung_jawab' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation Error',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $hse = Hse::create($request->all());

            return response()->json([
                'success' => true,
                'message' => 'Data HSE berhasil disimpan',
                'data' => $hse
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to save data',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
