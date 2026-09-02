<?php

namespace App\Http\Controllers;

use App\Models\Tracking;
use App\Models\AntrianPos1;
use App\Models\CekKendaraan;
use App\Models\Hse;
use App\Models\DoItem;
use App\Models\CekBarang;
use App\Models\TrackingHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TrackingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Tracking::with(['antrian', 'cekKendaraan', 'hse', 'doItem', 'cekBarang'])
            ->orderBy('created_at', 'desc');

        // Filter berdasarkan status
        if ($request->has('status') && $request->status != '') {
            $query->where('status_keseluruhan', $request->status);
        }

        // Filter berdasarkan lokasi
        if ($request->has('lokasi') && $request->lokasi != '') {
            $query->where('lokasi_terakhir', $request->lokasi);
        }

        // Filter berdasarkan tanggal
        if ($request->has('tanggal') && $request->tanggal != '') {
            $query->whereDate('tanggal', $request->tanggal);
        }

        // Filter berdasarkan nomor polisi
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nomor_polisi', 'like', "%{$search}%")
                    ->orWhere('nama_driver', 'like', "%{$search}%")
                    ->orWhere('tracking_number', 'like', "%{$search}%")
                    ->orWhere('perusahaan', 'like', "%{$search}%");
            });
        }

        $trackings = $query->paginate(20);

        return view('navigasi.daftar-tracking', compact('trackings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('navigasi.input-tracking');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nomor_polisi' => 'required|string|max:20',
            'nama_driver' => 'required|string|max:100',
            'perusahaan' => 'nullable|string|max:100',
            'jenis_kendaraan' => 'required|in:Truk,Pickup,Mobil Box,Tangki,Lainnya',
            'tanggal' => 'required|date',
            'waktu_masuk' => 'nullable|date_format:H:i',
            'lokasi' => 'nullable|string|max:100',
            'jenis_muatan' => 'nullable|string|max:100',
            'nomor_do' => 'nullable|string|max:50',
            'jenis_antrian' => 'nullable|in:Finish Product,Use Oil,Raw Material,Drum,Lainnya',
            'tujuan' => 'nullable|string|max:100',
            'catatan_umum' => 'nullable|string',
        ]);

        $tracking = Tracking::create($validated);

        // Log Activity
        TrackingHistory::logActivity(
            $tracking->id,
            'create',
            'Pendaftaran Tracking',
            'Pendaftaran unit baru di POS 1',
            null,
            $tracking->toArray(),
            auth()->user()->name ?? 'System',
            'POS 1'
        );

        return redirect()->route('tracking.show', $tracking)
            ->with('success', 'Tracking berhasil dibuat dengan nomor: ' . $tracking->tracking_number);
    }

    /**
     * Display the specified resource.
     */
    public function show(Tracking $tracking)
    {
        $tracking->load(['antrian', 'cekKendaraan', 'hse', 'doItem', 'cekBarang']);

        return view('navigasi.detail-tracking', compact('tracking'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tracking $tracking)
    {
        return view('navigasi.edit-tracking', compact('tracking'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tracking $tracking)
    {
        $validated = $request->validate([
            'nomor_polisi' => 'required|string|max:20',
            'nama_driver' => 'required|string|max:100',
            'perusahaan' => 'nullable|string|max:100',
            'jenis_kendaraan' => 'required|in:Truk,Pickup,Mobil Box,Tangki,Lainnya',
            'tanggal' => 'required|date',
            'waktu_masuk' => 'nullable|date_format:H:i',
            'waktu_keluar' => 'nullable|date_format:H:i',
            'lokasi' => 'nullable|string|max:100',
            'lokasi_terakhir' => 'required|string',
            'status_keseluruhan' => 'required|string',
            'jenis_muatan' => 'nullable|string|max:100',
            'nomor_do' => 'nullable|string|max:50',
            'jenis_antrian' => 'nullable|in:Finish Product,Use Oil,Raw Material,Drum,Lainnya',
            'tujuan' => 'nullable|string|max:100',
            'catatan_umum' => 'nullable|string',
        ]);

        $oldData = $tracking->getOriginal();
        $tracking->update($validated);

        // Log Activity
        TrackingHistory::logActivity(
            $tracking->id,
            'update',
            'Update Data Tracking',
            'Pembaruan informasi tracking',
            $oldData,
            $tracking->toArray(),
            auth()->user()->name ?? 'System',
            'POS 1'
        );

        return redirect()->route('tracking.show', $tracking)
            ->with('success', 'Tracking berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tracking $tracking)
    {
        $tracking->delete();

        return redirect()->route('tracking.index')
            ->with('success', 'Tracking berhasil dihapus');
    }

    /**
     * Dashboard tracking - menampilkan overview
     */
    public function dashboard()
    {
        $today = today();

        // Statistik hari ini
        $stats = [
            'total_hari_ini' => Tracking::whereDate('tanggal', $today)->count(),
            'menunggu' => Tracking::whereDate('tanggal', $today)->where('status_keseluruhan', 'Menunggu')->count(),
            'dalam_pemeriksaan' => Tracking::whereDate('tanggal', $today)->where('status_keseluruhan', 'Dalam Pemeriksaan')->count(),
            'lolos' => Tracking::whereDate('tanggal', $today)->where('status_keseluruhan', 'Lolos')->count(),
            'ditolak' => Tracking::whereDate('tanggal', $today)->where('status_keseluruhan', 'Ditolak')->count(),
            'selesai' => Tracking::whereDate('tanggal', $today)->where('status_keseluruhan', 'Selesai')->count(),
        ];

        // Tracking aktif (belum selesai)
        $trackingAktif = Tracking::aktif()
            ->whereDate('tanggal', $today)
            ->with(['antrian', 'cekKendaraan', 'hse', 'doItem', 'cekBarang'])
            ->orderBy('created_at', 'desc')
            ->get();

        // Distribusi per lokasi
        $distribusiLokasi = Tracking::whereDate('tanggal', $today)
            ->select('lokasi_terakhir', DB::raw('count(*) as total'))
            ->groupBy('lokasi_terakhir')
            ->get();

        return view('tracking.dashboard', compact('stats', 'trackingAktif', 'distribusiLokasi'));
    }

    /**
     * Update lokasi kendaraan
     */
    public function updateLokasi(Request $request, Tracking $tracking)
    {
        $validated = $request->validate([
            'lokasi_terakhir' => 'required|string',
            'status_keseluruhan' => 'nullable|string',
        ]);

        $oldData = $tracking->getOriginal();
        $tracking->updateLokasi(
            $validated['lokasi_terakhir'],
            $validated['status_keseluruhan'] ?? null
        );

        // Log Activity
        TrackingHistory::logActivity(
            $tracking->id,
            'update_lokasi',
            'Update Lokasi',
            "Perpindahan lokasi ke " . $validated['lokasi_terakhir'],
            $oldData,
            $tracking->toArray(),
            auth()->user()->name ?? 'System',
            $validated['lokasi_terakhir']
        );

        return back()->with('success', 'Lokasi berhasil diupdate');
    }

    /**
     * Link tracking dengan antrian
     */
    public function linkAntrian(Request $request, Tracking $tracking)
    {
        $validated = $request->validate([
            'antrian_id' => 'required|exists:antrian_pos1,id',
        ]);

        $oldData = $tracking->getOriginal();
        $tracking->markTahapanSelesai('antrian', $validated['antrian_id']);
        $tracking->updateLokasi('Pos 1 - Antrian', 'Dalam Pemeriksaan');

        // Log Activity
        TrackingHistory::logActivity(
            $tracking->id,
            'link_antrian',
            'Link Antrian',
            "Unit dikaitkan dengan Antrian ID: " . $validated['antrian_id'],
            $oldData,
            $tracking->toArray(),
            auth()->user()->name ?? 'System',
            'Pos 1 - Antrian'
        );

        return back()->with('success', 'Tracking berhasil di-link dengan antrian');
    }

    /**
     * Link tracking dengan cek kendaraan
     */
    public function linkCekKendaraan(Request $request, Tracking $tracking)
    {
        $validated = $request->validate([
            'cek_kendaraan_id' => 'required|exists:cek_kendaraan,id',
        ]);

        $cekKendaraan = CekKendaraan::find($validated['cek_kendaraan_id']);

        $oldData = $tracking->getOriginal();
        $tracking->markTahapanSelesai('cek_kendaraan', $validated['cek_kendaraan_id']);
        $tracking->status_cek_kendaraan = $cekKendaraan->hasil_pemeriksaan;
        $tracking->updateLokasi('Pos 1 - Cek Kendaraan', 'Dalam Pemeriksaan');
        $tracking->save();

        // Log Activity
        TrackingHistory::logActivity(
            $tracking->id,
            'link_cek_kendaraan',
            'Link Cek Kendaraan',
            "Unit dikaitkan dengan Cek Kendaraan ID: " . $validated['cek_kendaraan_id'] . " (Hasil: " . $tracking->status_cek_kendaraan . ")",
            $oldData,
            $tracking->toArray(),
            auth()->user()->name ?? 'System',
            'Pos 1 - Cek Kendaraan'
        );

        return back()->with('success', 'Tracking berhasil di-link dengan cek kendaraan');
    }

    /**
     * Link tracking dengan HSE
     */
    public function linkHse(Request $request, Tracking $tracking)
    {
        $validated = $request->validate([
            'hse_id' => 'required|exists:hse,id',
        ]);

        $hse = Hse::find($validated['hse_id']);

        $oldData = $tracking->getOriginal();
        $tracking->markTahapanSelesai('hse', $validated['hse_id']);
        $tracking->status_hse = $hse->status;
        $tracking->updateLokasi('Pos 1 - HSE', 'Dalam Pemeriksaan');
        $tracking->save();

        // Log Activity
        TrackingHistory::logActivity(
            $tracking->id,
            'link_hse',
            'Link HSE',
            "Unit dikaitkan dengan HSE ID: " . $validated['hse_id'] . " (Status: " . $tracking->status_hse . ")",
            $oldData,
            $tracking->toArray(),
            auth()->user()->name ?? 'System',
            'Pos 1 - HSE'
        );

        return back()->with('success', 'Tracking berhasil di-link dengan HSE');
    }

    /**
     * Link tracking dengan Cek DO
     */
    public function linkCekDo(Request $request, Tracking $tracking)
    {
        $validated = $request->validate([
            'do_item_id' => 'required|exists:do_items,id',
        ]);

        $doItem = DoItem::find($validated['do_item_id']);

        $oldData = $tracking->getOriginal();
        $tracking->markTahapanSelesai('cek_do', $validated['do_item_id']);
        $tracking->status_cek_do = 'Valid'; // Bisa disesuaikan dengan logika validasi DO
        $tracking->updateLokasi('Pos 2 - Cek DO', 'Dalam Pemeriksaan');
        $tracking->save();

        // Log Activity
        TrackingHistory::logActivity(
            $tracking->id,
            'link_cek_do',
            'Link Cek DO',
            "Unit dikaitkan dengan Cek DO ID: " . $validated['do_item_id'] . " (Status: " . $tracking->status_cek_do . ")",
            $oldData,
            $tracking->toArray(),
            auth()->user()->name ?? 'System',
            'Pos 2 - Cek DO'
        );

        return back()->with('success', 'Tracking berhasil di-link dengan Cek DO');
    }

    /**
     * Link tracking dengan cek barang
     */
    public function linkCekBarang(Request $request, Tracking $tracking)
    {
        $validated = $request->validate([
            'cek_barang_id' => 'required|exists:cek_barang,id',
        ]);

        $cekBarang = CekBarang::find($validated['cek_barang_id']);

        $oldData = $tracking->getOriginal();
        $tracking->markTahapanSelesai('cek_barang', $validated['cek_barang_id']);
        $tracking->status_cek_barang = $cekBarang->status_akhir;
        $tracking->updateLokasi('Pos 2 - Cek Barang', 'Dalam Pemeriksaan');
        $tracking->save();

        // Log Activity
        TrackingHistory::logActivity(
            $tracking->id,
            'link_cek_barang',
            'Link Cek Barang',
            "Unit dikaitkan dengan Cek Barang ID: " . $validated['cek_barang_id'] . " (Status: " . $tracking->status_cek_barang . ")",
            $oldData,
            $tracking->toArray(),
            auth()->user()->name ?? 'System',
            'Pos 2 - Cek Barang'
        );

        return back()->with('success', 'Tracking berhasil di-link dengan cek barang');
    }

    /**
     * Mark tracking sebagai selesai
     */
    public function markSelesai(Request $request, Tracking $tracking)
    {
        $validated = $request->validate([
            'waktu_keluar' => 'required|date_format:H:i',
            'catatan_umum' => 'nullable|string',
        ]);

        $oldData = $tracking->getOriginal();
        $tracking->waktu_keluar = $validated['waktu_keluar'];
        $tracking->waktu_selesai = now();
        $tracking->status_keseluruhan = 'Selesai';
        $tracking->lokasi_terakhir = 'Keluar';

        if (isset($validated['catatan_umum'])) {
            $tracking->catatan_umum = $validated['catatan_umum'];
        }

        $tracking->save();

        // Log Activity
        TrackingHistory::logActivity(
            $tracking->id,
            'complete',
            'Tracking Selesai',
            'Unit telah keluar dari area pabrik',
            $oldData,
            $tracking->toArray(),
            auth()->user()->name ?? 'System',
            'Keluar'
        );

        return back()->with('success', 'Tracking berhasil diselesaikan');
    }

    /**
     * Get tracking by nomor polisi
     */
    public function getByNomorPolisi(Request $request)
    {
        $nomorPolisi = $request->input('nomor_polisi');

        $tracking = Tracking::where('nomor_polisi', $nomorPolisi)
            ->whereDate('tanggal', today())
            ->aktif()
            ->with(['antrian', 'cekKendaraan', 'hse', 'doItem', 'cekBarang'])
            ->first();

        if ($tracking) {
            return response()->json([
                'success' => true,
                'data' => $tracking
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Tracking tidak ditemukan untuk nomor polisi: ' . $nomorPolisi
        ], 404);
    }

    /**
     * Export tracking data
     */
    public function export(Request $request)
    {
        $query = Tracking::with(['antrian', 'cekKendaraan', 'hse', 'doItem', 'cekBarang']);

        // Filter berdasarkan tanggal range
        if ($request->has('start_date') && $request->has('end_date')) {
            $query->whereBetween('tanggal', [$request->start_date, $request->end_date]);
        }

        $trackings = $query->get();

        // Bisa diimplementasikan export ke Excel/PDF
        // Untuk sekarang return JSON
        return response()->json($trackings);
    }

    /**
     * Get statistics
     */
    public function statistics(Request $request)
    {
        $startDate = $request->input('start_date', today()->subDays(7));
        $endDate = $request->input('end_date', today());

        $stats = [
            'total' => Tracking::whereBetween('tanggal', [$startDate, $endDate])->count(),
            'by_status' => Tracking::whereBetween('tanggal', [$startDate, $endDate])
                ->select('status_keseluruhan', DB::raw('count(*) as total'))
                ->groupBy('status_keseluruhan')
                ->get(),
            'by_lokasi' => Tracking::whereBetween('tanggal', [$startDate, $endDate])
                ->select('lokasi_terakhir', DB::raw('count(*) as total'))
                ->groupBy('lokasi_terakhir')
                ->get(),
            'by_jenis_kendaraan' => Tracking::whereBetween('tanggal', [$startDate, $endDate])
                ->select('jenis_kendaraan', DB::raw('count(*) as total'))
                ->groupBy('jenis_kendaraan')
                ->get(),
            'avg_durasi' => Tracking::whereBetween('tanggal', [$startDate, $endDate])
                ->whereNotNull('durasi_menit')
                ->avg('durasi_menit'),
        ];

        return response()->json($stats);
    }
}
