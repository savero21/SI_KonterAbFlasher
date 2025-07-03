<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ServiceController extends Controller
{
    // public function index()
    // {
    //     $services = Service::latest()->get();
    //     return view('services.index', compact('services'));
    // }
    public function index(Request $request)
{
    $query = Service::latest();

    // Filter: HANYA tampilkan servis yang belum bisa diambil
    $query->where(function ($q) {
        $q->where('status', '!=', 'selesai')
          ->orWhereNull('pickup_code')
          ->orWhereNull('total_price');
    });

    // Jika ada filter status dari request
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
            'total_price'  => 'nullable|integer',
            'pickup_code'  => 'nullable|string',
            'received_at'  => 'nullable|date',
            'notes'        => 'nullable|string',
        ]);

        // Jika status = selesai dan belum ada kode pengambilan, buat otomatis
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
            'total_price'  => 'nullable|integer',
            'pickup_code'  => 'nullable|string',
            'received_at'  => 'nullable|date',
            'notes'        => 'nullable|string',
        ]);

        // Otomatis generate kode jika status selesai dan belum diisi
        if ($validated['status'] === 'selesai' && empty($validated['pickup_code'])) {
            $validated['pickup_code'] = $this->generatePickupCode();
        }

        $service->update($validated);

        return redirect()->route('services.index')->with('success', 'Data servis berhasil diperbarui.');
    }

    public function destroy(Service $service)
    {
        $service->delete();
        // Redirect sesuai asal request
if (url()->previous() === route('admin.transaksi')) {
    return redirect()->route('admin.transaksi')->with('success', 'Data servis berhasil dihapus!');
}

return redirect()->route('services.index')->with('success', 'Data servis berhasil dihapus!');

    }

    private function generatePickupCode()
    {
        // Format kode pengambilan: PK-YYYYMMDD-RAND
        return 'PK-' . now()->format('Ymd') . '-' . strtoupper(Str::random(4));
    }
}
