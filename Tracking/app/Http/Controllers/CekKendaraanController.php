<?php

namespace App\Http\Controllers;

use App\Models\CekKendaraan;
use Illuminate\Http\Request;

class CekKendaraanController extends Controller
{
    public function index()
    {
        $cekKendaraanList = CekKendaraan::orderBy('tanggal', 'desc')
            ->orderBy('waktu_masuk', 'desc')
            ->get();

        return view('navigasi.daftar-cek-kendaraan', compact('cekKendaraanList'));
    }

    public function edit(CekKendaraan $cekKendaraan)
    {
        return view('navigasi.edit-cek-kendaraan', compact('cekKendaraan'));
    }

    public function update(Request $request, CekKendaraan $cekKendaraan)
    {
        $validated = $request->validate([
            'tanggal' => 'required|date',
            'waktu_masuk' => 'required',
            'nomor_polisi' => 'required|string|max:20',
            'jenis_kendaraan' => 'required|string',
            'nama_driver' => 'required|string|max:255',
            'perusahaan' => 'nullable|string|max:255',

            'kondisi_ban' => 'required|string',
            'kondisi_lampu' => 'required|string',
            'kondisi_rem' => 'required|string',
            'kondisi_lampu_sen' => 'required|string',
            'hasil_pemeriksaan' => 'required|string',
            'nama_petugas' => 'required|string|max:255',
        ]);

        $data = $request->all();
        // Handle boolean fields which might not be present if unchecked
        $data['surat_jalan'] = $request->has('surat_jalan');
        $data['stnk_valid'] = $request->has('stnk_valid');
        $data['sim_valid'] = $request->has('sim_valid');
        $data['kir_valid'] = $request->has('kir_valid');
        $data['kaca_spion_lengkap'] = $request->has('kaca_spion_lengkap');


        $cekKendaraan->update($data);

        return redirect()->route('cek-kendaraan.daftar')->with('success', 'Data Pemeriksaan Berhasil Diperbarui!');
    }

    public function show(CekKendaraan $cekKendaraan)
    {
        // Detail view logic will be added here
    }

    public function destroy(CekKendaraan $cekKendaraan)
    {
        $cekKendaraan->delete();
        return redirect()->route('cek-kendaraan.daftar')->with('success', 'Data Pemeriksaan Berhasil Dihapus!');
    }

    public function exportPdf(CekKendaraan $cekKendaraan)
    {
        return view('pdf.cek-kendaraan', compact('cekKendaraan'));
    }
}
