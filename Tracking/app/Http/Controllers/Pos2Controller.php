<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Pos2Controller extends Controller
{
    public function index()
    {
        // Basic Stats
        $totalDistribusi = \App\Models\CekBarang::count();
        $distribusiToday = \App\Models\CekBarang::whereDate('tanggal', today())->count();

        // Quality Metrics
        $totalChecked = \App\Models\CekBarang::count();
        $lolosCount = \App\Models\CekBarang::where('status_akhir', 'Lolos')->count();
        $ditahanCount = \App\Models\CekBarang::where('status_akhir', 'Ditahan')->count();
        $ditolakCount = \App\Models\CekBarang::where('status_akhir', 'Ditolak')->count();
        $lolosPercentage = $totalChecked > 0 ? round(($lolosCount / $totalChecked) * 100) : 0;

        // Monthly Distribution Trends (Last 6 Months)
        $monthLabels = [];
        $monthlyDistribusi = [];
        $monthlyLolos = [];
        $monthlyDitahan = [];

        for ($i = 5; $i >= 0; $i--) {
            $date = now()->subMonths($i);
            $monthLabels[] = $date->format('M');

            $monthlyDistribusi[] = \App\Models\CekBarang::whereYear('tanggal', $date->year)
                ->whereMonth('tanggal', $date->month)
                ->count();

            $monthlyLolos[] = \App\Models\CekBarang::whereYear('tanggal', $date->year)
                ->whereMonth('tanggal', $date->month)
                ->where('status_akhir', 'Lolos')
                ->count();

            $monthlyDitahan[] = \App\Models\CekBarang::whereYear('tanggal', $date->year)
                ->whereMonth('tanggal', $date->month)
                ->where('status_akhir', 'Ditahan')
                ->count();
        }

        // Recent Activities
        $recentActivities = \App\Models\CekBarang::orderBy('created_at', 'desc')->take(5)->get();

        // Top Performing Vehicles (by Lolos rate)
        $topVehicles = \App\Models\CekBarang::selectRaw('nomor_polisi, COUNT(*) as total, SUM(CASE WHEN status_akhir = "Lolos" THEN 1 ELSE 0 END) as lolos')
            ->groupBy('nomor_polisi')
            ->havingRaw('COUNT(*) >= 3')
            ->orderByRaw('(SUM(CASE WHEN status_akhir = "Lolos" THEN 1 ELSE 0 END) / COUNT(*)) DESC')
            ->take(5)
            ->get();

        return view('navigasi.pos2', compact(
            'totalDistribusi',
            'distribusiToday',
            'lolosPercentage',
            'lolosCount',
            'ditahanCount',
            'ditolakCount',
            'monthLabels',
            'monthlyDistribusi',
            'monthlyLolos',
            'monthlyDitahan',
            'recentActivities',
            'topVehicles'
        ));
    }
}
