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
    @error('pickup_code')
        <div class="text-danger">{{ $message }}</div>
    @enderror
</div>

{{-- Sparepart / Items --}}
<div class="mb-3" id="itemsField" style="display:none;">
    <label>Sparepart / Item</label>
    <table class="table" id="itemsTable">
        <thead>
            <tr>
                <th>Nama Item</th>
                <th>Harga</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @if(isset($service) && $service->items)
                @foreach($service->items as $i => $item)
                <tr>
                    <td><input type="text" name="items[{{ $i }}][item_name]" value="{{ $item->item_name }}" class="form-control" required></td>
                    <td><input type="number" name="items[{{ $i }}][item_price]" value="{{ $item->item_price }}" class="form-control" required></td>
                    <td><button type="button" class="btn btn-sm btn-danger removeRow">X</button></td>
                </tr>
                @endforeach
            @endif
        </tbody>
    </table>
    <button type="button" class="btn btn-sm btn-primary" id="addItem">+ Tambah Item</button>
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

{{-- Script --}}
<script>
function toggleFields() {
    const status = document.getElementById('status').value;
    document.getElementById('pickupField').style.display = (['masuk','diperbaiki','selesai'].includes(status)) ? 'block':'none';
    document.getElementById('photoField').style.display = (status === 'diperbaiki') ? 'block':'none';
    document.getElementById('timelineField').style.display = (status === 'diperbaiki') ? 'block':'none';
    document.getElementById('itemsField').style.display = (status === 'selesai') ? 'block':'none';
}

document.addEventListener('DOMContentLoaded', function () {
    toggleFields();
    let index = {{ isset($service) && $service->items ? $service->items->count() : 0 }};

    document.getElementById('addItem').addEventListener('click', function () {
        let row = `
            <tr>
                <td><input type="text" name="items[${index}][item_name]" class="form-control" required></td>
                <td><input type="number" name="items[${index}][item_price]" class="form-control" required></td>
                <td><button type="button" class="btn btn-sm btn-danger removeRow">X</button></td>
            </tr>
        `;
        document.querySelector('#itemsTable tbody').insertAdjacentHTML('beforeend', row);
        index++;
    });

    document.addEventListener('click', function(e){
        if(e.target.classList.contains('removeRow')){
            e.target.closest('tr').remove();
        }
    });
});
</script>
