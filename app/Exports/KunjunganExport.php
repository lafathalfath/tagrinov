<?php

namespace App\Exports;

use App\Models\Kunjungan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Carbon\Carbon;

class KunjunganExport implements FromCollection, WithHeadings, WithColumnWidths, WithTitle, WithStyles
{
    /**
     * Mengambil data kunjungan untuk diekspor dengan nama data terkait.
     *
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $baseUrl = request()->getSchemeAndHttpHost(); 
        return Kunjungan::with([
            'usia', 'jenis_kelamin', 'pekerjaan', 'kategori_informasi',
            'pilihan_pertanian', 'pendidikan', 'jenis_pengunjung'
        ])->get()->map(function ($item, $index) use ($baseUrl) {
            return [
                'nomor' => $index + 1,
                'nama_lengkap' => $item->nama_lengkap,
                'tanggal_kunjungan' => Carbon::parse($item->tanggal_kunjungan)->locale('id')->translatedFormat('d F Y'),
                'no_hp' => $item->no_hp,
                'usia' => $item->usia->nama ?? '-',
                'jenis_kelamin' => $item->jenis_kelamin->nama ?? '-',
                'asal_instansi' => $item->asal_instansi,
                'pekerjaan' => $item->pekerjaan->nama ?? '-',
                'kategori_informasi' => $item->kategori_informasi->nama ?? '-',
                'pilihan_pertanian' => $item->pilihan_pertanian->nama ?? '-',
                'pendidikan' => $item->pendidikan->nama ?? '-',
                'jenis_pengunjung' => $item->jenis_pengunjung->nama ?? '-',
                'jumlah_orang' => $item->jumlah_orang,
                'tujuan_kunjungan' => $item->tujuan_kunjungan,
                'url_foto_ktp' => $item->url_foto_ktp 
                    ? '=HYPERLINK("' . $baseUrl . '/storage/' . $item->url_foto_ktp . '", "VIEW")' 
                    : '-',
                'url_foto_selfie' => $item->url_foto_selfie 
                    ? '=HYPERLINK("' . $baseUrl . '/storage/' . $item->url_foto_selfie . '", "VIEW")' 
                    : '-',
                'status' => auth()->user()->role === 'tim_kerja' ? $item->status_setujui : $item->status_verifikasi
            ];
        });
    }

    /**
     * Menentukan header kolom untuk file ekspor.
     *
     * @return array
     */
    public function headings(): array
    {
        $tanggal = Carbon::now()->locale('id')->translatedFormat('d F Y');
        return [
            ["Data Kunjungan Per $tanggal"], // Judul di atas header
            [
                "No",
                "Nama Lengkap",
                "Tanggal Kunjungan",
                "No HP",
                "Usia",
                "Jenis Kelamin",
                "Asal Instansi",
                "Pekerjaan",
                "Kategori Informasi",
                "Pilihan Pertanian",
                "Pendidikan",
                "Jenis Pengunjung",
                "Jumlah Orang",
                "Tujuan Kunjungan",
                "Foto KTP",
                "Foto Selfie",
                "Status"
            ]
        ];
    }

    /**
     * Mengatur lebar kolom agar lebih rapi.
     *
     * @return array
     */
    public function columnWidths(): array
    {
        return [
            'A' => 5,   // ID
            'B' => 25,  // Nama Lengkap
            'C' => 15,  // Tanggal Kunjungan
            'D' => 15,  // No HP
            'E' => 10,  // Usia
            'F' => 15,  // Jenis Kelamin
            'G' => 25,  // Asal Instansi
            'H' => 20,  // Pekerjaan
            'I' => 25,  // Kategori Informasi
            'J' => 20,  // Pilihan Pertanian
            'K' => 20,  // Pendidikan
            'L' => 20,  // Jenis Pengunjung
            'M' => 15,  // Jumlah Orang
            'N' => 30,  // Tujuan Kunjungan
            'O' => 10,  // Foto KTP
            'P' => 10,  // Foto Selfie
            'Q' => 15,  // Status
        ];
    }

        /**
     * Mengatur style agar heading berada di tengah.
     */
    public function styles(Worksheet $sheet)
    {
        return [
            2 => ['alignment' => ['horizontal' => 'center']], // Heading rata tengah
        ];
    }

    /**
     * Menentukan judul sheet di dalam file Excel.
     *
     * @return string
     */
    public function title(): string
    {
        return 'Data Kunjungan';
    }
}
