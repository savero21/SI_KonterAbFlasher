<form action="{{ $formAction }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="mb-3">
        <label>Nama Pelanggan</label>
        <input type="text" name="customer" class="form-control"
               value="{{ old('customer', $service->customer ?? '') }}" required>
        @error('customer')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label>Model HP</label>
        <input type="text" name="phone_model" class="form-control"
               value="{{ old('phone_model', $service->phone_model ?? '') }}" required>
        @error('phone_model')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label>Kerusakan</label>
        <input type="text" name="damage" class="form-control"
               value="{{ old('damage', $service->damage ?? '') }}" required>
        @error('damage')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label>Status</label>
        <select name="status" id="status" class="form-control" onchange="toggleFields()" required>
            @foreach(['masuk', 'diperbaiki', 'selesai'] as $stat)
                <option value="{{ $stat }}" {{ old('status', $service->status ?? '') == $stat ? 'selected' : '' }}>
                    {{ ucfirst($stat) }}
                </option>
            @endforeach
        </select>
        @error('status')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    {{-- Nomor Pengambilan --}}
    <div class="mb-3" id="pickupField" style="display: none;">
        <label>Nomor Pengambilan</label>
        <input type="text" name="pickup_code" id="pickup_code" class="form-control"
               value="{{ old('pickup_code', $pickupCode ?? $service->pickup_code ?? '') }}">
        <div class="text-danger mt-1 d-none" id="pickupWarning">
            <!-- Nomor sudah tersedia -->
        </div>
        @error('pickup_code')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    {{-- Total Harga --}}
    <div class="mb-3" id="priceField" style="display: none;">
        <label>Total Harga (Rp)</label>
        <input type="number" name="total_price" class="form-control"
               value="{{ old('total_price', $service->total_price ?? '') }}">
        @error('total_price')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    {{-- Upload Foto Bukti --}}
    <div class="mb-3" id="photoField" style="display: none;">
        <label>Foto Bukti Perbaikan</label>
        <input type="file" name="photo_path" class="form-control" accept="image/*">
        @if (!empty($service->photo_path))
            <div class="mt-2">
                <img src="{{ Storage::url($service->photo_path) }}" width="150" class="img-thumbnail">
            </div>
        @endif
        @error('photo_path')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    {{-- Timeline Perbaikan --}}
    <div class="mb-3" id="timelineField" style="display: none;">
        <label>Timeline Perkiraan Perbaikan</label>
        <textarea name="timeline" class="form-control" rows="2">{{ old('timeline', $service->timeline ?? '') }}</textarea>
        @error('timeline')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    {{-- Tanggal Masuk --}}
    <div class="mb-3">
        <label>Tanggal Masuk</label>
        <input type="date" name="received_at" class="form-control"
               value="{{ old('received_at', isset($service->received_at) ? \Carbon\Carbon::parse($service->received_at)->format('Y-m-d') : now()->format('Y-m-d')) }}">
        @error('received_at')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label>Catatan</label>
        <textarea name="notes" class="form-control">{{ old('notes', $service->notes ?? '') }}</textarea>
    </div>

    <button class="btn btn-success">Simpan</button>
    <a href="{{ route('services.index') }}" class="btn btn-secondary">Kembali</a>
</form>

{{-- Script --}}
<script>
    function toggleFields() {
        const status = document.getElementById('status').value;
        const pickupField = document.getElementById('pickupField');
        const priceField = document.getElementById('priceField');
        const pickupInput = document.getElementById('pickup_code');
        const warning = document.getElementById('pickupWarning');
        const photoField = document.getElementById('photoField');
        const timelineField = document.getElementById('timelineField');

        pickupField.style.display = 'none';
        priceField.style.display = 'none';
        warning.classList.add('d-none');
        photoField.style.display = 'none';
        timelineField.style.display = 'none';

        if (['masuk', 'diperbaiki', 'selesai'].includes(status)) {
            pickupField.style.display = 'block';
        }

        if (status === 'selesai') {
            priceField.style.display = 'block';
        }

        if (status === 'masuk' && pickupInput.value.trim() !== '') {
            warning.classList.remove('d-none');
        }

        if (status === 'diperbaiki') {
            photoField.style.display = 'block';
            timelineField.style.display = 'block';
        }
    }

    document.addEventListener('DOMContentLoaded', toggleFields);
</script>
