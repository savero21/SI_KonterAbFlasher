<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function index()
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
        $query = Service::query()->where('status', 'selesai');

        if ($request->tanggal) {
            $query->whereDate('received_at', $request->tanggal);
        }

        if ($request->pickup_code) {
            $query->where('pickup_code', 'like', '%' . $request->pickup_code . '%');
        }

        $data = $query->orderBy('updated_at', 'desc')->paginate(10);

        return view('admin.transaksi', compact('data'));
    }

    /**
     * ✅ Tampilkan semua komplain
     */
   public function kelolaKomplain()
{
    // Ambil data yang sudah dihapus tetapi punya komplain
    $komplain = \App\Models\Service::onlyTrashed()
        ->whereNotNull('complain')
        ->latest('deleted_at')
        ->get();

    return view('admin.komplain.index', compact('komplain'));
}

    /**
     * ✅ Simpan balasan komplain
     */
    public function balasKomplain(Request $request, $id)
    {
        $request->validate([
            'complain_reply' => 'required|string|max:1000',
        ]);

           $service = Service::withTrashed()->findOrFail($id);
        $service->complain_reply = $request->complain_reply;
        $service->save();

        return redirect()->route('admin.komplain')->with('success', 'Balasan komplain berhasil dikirim.');
    }

    public function hapusKomplain($id)
{
    $service = \App\Models\Service::withTrashed()->findOrFail($id);
    $service->complain = null;
    $service->complain_reply = null;
    $service->save();

    return back()->with('success', 'Komplain berhasil dihapus.');
}

}
