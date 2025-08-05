<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\User;

class UserController extends Controller
{
    // ✅ Halaman awal form cek status
    public function cekForm()
    {
        return view('user.cek');
    }

    // ✅ Proses pengecekan berdasarkan kode pengambilan
    public function cekProses(Request $request)
    {
        $request->validate([
            'pickup_code' => 'required|string'
        ]);

        $service = Service::where('pickup_code', $request->pickup_code)->first();

        if (!$service) {
            return redirect()->route('cek.form')
                ->withInput()
                ->with('error', '❌ Nomor pengambilan tidak ditemukan. Pastikan kode Anda benar.');
        }

        return view('user.cek', compact('service'));
    }

    // ✅ Halaman Beranda
    public function beranda()
    {
        return view('user.beranda');
    }

    // ✅ Halaman Layanan
    public function layanan()
    {
        return view('user.layanan');
    }

    // ✅ Halaman Tentang Kami
    public function tentang()
    {
        return view('user.tentang');
    }

    // ✅ Halaman Kontak
    public function kontak()
    {
        return view('user.kontak');
    }

    // ✅ Halaman Kelola Admin (untuk superadmin)
    public function index()
    {
        $users = User::where('role', 'admin')->get();
        return view('superadmin.users.index', compact('users'));
    }

    // ✅ Approve akun admin
    public function approve($id)
    {
        $user = User::findOrFail($id);
        $user->status = 'active';
        $user->save();

        return back()->with('success', 'Admin berhasil diaktifkan.');
    }

    // ✅ Hapus akun admin
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return back()->with('success', 'Akun admin berhasil dihapus.');
    }

    // // ✅ Kirim komplain oleh pengguna jika status servis selesai
    // public function submitComplain(Request $request, $id)
    // {
    //     $request->validate([
    //         'complain' => 'required|string|min:10'
    //     ]);

    //     $service = Service::findOrFail($id);

    //     // Pastikan hanya bisa komplain jika status selesai
    //     if ($service->status !== 'selesai') {
    //         return back()->with('error', 'Komplain hanya bisa dikirim jika status selesai.');
    //     }

    //     $service->complain = $request->complain;
    //     $service->save();

    //     return back()->with('success', 'Komplain berhasil dikirim. Terima kasih.');
    // }
    public function formKomplain()
{
    return view('user.komplain');
}

public function submitComplain(Request $request)
{
    $request->validate([
        'pickup_code' => 'required|string',
        'complain' => 'required|string|max:1000',
    ]);

    $pickupCode = strtoupper(trim($request->pickup_code));

    // ✅ Cari dari data yang sudah dihapus (laporan)
    $service = \App\Models\Service::onlyTrashed()
        ->where('pickup_code', $pickupCode)
        ->first();

    if (!$service) {
        return back()->with('error', 'Nomor pengambilan tidak ditemukan.');
    }

    if ($service->status !== 'selesai') {
        return back()->with('error', 'Servis belum selesai. Komplain hanya bisa diajukan setelah status selesai.');
    }

    $service->complain = $request->complain;
    $service->save();

    return back()->with('success', ' Tunggu admin membalas pesan anda di halaman riwayat komplain');
}
// public function riwayatKomplain(Request $request)
// {
//     $riwayat = \App\Models\Service::onlyTrashed()
//         ->when($request->pickup_code, function ($query, $pickupCode) {
//             return $query->where('pickup_code', 'like', '%' . $pickupCode . '%');
//         })
//         ->whereNotNull('complain')
//         ->orderByDesc('deleted_at')
//         ->get();

//     return view('user.complain.history', compact('riwayat'));
// }
public function riwayatKomplain(Request $request)
{
    if (!$request->has('pickup_code') || empty($request->pickup_code)) {
        // Jika tidak ada kode pickup dikirimkan, jangan tampilkan data
        return view('user.complain.history', ['riwayat' => collect()]);
    }

    $riwayat = Service::onlyTrashed()
        ->where('pickup_code', $request->pickup_code)
        ->whereNotNull('complain')
        ->orderByDesc('deleted_at')
        ->get();

    return view('user.complain.history', compact('riwayat'));
}



public function hapusKomplain($id)
{
    $service = \App\Models\Service::whereNotNull('complain')
        ->where('id', $id)
        ->firstOrFail();

    // Kosongkan kolom complain dan complain_reply
    $service->complain = null;
    $service->complain_reply = null;
    $service->save();

    return back()->with('success', 'Riwayat komplain berhasil dihapus.');
}





}
