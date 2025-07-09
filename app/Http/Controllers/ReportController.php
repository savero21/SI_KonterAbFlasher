<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\LaporanServisExport;

class ReportController extends Controller
{
    public function laporan()
    {
        $now = Carbon::now();

        // Rekap minggu ini (Senin - Minggu)
        $weeklyTotal = Service::onlyTrashed()
            ->whereBetween('deleted_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
            ->sum('total_price');

        // Rekap bulan ini
        $monthlyTotal = Service::onlyTrashed()
            ->whereMonth('deleted_at', $now->month)
            ->whereYear('deleted_at', $now->year)
            ->sum('total_price');

        $data = Service::onlyTrashed()
            ->latest('deleted_at')
            ->get();

        return view('admin.laporan', compact('weeklyTotal', 'monthlyTotal', 'data'));
    }

    public function exportExcel(Request $request)
    {
        $start = $request->start_date ?? now()->startOfMonth()->toDateString();
        $end = $request->end_date ?? now()->endOfMonth()->toDateString();
        $user = auth()->user();

        return Excel::download(new LaporanServisExport($start, $end, $user), 'laporan-servis.xlsx');
    }

    // ✅ Fitur hapus permanen dari laporan
    public function destroy($id)
    {
        $service = Service::onlyTrashed()->findOrFail($id);
        $service->forceDelete(); // Hapus permanen dari database

        return redirect()->route('admin.laporan')->with('success', 'Data servis berhasil dihapus secara permanen.');
    }
}
