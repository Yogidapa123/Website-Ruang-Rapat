<!DOCTYPE html>
<html>
<head>
    <title>Daftar Peminjaman</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: center;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h2 style="text-align: center;">Daftar Peminjaman Ruangan</h2>
    <table>
        <thead>
            <tr>
                <th>No.</th>
                <th>Kode Ruangan</th>
                <th>Nama Peminjam</th>
                <th>Mulai Pinjam</th>
                <th>Selesai Pinjam</th>
                <th>Kegiatan</th>
                <th>Waktu Transaksi</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($adminRents as $rent)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $rent->room->code ?? '-' }}</td>
                    <td>{{ $rent->user->name ?? '-' }}</td>
                    <td>{{ $rent->time_start_use ?? '-' }}</td>
                    <td>{{ $rent->time_end_use ?? '-' }}</td>
                    <td>{{ $rent->purpose ?? '-' }}</td>
                    <td>{{ $rent->transaction_start ?? '-' }}</td>
                    <td>{{ $rent->status ?? '-' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
