<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function index()
{
    // Statistik jumlah status (pakai data aktif)
    $totalServis     = Service::count();
    $servisMasuk     = Service::where('status', 'masuk')->count();
    $servisProses    = Service::where('status', 'diperbaiki')->count();
    $servisSelesai   = Service::where('status', 'selesai')->count();

    // === Grafik Pendapatan Mingguan dari data yang sudah dihapus ===
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

    // === Grafik Pendapatan Bulanan dari data yang sudah dihapus ===
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

    return view('admin.dashboard', compact(
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


    /**
     * Tampilkan transaksi yang sudah selesai.
     */
   public function transaksi(Request $request)
{
    $query = \App\Models\Service::query()->where('status', 'selesai');

    if ($request->tanggal) {
        $query->whereDate('received_at', $request->tanggal);
    }

    if ($request->pickup_code) {
        $query->where('pickup_code', 'like', '%' . $request->pickup_code . '%');
    }

    // $data = $query->get();
    $data = $query->orderBy('updated_at', 'desc')->paginate(10);

    return view('admin.transaksi', compact('data'));
}

}
