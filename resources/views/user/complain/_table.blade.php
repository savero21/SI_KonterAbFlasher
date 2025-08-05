<div class="table-responsive">
    <table class="table table-hover align-middle">
        <thead class="table-light">
            <tr class="text-center">
                <th>Nama</th>
                <th>HP</th>
                <th>Kerusakan</th>
                <th>No. Pickup</th>
                <th>Komplain</th>
                <th>Balasan Admin</th>
                <th>Waktu</th>
            </tr>
        </thead>
        <tbody>
            @foreach($riwayat as $item)
                <tr>
                    <td>{{ $item->customer }}</td>
                    <td>{{ $item->phone_model }}</td>
                    <td>{{ $item->damage }}</td>
                    <td class="text-center">
                        <span class="badge bg-primary bg-opacity-10 text-primary border border-primary border-opacity-10">
                            {{ $item->pickup_code }}
                        </span>
                    </td>
                    <td class="small">{{ $item->complain }}</td>
                    <td>
                        @if($item->complain_reply)
                            <div class="alert alert-success py-1 px-2 mb-0 small">
                                <i class="bi bi-check-circle-fill me-1"></i>
                                {{ $item->complain_reply }}
                            </div>
                        @else
                            <span class="badge bg-secondary bg-opacity-10 text-secondary">Belum dibalas</span>
                        @endif
                    </td>
                    <td class="text-center small text-muted">
                        {{ \Carbon\Carbon::parse($item->updated_at)->format('d M Y, H:i') }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
