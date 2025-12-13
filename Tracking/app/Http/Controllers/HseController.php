<?php

namespace App\Http\Controllers;

use App\Models\Hse;
use Illuminate\Http\Request;

class HseController extends Controller
{
    /**
     * Display a listing of HSE records.
     */
    public function index()
    {
        $hseList = Hse::orderBy('created_at', 'desc')->get();
        return view('navigasi.daftar-hse', compact('hseList'));
    }

    /**
     * Store a newly created HSE record in storage.
     */
    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'tanggal' => 'required|date',
            'waktu' => 'required',
            'nama_petugas' => 'required|string|max:255',
            'lokasi' => 'required|string|max:255',
            'kondisi_apd' => 'required|string|in:Lengkap,Tidak Lengkap,Tidak Ada',
            'temuan' => 'nullable|string',
            'tindak_lanjut' => 'nullable|string',
            'penanggung_jawab' => 'nullable|string|max:255',
        ]);

        // Simpan data ke database
        $hse = Hse::create([
            'tanggal' => $validated['tanggal'],
            'waktu' => $validated['waktu'],
            'nama_petugas' => $validated['nama_petugas'],
            'lokasi' => $validated['lokasi'],
            'kondisi_apd' => $validated['kondisi_apd'],
            'temuan' => $validated['temuan'] ?? null,
            'tindak_lanjut' => $validated['tindak_lanjut'] ?? null,
            'penanggung_jawab' => $validated['penanggung_jawab'] ?? null,
        ]);

        // Redirect dengan pesan sukses
        return redirect()->route('hse.input')->with('success', 'Data HSE berhasil disimpan ke database!');
    }
}
