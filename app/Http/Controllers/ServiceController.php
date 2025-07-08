<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ServiceController extends Controller
{
    public function index(Request $request)
    {
        $query = Service::latest();

        // Filter: HANYA tampilkan servis yang belum bisa diambil
        $query->where(function ($q) {
            $q->where('status', '!=', 'selesai')
              ->orWhereNull('pickup_code')
              ->orWhereNull('total_price');
        });

        if ($request->status) {
            $query->where('status', $request->status);
        }

        $services = $query->get();

        return view('services.index', compact('services'));
    }

    public function create()
    {
        return view('services.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer'     => 'required|string',
            'phone_model'  => 'required|string',
            'damage'       => 'required|string',
            'status'       => 'required|string',
            'total_price'  => 'nullable|string', // Ubah menjadi string untuk menerima titik
            'pickup_code'  => 'nullable|string',
            'received_at'  => 'nullable|date',
            'notes'        => 'nullable|string',
        ]);

        // Convert total_price ke integer: hilangkan titik (.)
        if (!empty($validated['total_price'])) {
            $validated['total_price'] = (int) str_replace('.', '', $validated['total_price']);
        }

        // Generate pickup_code jika status selesai dan belum ada kode
        if ($validated['status'] === 'selesai') {
            $validated['pickup_code'] = $validated['pickup_code'] ?? $this->generatePickupCode();
        }

        $validated['received_at'] = $validated['received_at'] ?? now();

        Service::create($validated);

        return redirect()->route('services.index')->with('success', 'Data berhasil ditambah!');
    }

    public function edit(Service $service)
    {
        return view('services.edit', compact('service'));
    }

    public function update(Request $request, $id)
    {
        $service = Service::findOrFail($id);

        $validated = $request->validate([
            'customer'     => 'required|string',
            'phone_model'  => 'required|string',
            'damage'       => 'required|string',
            'status'       => 'required|string',
            'total_price'  => 'nullable|string', // Ubah menjadi string
            'pickup_code'  => 'nullable|string',
            'received_at'  => 'nullable|date',
            'notes'        => 'nullable|string',
        ]);

        // Convert harga
        if (!empty($validated['total_price'])) {
            $validated['total_price'] = (int) str_replace('.', '', $validated['total_price']);
        }

        // Generate kode jika belum ada
        if ($validated['status'] === 'selesai' && empty($validated['pickup_code'])) {
            $validated['pickup_code'] = $this->generatePickupCode();
        }

        $service->update($validated);

        return redirect()->route('services.index')->with('success', 'Data servis berhasil diperbarui.');
    }

    public function destroy(Service $service)
    {
        $service->delete();

        if (url()->previous() === route('admin.transaksi')) {
            return redirect()->route('admin.transaksi')->with('success', 'Data servis berhasil dihapus!');
        }

        return redirect()->route('services.index')->with('success', 'Data servis berhasil dihapus!');
    }

    private function generatePickupCode()
    {
        return 'PK-' . now()->format('Ymd') . '-' . strtoupper(Str::random(4));
    }
}
