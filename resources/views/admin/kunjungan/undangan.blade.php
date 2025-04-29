<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Surat Undangan Kunjungan {{ $kunjungan->nama_lengkap }}</title>
    <style>
        body { font-family: 'Calibri', sans-serif; font-size: 12pt; }
        .kop { text-align: center; margin: 5px 40px; }
        .alamat { font-size: 11pt; }
        .isi { margin: 5px 40px; }
        .ttd { text-align: right; margin-top: 60px; margin-right: 80px; }
        table { width: 100%; border-collapse: collapse; }
        td { vertical-align: top; padding: 2px 10px; }
        hr { border: 1px solid black; margin-bottom: 10px; }
    </style>
</head>
<body>

    <table width="100%">
        <tr>
            <td width="10%"><img src="{{ public_path('/assets/icons/logo.png') }}" width="120"></td>
            <td class="kop">
                KEMENTERIAN PERTANIAN<br>
                BADAN STANDARDISASI INSTRUMEN PERTANIAN <br>
                <b>BALAI BESAR PENERAPAN STANDAR INSTRUMEN PERTANIAN</b> <br>
                <span class="alamat">Jl. Tentara Pelajar No. 10 Bogor 16114 <br>
                Telepon (0251) 8351277, Faksimili (0251) 8350928 <br>
                WEBSITE: https://bbpsip.bsip.pertanian.go.id 
                E-MAIL: bbpsip@pertanian.go.id</span>
            </td>
        </tr>
    </table>

    <hr>

    <div class="isi">
        <p>
            Nomor: {{ $noSurat }} <span style="float:right;">{{ \Carbon\Carbon::parse($tanggalHariIni)->locale('id')->translatedFormat('d F Y') }}


            </span><br>
            Sifat: Biasa <br>
            Lampiran: - <br>
            Perihal: Permohonan Kunjungan
        </p>

        <p>Kepada Yth.<br> 
            {{ $kunjungan->asal_instansi }} <br> 
            di tempat.
        </p>

        <p>Dengan ini kami mengundang :</p>

        <table width="100%">
            <tr>
                <td width="35%">Nama Pengunjung</td>
                <td>: {{ $kunjungan->nama_lengkap }}</td>
            </tr>
            <tr>
                <td>Waktu Pelaksanaan</td>
                <td>: {{ \Carbon\Carbon::parse($tanggalHariIni)->locale('id')->translatedFormat('l, d F Y') }}
                </td>
            </tr>
            <tr>
                <td>No HP</td>
                <td>: {{ $kunjungan->no_hp }}</td>
            </tr>
            <tr>
                <td>Jenis Pengunjung</td>
                <td>: {{ $kunjungan->jenis_kelamin->nama ?? '-' }}</td>
            </tr>
            @if($kunjungan->jumlah_orang > 1)
            <tr>
                <td>Jumlah Orang</td>
                <td>: {{ $kunjungan->jumlah_orang }} orang</td>
            </tr>
            @endif
            <tr>
                <td>Kategori Informasi Publik</td>
                <td>: {{ $kunjungan->kategori_informasi->nama ?? '-' }}</td>
            </tr>
            <tr>
                <td>Tujuan Kunjungan</td>
                <td>: {{ $kunjungan->tujuan_kunjungan }}</td>
            </tr>
        </table>

        <p>
            Demikian disampaikan. Atas perhatian dan kerjasamanya diucapkan terima kasih.
        </p>
    </div>

    <div class="ttd">
        Ketua Tim Kerja Penerapan SIP <br><br><br>
        Ume Humaedah, SP., M.Si.
    </div>

</body>
</html>