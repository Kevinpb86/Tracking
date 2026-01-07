<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Pos1Controller extends Controller
{
    public function index()
    {
        // 1. HSE Data for Chart - Pass vs Fail Comparison (Current Logic)
        $monthLabels = [];
        $passedData = [];
        $failedData = [];

        for ($i = 5; $i >= 0; $i--) {
            $date = now()->subMonths($i);
            $monthLabels[] = $date->format('M');

            // Count passed HSE (status = 'Lolos')
            $passedData[] = \App\Models\Hse::whereYear('created_at', $date->year)
                ->whereMonth('created_at', $date->month)
                ->where('status', 'Lolos')
                ->count();

            // Count failed HSE (status = 'Perbaikan' or 'Ditolak')
            $failedData[] = \App\Models\Hse::whereYear('created_at', $date->year)
                ->whereMonth('created_at', $date->month)
                ->whereIn('status', ['Perbaikan', 'Ditolak'])
                ->count();
        }

        // 2. Antrian Trends (Last 30 Days)
        $antrianLabels = [];
        $antrianData = [];
        for ($i = 29; $i >= 0; $i--) {
            $date = now()->subDays($i);
            $antrianLabels[] = $date->format('d M');
            $antrianData[] = \App\Models\AntrianPos1::whereDate('created_at', $date)->count();
        }

        // 3. Cek Kendaraan Distribution (Last 2 Months)
        $startDate = now()->subMonth()->startOfMonth();
        $cekLolos = \App\Models\CekKendaraan::where('tanggal', '>=', $startDate)
            ->where('hasil_pemeriksaan', 'Lolos')
            ->count();
        $cekLolosBersyarat = \App\Models\CekKendaraan::where('tanggal', '>=', $startDate)
            ->where('hasil_pemeriksaan', 'Lolos Bersyarat')
            ->count();
        $cekTidakLolos = \App\Models\CekKendaraan::where('tanggal', '>=', $startDate)
            ->where('hasil_pemeriksaan', 'Tidak Lolos')
            ->count();

        $cekData = [$cekLolos, $cekLolosBersyarat, $cekTidakLolos];

        return view('navigasi.pos1', compact(
            'monthLabels',
            'passedData',
            'failedData',
            'antrianLabels',
            'antrianData',
            'cekData',
            'startDate'
        ));
    }

    public function create()
    {
        return view('navigasi.input-antrian-pos1');
    }

    public function store(\Illuminate\Http\Request $request)
    {
        // 1. Validate Input
        $validated = $request->validate([
            'tgl_antrian' => 'required|date',
            'jam_diizinkan_masuk' => 'required',
            'nomor_polisi' => 'required|string|max:20',
            'nama_driver' => 'required|string|max:100',
            // Nullable inputs
            'emr' => 'nullable|string|max:100',
            'jenis_antrian' => 'nullable|string|max:50',
            'tujuan' => 'nullable|string|max:100',
        ]);

        // 2. Generate Nomor Antrian Automated (Q-YYYYMMDD-XXX)
        $dateCode = date('Ymd', strtotime($validated['tgl_antrian']));
        $prefix = "Q-{$dateCode}-";

        // Find last number for this day
        $lastAntrian = \App\Models\AntrianPos1::where('no_antrian', 'like', "{$prefix}%")
            ->orderBy('no_antrian', 'desc')
            ->first();

        if ($lastAntrian) {
            $lastNumber = intval(substr($lastAntrian->no_antrian, -3));
            $newNumber = $lastNumber + 1;
        } else {
            $newNumber = 1;
        }

        $nomorAntrian = $prefix . str_pad($newNumber, 3, '0', STR_PAD_LEFT);

        // 3. Create Record
        \App\Models\AntrianPos1::create([
            'no_antrian' => $nomorAntrian,
            'emr' => $validated['emr'],
            'tgl_antrian' => $validated['tgl_antrian'],
            'jam_diizinkan_masuk' => $validated['jam_diizinkan_masuk'],
            'status' => 'Waiting', // Default status for new ticket
            'jenis_antrian' => $validated['jenis_antrian'],
            'nomor_polisi' => strtoupper($validated['nomor_polisi']),
            'nama_driver' => $validated['nama_driver'],
            'tujuan' => $validated['tujuan'],
        ]);

        // 4. Redirect with Success (Using simple redirect for now)
        // Ideally: return redirect()->route('pos1.antrian.index')->with('success', 'Antrian berhasil dibuat!');
        return redirect()->route('pos1.dashboard')->with('success', 'Antrian berhasil dibuat! Nomor: ' . $nomorAntrian);
    }

    public function daftarAntrian()
    {
        $antrianList = \App\Models\AntrianPos1::orderByRaw("
                CASE 
                    WHEN emr = 'Critical' THEN 1 
                    WHEN emr = 'Urgent' THEN 2 
                    ELSE 3 
                END ASC
            ")
            ->orderBy('no_antrian', 'asc')
            ->get();

        return view('navigasi.daftar-antrian', compact('antrianList'));
    }

    public function edit($id)
    {
        $antrian = \App\Models\AntrianPos1::findOrFail($id);
        return view('navigasi.edit-antrian', compact('antrian'));
    }

    public function update(\Illuminate\Http\Request $request, $id)
    {
        $validated = $request->validate([
            'tgl_antrian' => 'required|date',
            'jam_diizinkan_masuk' => 'required',
            'nomor_polisi' => 'required|string|max:20',
            'nama_driver' => 'required|string|max:100',
            'emr' => 'nullable|string|max:100', // Priority/Emergency
            'jenis_antrian' => 'nullable|string|max:50',
            'tujuan' => 'nullable|string|max:100',
            'status' => 'required|string|in:Waiting,In Process,Completed,Cancelled',
        ]);

        $antrian = \App\Models\AntrianPos1::findOrFail($id);

        $antrian->update([
            'tgl_antrian' => $validated['tgl_antrian'],
            'jam_diizinkan_masuk' => $validated['jam_diizinkan_masuk'],
            'nomor_polisi' => strtoupper($validated['nomor_polisi']),
            'nama_driver' => $validated['nama_driver'],
            'emr' => $validated['emr'],
            'jenis_antrian' => $validated['jenis_antrian'],
            'tujuan' => $validated['tujuan'],
            'status' => $validated['status'],
        ]);

        return redirect()->route('pos1.antrian.daftar')->with('success', 'Data antrian berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $antrian = \App\Models\AntrianPos1::findOrFail($id);
        $antrian->delete();

        return redirect()->route('pos1.antrian.daftar')->with('success', 'Data antrian berhasil dihapus!');
    }

    public function printTicket($id)
    {
        $antrian = \App\Models\AntrianPos1::findOrFail($id);
        return view('pdf.ticket-antrian', compact('antrian'));
    }
}
