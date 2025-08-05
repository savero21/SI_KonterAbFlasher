<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class SuperadminController extends Controller
{
    public function dashboard()
    {
        // Statistik jumlah status
        $totalServis     = Service::count();
        $servisMasuk     = Service::where('status', 'masuk')->count();
        $servisProses    = Service::where('status', 'diperbaiki')->count();
        $servisSelesai   = Service::where('status', 'selesai')->count();

        // Grafik Pendapatan Mingguan
        $weeklyLabels = [];
        $weeklyData   = [];

        $startOfWeek = Carbon::now()->startOfWeek(Carbon::MONDAY);
        for ($i = 0; $i < 7; $i++) {
            $day   = $startOfWeek->copy()->addDays($i);
            $label = $day->isoFormat('ddd');

            $total = Service::onlyTrashed()
                ->whereDate('deleted_at', $day->toDateString())
                ->sum('total_price');

            $weeklyLabels[] = $label;
            $weeklyData[]   = $total;
        }

        // Grafik Pendapatan Bulanan
        $monthlyLabels = [];
        $monthlyData   = [];

        $currentMonth = Carbon::now()->startOfMonth();
        for ($i = 5; $i >= 0; $i--) {
            $month = $currentMonth->copy()->subMonths($i);
            $label = $month->isoFormat('MMM YYYY');

            $total = Service::onlyTrashed()
                ->whereMonth('deleted_at', $month->month)
                ->whereYear('deleted_at', $month->year)
                ->sum('total_price');

            $monthlyLabels[] = $label;
            $monthlyData[]   = $total;
        }

        return view('superadmin.dashboard', compact(
            'totalServis',
            'servisMasuk',
            'servisProses',
            'servisSelesai',
            'weeklyLabels',
            'weeklyData',
            'monthlyLabels',
            'monthlyData'
        ));
    }
}
