<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ServiceController extends Controller
{
    public function index(Request $request)
    {
        $query = Service::latest();

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
        $pickupCode = $this->generatePickupCode();
        return view('services.create', compact('pickupCode'));
    }

    public function store(Request $request)
    {
        $messages = ['pickup_code.unique' => 'Nomor pengambilan sudah digunakan.'];

        $validated = $request->validate([
            'customer'     => 'required|string',
            'phone_model'  => 'required|string',
            'damage'       => 'required|string',
            'status'       => 'required|string|in:masuk,diperbaiki,selesai',
            'total_price'  => 'nullable|string',
            'pickup_code'  => 'nullable|string|unique:services,pickup_code',
            'received_at'  => 'nullable|date',
            'notes'        => 'nullable|string',
            'photo_path'   => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'timeline'     => 'nullable|string',
        ], $messages);

        if (!empty($validated['total_price'])) {
            $validated['total_price'] = (int) str_replace('.', '', $validated['total_price']);
        }

        if ($validated['status'] === 'selesai') {
            $validated['pickup_code'] = $validated['pickup_code'] ?? $this->generatePickupCode();
        }

        $validated['received_at'] = $validated['received_at'] ?? now();

        if ($request->hasFile('photo_path')) {
            $validated['photo_path'] = $request->file('photo_path')->store('uploads', 'public');
        }

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

        $messages = ['pickup_code.unique' => 'Nomor pengambilan sudah digunakan.'];

        $validated = $request->validate([
            'customer'     => 'required|string',
            'phone_model'  => 'required|string',
            'damage'       => 'required|string',
            'status'       => 'required|string|in:masuk,diperbaiki,selesai',
            'total_price'  => 'nullable|string',
            'pickup_code'  => 'nullable|string|unique:services,pickup_code,' . $service->id,
            'received_at'  => 'nullable|date',
            'notes'        => 'nullable|string',
            'photo_path'   => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'timeline'     => 'nullable|string',
        ], $messages);

        if (!empty($validated['total_price'])) {
            $validated['total_price'] = (int) str_replace('.', '', $validated['total_price']);
        }

        if ($validated['status'] === 'selesai' && empty($validated['pickup_code'])) {
            $validated['pickup_code'] = $this->generatePickupCode();
        }

        if ($request->hasFile('photo_path')) {
            if ($service->photo_path) {
                Storage::disk('public')->delete($service->photo_path);
            }
            $validated['photo_path'] = $request->file('photo_path')->store('uploads', 'public');
        }

        $service->update($validated);
        return redirect()->route('services.index')->with('success', 'Data servis berhasil diperbarui.');
    }

    public function destroy(Service $service)
    {
        if ($service->photo_path) {
            Storage::disk('public')->delete($service->photo_path);
        }

        $service->delete();
        return redirect()->route('services.index')->with('success', 'Data servis berhasil dihapus!');
    }

    private function generatePickupCode()
    {
        return 'PK-' . now()->format('Ymd') . '-' . strtoupper(Str::random(4));
    }
}
