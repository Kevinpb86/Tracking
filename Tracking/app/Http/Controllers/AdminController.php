<?php

namespace App\Http\Controllers;

use App\Models\Hse;
use App\Models\CekKendaraan;
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

        return view('admin.dashboard', compact('monthlyData', 'monthLabels', 'totalHse', 'totalVehicleInspections'));
    }
}
