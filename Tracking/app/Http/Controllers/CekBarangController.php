<?php

namespace App\Http\Controllers;

use App\Models\CekBarang;
use Illuminate\Http\Request;

class CekBarangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cekBarangList = CekBarang::orderBy('tanggal', 'desc')
            ->orderBy('waktu', 'desc')
            ->get();

        return view('navigasi.daftar-cek-barang', compact('cekBarangList'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('navigasi.input-cek-barang');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'tanggal' => 'required|date',
            'waktu' => 'required',
            'nama_pemeriksa' => 'required|string|max:255',
            'nomor_polisi' => 'required|string|max:255',
            'nama_pengemudi' => 'required|string|max:255',
            'nomor_do' => 'nullable|string|max:255',
            'jenis_barang' => 'required|string|max:255',
            'jumlah_barang' => 'required|integer|min:1',
            'satuan' => 'required|string|max:255',
            'kondisi_kemasan' => 'required|in:Baik,Rusak,Basah',
            'kesesuaian_jumlah' => 'required|in:Sesuai,Kurang,Lebih',
            'kelengkapan_dokumen' => 'required|in:Lengkap,Tidak Lengkap',
            'jenis_kendaraan' => 'required|in:Truck Tangki,Truck Biasa,Lainnya',
            'kebocoran_tangki' => 'nullable|in:Tidak Ada,Ada Kebocoran Kecil,Ada Kebocoran Besar',
            'kondisi_seal_tangki' => 'nullable|in:Baik,Rusak,Tidak Ada',
            'lokasi_kebocoran' => 'nullable|string',
            'catatan' => 'nullable|string',
            'status_akhir' => 'required|in:Lolos,Ditahan,Ditolak',
        ]);

        CekBarang::create($validated);

        return redirect()->route('cek-barang.index')
            ->with('success', 'Data pemeriksaan barang berhasil disimpan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(CekBarang $cekBarang)
    {
        return view('navigasi.detail-cek-barang', compact('cekBarang'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CekBarang $cekBarang)
    {
        return view('navigasi.edit-cek-barang', compact('cekBarang'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CekBarang $cekBarang)
    {
        $validated = $request->validate([
            'tanggal' => 'required|date',
            'waktu' => 'required',
            'nama_pemeriksa' => 'required|string|max:255',
            'nomor_polisi' => 'required|string|max:255',
            'nama_pengemudi' => 'required|string|max:255',
            'nomor_do' => 'nullable|string|max:255',
            'jenis_barang' => 'required|string|max:255',
            'jumlah_barang' => 'required|integer|min:1',
            'satuan' => 'required|string|max:255',
            'kondisi_kemasan' => 'required|in:Baik,Rusak,Basah',
            'kesesuaian_jumlah' => 'required|in:Sesuai,Kurang,Lebih',
            'kelengkapan_dokumen' => 'required|in:Lengkap,Tidak Lengkap',
            'jenis_kendaraan' => 'required|in:Truck Tangki,Truck Biasa,Lainnya',
            'kebocoran_tangki' => 'nullable|in:Tidak Ada,Ada Kebocoran Kecil,Ada Kebocoran Besar',
            'kondisi_seal_tangki' => 'nullable|in:Baik,Rusak,Tidak Ada',
            'lokasi_kebocoran' => 'nullable|string',
            'catatan' => 'nullable|string',
            'status_akhir' => 'required|in:Lolos,Ditahan,Ditolak',
        ]);

        $cekBarang->update($validated);

        return redirect()->route('cek-barang.index')
            ->with('success', 'Data pemeriksaan barang berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CekBarang $cekBarang)
    {
        $cekBarang->delete();

        return redirect()->route('cek-barang.index')
            ->with('success', 'Data pemeriksaan barang berhasil dihapus!');
    }

    /**
     * Export PDF for specific cek barang.
     */
    public function exportPdf($id)
    {
        $cekBarang = CekBarang::findOrFail($id);
        return view('pdf.cek-barang', compact('cekBarang'));
    }
}
