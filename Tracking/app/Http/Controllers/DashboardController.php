<?php

namespace App\Http\Controllers;

use App\Models\AntrianPos1;
use App\Models\CekKendaraan;
use App\Models\DoItem;
use App\Models\Hse;

class DashboardController extends Controller
{
    public function index()
    {
        // Fetch metrics for POS 1
        $pos1_count = AntrianPos1::count();
        $pos1_today = AntrianPos1::whereDate('created_at', today())->count();

        // Fetch metrics for POS 2
        $pos2_count = CekKendaraan::count();
        $pos2_today = CekKendaraan::whereDate('created_at', today())->count();

        // Fetch metrics for SCM
        $scm_count = DoItem::count();
        $scm_today = DoItem::whereDate('created_at', today())->count();

        return view('main.main', compact(
            'pos1_count',
            'pos1_today',
            'pos2_count',
            'pos2_today',
            'scm_count',
            'scm_today'
        ));
    }
}
