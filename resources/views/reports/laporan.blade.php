<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Servis</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        table, th, td { border: 1px solid black; }
        th, td { padding: 5px; text-align: left; }
        h2 { text-align: center; margin-bottom: 20px; }
    </style>
</head>
<body>
    <h2>Laporan Servis HP - Konter AB Flasher</h2>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Pelanggan</th>
                <th>Model HP</th>
                <th>Kerusakan</th>
                <th>Status</th>
                <th>Masuk</th>
                <th>Catatan</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $i => $s)
            <tr>
                <td>{{ $i+1 }}</td>
                <td>{{ $s->customer }}</td>
                <td>{{ $s->phone_model }}</td>
                <td>{{ $s->damage }}</td>
                <td>{{ ucfirst($s->status) }}</td>
                <td>{{ $s->received_at }}</td>
                <td>{{ $s->notes }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
