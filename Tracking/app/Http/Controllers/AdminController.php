<?php

namespace App\Http\Controllers;

use App\Models\Hse;
use App\Models\CekKendaraan;
use App\Models\AntrianPos1;
use App\Models\DoItem;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        // Get HSE data for last 6 months
        $monthlyData = [];
        $monthLabels = [];

        for ($i = 5; $i >= 0; $i--) {
            $date = now()->subMonths($i);
            $year = $date->year;
            $month = $date->month;

            // Count HSE reports for this month
            $count = Hse::whereYear('tanggal', $year)
                ->whereMonth('tanggal', $month)
                ->count();

            $monthlyData[] = $count;
            $monthLabels[] = $date->format('M Y');
        }

        // Get total counts
        $totalHse = Hse::count();
        $totalVehicleInspections = CekKendaraan::count();

        // Get POS 1 data (AntrianPos1)
        $pos1_count = AntrianPos1::count();
        $pos1_today = AntrianPos1::whereDate('created_at', today())->count();

        // Get POS 2 data (CekKendaraan)
        $pos2_count = CekKendaraan::count();
        $pos2_today = CekKendaraan::whereDate('created_at', today())->count();

        // Get SCM data (DoItem)
        $scm_count = DoItem::count();
        $scm_today = DoItem::whereDate('created_at', today())->count();

        return view('admin.dashboard', compact(
            'monthlyData',
            'monthLabels',
            'totalHse',
            'totalVehicleInspections',
            'pos1_count',
            'pos1_today',
            'pos2_count',
            'pos2_today',
            'scm_count',
            'scm_today'
        ));
    }
}
