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
        $query = Service::query()->where('status', '!=', 'selesai'); // hanya belum selesai

        // Filter status
        if ($request->status) {
            $query->where('status', $request->status);
        }

        // Sorting
        $sort = $request->get('sort', 'desc'); // default terbaru
        $query->orderBy('received_at', $sort);

        $services = $query->paginate(10);

        return view('services.index', compact('services', 'sort'));
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
            'pickup_code'  => 'nullable|string|unique:services,pickup_code',
            'received_at'  => 'nullable|date',
            'notes'        => 'nullable|string',
            'photo_path'   => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'timeline'     => 'nullable|string',
        ], $messages);

        if ($validated['status'] === 'selesai') {
            $validated['pickup_code'] = $validated['pickup_code'] ?? $this->generatePickupCode();
        }

        $validated['received_at'] = $validated['received_at'] ?? now();

        if ($request->hasFile('photo_path')) {
            $validated['photo_path'] = $request->file('photo_path')->store('uploads', 'public');
        }

        $service = Service::create($validated);

        // ✅ simpan sparepart jika ada
        if ($request->has('items')) {
            foreach ($request->items as $item) {
                if (!empty($item['item_name']) && !empty($item['item_price'])) {
                    $service->items()->create([
                        'item_name'  => $item['item_name'],
                        // hilangkan titik ribuan jika ada
                        'item_price' => (int) str_replace('.', '', $item['item_price']),
                    ]);
                }
            }
            $service->updateTotalPrice(); // update total_price dari items
        }

        return redirect()->route('services.index')->with('success', 'Data berhasil ditambah!');
    }

    public function edit(Service $service)
    {
        $service->load('items'); // bawa sparepart juga
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
            'pickup_code'  => 'nullable|string|unique:services,pickup_code,' . $service->id,
            'received_at'  => 'nullable|date',
            'notes'        => 'nullable|string',
            'photo_path'   => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'timeline'     => 'nullable|string',
        ], $messages);

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

        // ✅ update sparepart
        $service->items()->delete(); // hapus lama dulu
        if ($request->has('items')) {
            foreach ($request->items as $item) {
                if (!empty($item['item_name']) && !empty($item['item_price'])) {
                    $service->items()->create([
                        'item_name'  => $item['item_name'],
                        'item_price' => (int) str_replace('.', '', $item['item_price']),
                    ]);
                }
            }
            $service->updateTotalPrice(); // hitung ulang total
        }

        return redirect()->route('services.index')->with('success', 'Data servis berhasil diperbarui.');
    }

    public function destroy(Service $service)
    {
        if ($service->photo_path) {
            Storage::disk('public')->delete($service->photo_path);
        }

        $service->delete();
        return redirect()->route('admin.laporan')
            ->with('success', 'Data berhasil dihapus dan akan tampil di laporan!');
    }

    private function generatePickupCode()
    {
        return 'PK-' . now()->format('Ymd') . '-' . strtoupper(Str::random(4));
    }

    public function show($id)
    {
        $service = Service::with('items')->findOrFail($id);
        return view('services.show', compact('service'));
    }
}
