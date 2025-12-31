<?php

namespace App\Http\Controllers;

use App\Models\Hse;
use Illuminate\Http\Request;

class HseController extends Controller
{
    public function index()
    {
        $hseList = Hse::orderBy('created_at', 'desc')->get();
        return view('navigasi.daftar-hse', compact('hseList'));
    }

    public function create()
    {
        return view('navigasi.input-hse');
    }

    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'tanggal' => 'required|date',
            'waktu' => 'required',
            'nama_petugas' => 'required|string|max:255',
            'nomor_polisi' => 'nullable|string|max:20',
            'nama_driver' => 'nullable|string|max:255',
            'perusahaan' => 'nullable|string|max:255',
            'catatan_safety' => 'nullable|string',
            'tindak_lanjut' => 'nullable|string',
            'status' => 'required|in:Lolos,Perbaikan,Ditolak',
        ]);

        $data = $request->all();
        // Handle boolean checkboxes
        $booleanFields = [
            'helm_safety',
            'sepatu_safety',
            'rompi_safety',
            'masker',
            'sarung_tangan',
            'kacamata_safety',
            'apar_tersedia',
            'kotak_p3k',
        ];

        foreach ($booleanFields as $field) {
            $data[$field] = $request->has($field);
        }

        // Simpan data ke database
        Hse::create($data);

        // Redirect dengan pesan sukses
        return redirect()->route('hse.daftar')->with('success', 'Data HSE Checking berhasil disimpan!');
    }

    public function show($id)
    {
        $hse = Hse::findOrFail($id);
        return view('navigasi.detail-hse', compact('hse'));
    }

    public function edit($id)
    {
        $hse = Hse::findOrFail($id);
        return view('navigasi.edit-hse', compact('hse'));
    }

    public function update(Request $request, $id)
    {
        $hse = Hse::findOrFail($id);

        $validated = $request->validate([
            'tanggal' => 'required|date',
            'waktu' => 'required',
            'nama_petugas' => 'required|string|max:255',
            'nomor_polisi' => 'nullable|string|max:20',
            'nama_driver' => 'nullable|string|max:255',
            'perusahaan' => 'nullable|string|max:255',
            'catatan_safety' => 'nullable|string',
            'tindak_lanjut' => 'nullable|string',
            'status' => 'required|in:Lolos,Perbaikan,Ditolak',
        ]);

        $data = $request->all();
        $booleanFields = [
            'helm_safety',
            'sepatu_safety',
            'rompi_safety',
            'masker',
            'sarung_tangan',
            'kacamata_safety',
            'apar_tersedia',
            'kotak_p3k',
        ];

        foreach ($booleanFields as $field) {
            $data[$field] = $request->has($field);
        }

        $hse->update($data);

        return redirect()->route('hse.daftar')->with('success', 'Data HSE berhasil diperbarui!');
    }

    public function exportPdf($id)
    {
        $hse = Hse::findOrFail($id);
        return view('pdf.hse', compact('hse'));
    }

    public function mainDashboard()
    {
        $pos1Queues = session('pos1_queues', []);
        $pos2Queues = session('pos2_queues', []);

        // Get HSE data for last 6 months
        $monthlyData = [];
        $monthLabels = [];

        for ($i = 5; $i >= 0; $i--) {
            $date = now()->subMonths($i);
            $year = $date->year;
            $month = $date->month;

            // Count HSE reports for this month using YEAR and MONTH functions
            $count = Hse::whereYear('tanggal', $year)
                ->whereMonth('tanggal', $month)
                ->count();

            $monthlyData[] = $count;
            $monthLabels[] = $date->format('M Y');
        }

        return view('main.main', compact('pos1Queues', 'pos2Queues', 'monthlyData', 'monthLabels'));
    }
}
