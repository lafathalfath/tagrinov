<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Permohonan Kunjungan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 20px;
        }
        .container {
            background: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            margin: auto;
        }
        h2 {
            color: #007b83;
        }
        p {
            color: #333;
            line-height: 1.6;
            margin: 0;
        }
        .details {
            background: #f1f1f1;
            padding: 10px;
            border-radius: 5px;
            margin-top: 10px;
            margin-bottom: 10px;
            width: 100%;
            border-spacing: 0; /* Menghilangkan jarak antar sel */
        }
        .details td {
            padding: 5px 10px;
            vertical-align: top;
        }
        .details td:first-child {
            font-weight: bold;
            width: 30%; /* Lebar kolom label */
            text-align: left;
        }
        .details td:last-child {
            width: 70%;
            text-align: left;
        }
        .button {
            display: inline-block;
            padding: 10px 20px;
            margin-top: 10px;
            font-size: 16px;
            color: #ffffff !important;
            background: #007b83;
            text-decoration: none;
            border-radius: 5px;
            text-align: center;
        }
        .button:hover {
            background: #005f63;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Permohonan Kunjungan Baru</h2>
        <p>Halo, Anda memiliki permohonan kunjungan baru. Berikut adalah detailnya:</p>

        <table class="details">
            <tr>
                <td>Nama</td>
                <td>{{ $kunjungan->nama_lengkap }}</td>
            </tr>
            <tr>
                <td>Tanggal</td>
                <td>{{ \Carbon\Carbon::parse($kunjungan->tanggal_kunjungan)->locale('id')->translatedFormat('l, d F Y') }}</td>
            </tr>
            <tr>
                <td>Instansi</td>
                <td>{{ $kunjungan->asal_instansi }}</td>
            </tr>
            <tr>
                <td>Jenis Pengunjung</td>
                <td>{{ $kunjungan->jenis_pengunjung->nama }}</td>
            </tr>
            <tr>
                <td>Tujuan</td>
                <td>{{ $kunjungan->tujuan_kunjungan }}</td>
            </tr>
        </table>

        <p>Silakan segera meninjau dan menanggapi permohonan ini.</p>
        
        <a href="{{ $linkWeb }}" class="button">Tinjau Permohonan</a>
    </div>
</body>
</html>
