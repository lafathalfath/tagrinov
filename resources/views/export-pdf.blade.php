<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Permohonan Kunjungan {{ \Carbon\Carbon::now()->locale('id')->translatedFormat('d F Y') }}</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; }
        h2 { text-align: center; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid black; padding: 5px; text-align: left; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <h2>Data Permohonan Kunjungan Per {{ \Carbon\Carbon::now()->locale('id')->translatedFormat('d F Y') }}</h2>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Lengkap</th>
                <th>Tanggal Kunjungan</th>
                <th>Nomor HP</th>
                <th>Usia</th>
                <th>Jenis Kelamin</th>
                <th>Asal Instansi</th>
                <th>Pekerjaan</th>
                <th>Kategori Informasi</th>
                <th>Pilihan Pertanian</th>
                <th>Pendidikan</th>
                <th>Jenis Pengunjung</th>
                <th>Jumlah Orang</th>
                <th>Tujuan Kunjungan</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($kunjungan as $key => $item)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $item->nama_lengkap }}</td>
                    <td>{{ \Carbon\Carbon::parse($item->tanggal_kunjungan)->locale('id')->translatedFormat('d F Y') }}</td>
                    <td>{{ $item->no_hp }}</td>
                    <td>{{ $item->usia->nama ?? '-' }}</td>
                    <td>{{ $item->jenis_kelamin->nama ?? '-' }}</td>
                    <td>{{ $item->asal_instansi }}</td>
                    <td>{{ $item->pekerjaan->nama ?? '-' }}</td>
                    <td>{{ $item->kategori_informasi->nama ?? '-' }}</td>
                    <td>{{ $item->pilihan_pertanian->nama ?? '-' }}</td>
                    <td>{{ $item->pendidikan->nama ?? '-' }}</td>
                    <td>{{ $item->jenis_pengunjung->nama ?? '-' }}</td>
                    <td>{{ $item->jumlah_orang }}</td>
                    <td>{{ $item->tujuan_kunjungan }}</td>
                    <td>
                        @if(auth()->user()->role === 'tim_kerja')
                            {{ $item->status_setujui }}
                        @elseif(auth()->user()->role === 'admin')
                            {{ $item->status_verifikasi }}
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>
