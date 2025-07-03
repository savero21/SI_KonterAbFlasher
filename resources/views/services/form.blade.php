@csrf

<div class="mb-3">
    <label>Nama Pelanggan</label>
    <input type="text" name="customer" class="form-control" value="{{ old('customer', $service->customer ?? '') }}" required>
</div>

<div class="mb-3">
    <label>Model HP</label>
    <input type="text" name="phone_model" class="form-control" value="{{ old('phone_model', $service->phone_model ?? '') }}" required>
</div>

<div class="mb-3">
    <label>Kerusakan</label>
    <input type="text" name="damage" class="form-control" value="{{ old('damage', $service->damage ?? '') }}" required>
</div>

<div class="mb-3">
    <label>Status</label>
    <select name="status" id="status" class="form-control" onchange="toggleFields()">
        @foreach(['masuk','diperbaiki','selesai'] as $stat)
            <option value="{{ $stat }}" {{ (old('status', $service->status ?? '') == $stat) ? 'selected' : '' }}>
                {{ ucfirst($stat) }}
            </option>
        @endforeach
    </select>
</div>

{{-- Nomor Pengambilan --}}
<div class="mb-3" id="pickupField" style="display: none;">
    <label>Nomor Pengambilan</label>
    <input type="text" name="pickup_code" class="form-control"
        value="{{ old('pickup_code', $service->pickup_code ?? '') }}">
</div>

{{-- Total Harga --}}
<div class="mb-3" id="priceField" style="display: none;">
    <label>Total Harga (Rp)</label>
    <input type="number" name="total_price" class="form-control"
        value="{{ old('total_price', $service->total_price ?? '') }}">
</div>

<div class="mb-3">
    <label>Tanggal Masuk</label>
    <input type="date" name="received_at" class="form-control" value="{{ old('received_at', $service->received_at ?? '') }}">
</div>

<div class="mb-3">
    <label>Catatan</label>
    <textarea name="notes" class="form-control">{{ old('notes', $service->notes ?? '') }}</textarea>
</div>

<button class="btn btn-success">Simpan</button>
<a href="{{ route('services.index') }}" class="btn btn-secondary">Kembali</a>

{{-- Script Toggle --}}
<script>
    function toggleFields() {
        const status = document.getElementById('status').value;
        const pickup = document.getElementById('pickupField');
        const price = document.getElementById('priceField');

        // Reset
        pickup.style.display = 'none';
        price.style.display = 'none';

        if (status === 'diperbaiki') {
            pickup.style.display = 'block';
        } else if (status === 'selesai') {
            pickup.style.display = 'block';
            price.style.display = 'block';
        }
    }

    document.addEventListener('DOMContentLoaded', toggleFields);
</script>
