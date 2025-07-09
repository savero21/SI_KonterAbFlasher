<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;

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
}
